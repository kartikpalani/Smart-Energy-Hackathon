int led = 3;
int led2 = 4;
int current = A1;
float current_val = 0.0;
float voltage_val = 0.0;
float VREF = 4.56;
int ldr = A0;
float ldr_voltage_val = 0.0;
void setup() 
{
  Serial.begin(9600);
  Serial.println("started");
  pinMode(led,OUTPUT);
  pinMode(led2,OUTPUT);
  
  pinMode(current,INPUT);
  digitalWrite(led,HIGH);
  digitalWrite(led2,HIGH);
  pinMode(ldr,INPUT);
}

void loop() 
{
  float adc_cnt = (float)analogRead(current);
  voltage_val = adc_cnt * VREF /1023.0;
  adc_cnt = (float)analogRead(ldr);
  ldr_voltage_val = adc_cnt * VREF /1023.0;
  current_val = voltage_val / ( 1.8 * 0.33);
  Serial.print("voltage : ");
  Serial.print(voltage_val);
  Serial.print("V Current : ");
  Serial.print(current_val);
  Serial.println("mA");
  Serial.print("ldr voltage : ");
  Serial.print(ldr_voltage_val);
  Serial.println("V");
  if (Serial.available() > 0) 
  {
    char rec_data = Serial.read();
    if(rec_data == 'a')
    {
      digitalWrite(led,HIGH);
      digitalWrite(led2,HIGH);
      Serial.println("led on");
    }
    else if(rec_data == 's')
    {
      digitalWrite(led,LOW);
      digitalWrite(led2,LOW);
      Serial.println("led off");
    }
  }
  delay(500);
}
