#include <SimpleTimer.h>

#define VREF 4.56

/******State variables start******/
#define POLL 0
#define SERVICE_CMD 1
#define SERVICE_QUERY 2
#define TRANSMIT_EVENT_TO_PI 3
/******State variables end******/

/******Ldr parameters starts******/
#define LDR_THRESOLD 2.0
#define NIGHT 1
#define DAY 0
/******Ldr parameters ends******/

/******Serial State variables start******/
#define START_FOUND 1
#define HUB_ID_FOUND 2
#define NODE_ID_FOUND 3
#define TYPE_MSG_FOUND 4
#define MSG_FOUND 5
#define END_FOUND 6
#define INVALID_DATA 7
/******Serial State variables end******/

/*******Hard coded system parameters start******/
#define HUB_ID 1
#define NODE_ID 1
/*******Hard coded system parameters end******/

/******Types of messages from hub start*******/
#define MSG_TYPE_CMD 1
#define MSG_TYPE_QUERY 2
/******Types of messages from hub end*******/

/******Types of messages to hub start*******/
#define MSG_TYPE_EVENT 1

#define MSG_TYPE_QUERY_ANS 2
/******Types of messages to hub end*******/

/******Pir status starts******/
#define STILL 0
#define MOTION 1
/******Pir status ends******/

/******Current sensor status starts******/
#define CURRENT_LOW 0
#define CURRENT_HIGH 1
/******Current sensor status ends******/

/******Voltage sensor status starts******/
#define VOLTAGE_LOW 0
#define VOLTAGE_HIGH 1
/******Current sensor status ends******/

/******Light1 status starts******/
#define OFF 0
#define ON 1
#define DIM 2
#define DIM_VALUE 100
/******Current sensor status ends******/


char pir = 2; //PORTD.1 ---- INT1 
char pir_interrupt = 1;
char led1 = 3;//PWM ready I/O
char led2 = 4;
//char led3 = 5;
char ldr = A0;
char current = A1;
char voltage = A2;

char previous_pir_state = 0;
char current_ldr_state = DAY, previous_ldr_state = DAY;
float current_val = 0.0;
float voltage_val = 0.0;
char serial_state = 0;
unsigned int timer3_load = 0;
unsigned char buffer[11];
char serial_started = 0;
char serial_stop = 0;
int i = 0;
char data_packet_valid  = 0;

int temp =0;
struct packet_from_hub
{
    char package_type;
    char hub_id;
    char node_id;
    char type_msg;
    char msg;
};

struct packet_from_node
{
    char package_type;
    char hub_id;
    char own_node_id;
    char type_msg;
    char msg;
};

struct node_status
{
  char light1;//off
  char light2;//off
};

struct sensor_status
{
  char ldr_status;//low
  char pir_status;//off
  float current_status;
  float voltage_status;
};

struct query_packet_to_hub
{
  unsigned int hub_id;
  unsigned int own_node_id;
  unsigned int type_of_msg;
  unsigned int ldr_status;//low
  unsigned int light1;//off
  unsigned int light2;//off
  unsigned int pir_status;//low
  float current_status;
  float voltage_status;
};

char state = POLL;

struct packet_from_hub received_packet;
struct packet_from_node packet_to_send;
struct node_status status_of_lights;
struct sensor_status status_of_sensors;
struct query_packet_to_hub query_to_hub;



void setup() 
{
  Serial.begin(9600);
  
  Serial.println("started node id");
  Serial.println("1");
  pinMode(pir,INPUT);
  pinMode(ldr,INPUT);
  pinMode(current,INPUT);
  pinMode(voltage,INPUT);
  pinMode(led1,OUTPUT);
  pinMode(led2,OUTPUT);
  //  pinMode(led3,OUTPUT);
  digitalWrite(led1,LOW);
  digitalWrite(led2,LOW);
  //digitalWrite(led3,LOW);
  timer1_init();
}

void loop() 
{ 
  
  switch(state)
  {
    case POLL:
      serialPoll();
      ldrPoll();
      break;
    case TRANSMIT_EVENT_TO_PI:
      Serial.print('$');
      Serial.print(packet_to_send.package_type);
      Serial.print(',');
      Serial.print(packet_to_send.hub_id);
      Serial.print(',');
      Serial.print(packet_to_send.own_node_id);
      Serial.print(',');
      Serial.print(packet_to_send.type_msg);
      Serial.print(',');
      Serial.print(packet_to_send.msg);
      Serial.print('#');
      delay(500);
      state = POLL;
      break;
    case SERVICE_CMD:
      
      received_packet.msg = received_packet.msg - 48;
      if(received_packet.msg == 4 || received_packet.msg == 5)
      {
        status_of_lights.light2 = ON;
        digitalWrite(led2,HIGH);//maybe pwm...
      }
      if(received_packet.msg == 0)
      {
        status_of_lights.light1 = OFF;
        status_of_lights.light2 = OFF;
        digitalWrite(led1,LOW);
        digitalWrite(led2,LOW);
      }
      if(received_packet.msg == 1)
      {
        status_of_lights.light1 = DIM;
        analogWrite(led1,DIM_VALUE);
        //pwm
      }
      if(received_packet.msg == 6)
      {
        status_of_lights.light1 = ON;
        status_of_lights.light2 = ON;
        
        digitalWrite(led1,HIGH);
        digitalWrite(led2,HIGH);
      }
      delay(500);
      state = POLL;
      break;
     case SERVICE_QUERY:
       query_to_hub.hub_id = HUB_ID;
       query_to_hub.own_node_id = NODE_ID;
       query_to_hub.type_of_msg = MSG_TYPE_QUERY_ANS;
       query_to_hub.ldr_status = status_of_sensors.ldr_status;
       query_to_hub.light1 = status_of_lights.light1;
       query_to_hub.light2 = status_of_lights.light2;
       query_to_hub.pir_status = status_of_sensors.pir_status;
       query_to_hub.current_status = status_of_sensors.current_status;
       query_to_hub.voltage_status = status_of_sensors.voltage_status;
       Serial.print('$');
        Serial.print('N');
        Serial.print(',');
        Serial.print(query_to_hub.hub_id);
        Serial.print(',');
        Serial.print(query_to_hub.own_node_id);
        Serial.print(',');
        Serial.print(query_to_hub.type_of_msg);
        Serial.print(',');
        Serial.print(query_to_hub.ldr_status);
        Serial.print(',');
        Serial.print(query_to_hub.light1);
        Serial.print(',');
        Serial.print(query_to_hub.light2);
        Serial.print(',');
        Serial.print(query_to_hub.pir_status);
        Serial.print(',');
        Serial.print(query_to_hub.current_status);
        Serial.print(',');
        Serial.print(query_to_hub.voltage_status);
        Serial.print('#');
        delay(500);
        state = POLL;
        break;
  }
  delay(500);
  
  
}

void ldrPoll()
{
  float ldr_voltage_val = sense_ldr();
  if(ldr_voltage_val >= 2.0)
  {
    status_of_sensors.ldr_status = NIGHT;
  }
  else
  {
    status_of_sensors.ldr_status = DAY;
  }
  if(status_of_sensors.ldr_status != previous_ldr_state)
  {
    if(status_of_sensors.ldr_status == NIGHT)
    {
      packet_to_send.package_type = 'N';
      packet_to_send.hub_id = HUB_ID;
      packet_to_send.own_node_id = NODE_ID;
      packet_to_send.type_msg = MSG_TYPE_EVENT;
      packet_to_send.msg = packet_to_send.msg | 0x18;
      attachInterrupt(pir_interrupt, pir_isr, CHANGE);
    }
    else 
    {
      digitalWrite(led1,LOW);
      status_of_lights.light1 = OFF;
      packet_to_send.package_type = 'N';
      packet_to_send.hub_id = HUB_ID;
      packet_to_send.own_node_id = NODE_ID;
      packet_to_send.type_msg = MSG_TYPE_EVENT;
      packet_to_send.msg = packet_to_send.msg | 0x08;
      detachInterrupt(pir_interrupt);
      timer1_stop();
    }   
    state = TRANSMIT_EVENT_TO_PI;
   
    previous_ldr_state = status_of_sensors.ldr_status;
  }
}    


float sense_voltage()
{
  return ( (float)analogRead(voltage) * VREF /1023.0);
}

float sense_current()
{
  return ( (float)analogRead(current)  * VREF /(1023.0 *  1.8 * 0.3));
}

float sense_ldr()
{
  return ( (float)analogRead(ldr) * VREF /1023.0);
}


void pir_isr()
{
  status_of_sensors.pir_status = digitalRead(pir);
  if(previous_pir_state == 0 && status_of_sensors.pir_status == 1)
  {
    previous_pir_state = 1;
    
  }
  else if(previous_pir_state == 1 && status_of_sensors.pir_status == 0)
  {
    previous_pir_state = 0;
    digitalWrite(led1,HIGH);
    status_of_lights.light1 = ON;
    packet_to_send.package_type = 'N';
    packet_to_send.hub_id = HUB_ID;
    packet_to_send.own_node_id = NODE_ID;
    packet_to_send.type_msg = MSG_TYPE_EVENT;
    packet_to_send.msg = packet_to_send.msg | 0x03;
    state = TRANSMIT_EVENT_TO_PI;
    timer1_start();
  }
}

void serialPoll() 
{
    char rec_data;
    while (Serial.available()) 
    {
      rec_data = Serial.read();
      if(rec_data == '$')
      {
        serial_started = 1;
        serial_stop = 0;
        i = 0;
       
      }
      if(serial_started = 1)
      {
        if(rec_data == '#')
        {
          serial_stop = 1;
          serial_started = 0;
        }
        if(serial_stop == 0)
        {
          if(i<11)
          {
            
            
            buffer[i] = rec_data;
            i++;
          }
        }
        else if(serial_stop == 1 && i == 10)
        {
          
          data_packet_valid = 1;
          
          serial_stop = 0;
          i=0;
          
        }
        else if(serial_stop == 1 && i != 10)
        {
          data_packet_valid = 0;
          serial_stop = 0;
          i=0;
        }
      }
    }
    if(data_packet_valid == 1)
    {
       
       data_packet_valid = 0;
       received_packet.package_type = buffer[1]; 
       received_packet.hub_id = buffer[3]; 
       received_packet.node_id = buffer[5]; 
       received_packet.type_msg = buffer[7]; 
       received_packet.msg = buffer[9]; 
       
       if(received_packet.hub_id == (HUB_ID + 48) && received_packet.node_id == (NODE_ID+48))
       {
             
           if(received_packet.type_msg == (MSG_TYPE_CMD+48))
             {
               state = SERVICE_CMD;
               
               
             }
             if(received_packet.type_msg == (MSG_TYPE_QUERY + 48))
             {
               state = SERVICE_QUERY;
               
             }
        }
        
    }
}
  
   

void timer1_init(void)
{
	TCCR1B = 0x00; //Timer 3 stopped
	TIMSK1 = 0x00; //Interrupt disabled
	TCCR1A = 0x00;
	TCNT1H = 0x00; //Counter higher 8 bit value
	TCNT1L = 0x00; //Counter lower 8 bit value
	OCR1AH = 0x00; //Output compare Register (OCR)- Not used
	OCR1AL = 0x00; //Output compare Register (OCR)- Not used
	OCR1BH = 0x00; //Output compare Register (OCR)- Not used
	OCR1BL = 0x00; //Output compare Register (OCR)- Not used

}

void timer1_start()
{
  double temp_timer1_load=0.0,timer_clk=0.0;
  int timer1_load;
  timer_clk = 16;
  temp_timer1_load = (4000000.0 * timer_clk)/1024; //for 1s timer
  timer1_load = round(temp_timer1_load);
  timer1_load = 65536 - timer1_load;
  TCNT1H = (timer1_load >> 8);
  TCNT1L = timer1_load ;
  TIMSK1 = 0x01;
  TCCR1B = 0x05;
  
}
void timer1_stop(void)
{
	TIMSK1 = 0x00;
	TCCR1B = 0x00;
}
ISR(TIMER1_OVF_vect)
{
	TIMSK1 = 0x00;
	TCCR1B = 0x00;
        status_of_lights.light1 = DIM;
        analogWrite(led1,DIM_VALUE);
	packet_to_send.package_type = 'N';
        packet_to_send.hub_id = HUB_ID;
        packet_to_send.own_node_id = NODE_ID;
        packet_to_send.type_msg = MSG_TYPE_EVENT;
        packet_to_send.msg = packet_to_send.msg | 0x04;
        state = TRANSMIT_EVENT_TO_PI;
        
}

