/**************************************************
Author: Piyush Manavar
		Sanam Shakya
		Saurav Shandilya
		Vishwanathan Iyer

Date: 22-23 March,2014

OS: Windows 8.1
IDE: Atmel Studio 6.2


****************************************************/		


#define F_CPU 14745600
#include <avr/io.h>
#include <avr/interrupt.h>
#include <util/delay.h>
#include <stdio.h>
#include "lcd.c"

// Variable Declaration
 
unsigned char inward, outward;
unsigned char entry, out;
unsigned char count;
unsigned char overflow;
signed char inside, outside;
unsigned char degree;
unsigned int  time;
unsigned char buffer[8];
unsigned char Data_buffer[6];
unsigned char j = 0;			
unsigned char pir_detection1=0;
unsigned char pir_detection2=0;
unsigned char ONED,TWOD;

/*********************************
Function to configure LCD port
PORTC connected to 16x2 LCD 
Lowe nibble 0-3 connected to data bus 0-3 of LCD
PIN 7 is connected to Buzzer
**********************************/
void lcd_port_config (void)
{
	DDRC = DDRC | 0xF7;      // all the LCD pin's direction set as output
	PORTC = PORTC & 0x80;    // all the LCD pins are set to logic 0 except PORTC 7
}


/*********************************
USART0 Initialization for USB communication
Baud Rate :9600
Stop Bit: 1
Parity Bit : No
*********************************/
void uart0_init(void)
{
	UCSR0B = 0x00; //disable while setting baud rate
	UCSR0A = 0x00;
	UCSR0C = 0x06;
	UBRR0L = 0x07; //set baud rate lo
	UBRR0H = 0x00; //set baud rate hi
	UCSR0B = 0x98;
}

/*************************************
Function to configure INT4 (PORTE 4) pin as input for the entry sensor
*************************************/
void ldr1_pin_config (void)
{
	DDRE  = DDRE & 0xEF;  //Set the direction of the PORTE 4 pin as input
	PORTE = PORTE | 0x10; //Enable internal pull-up for PORTE 4 pin
}

/*************************************
Function to configure INT5 (PORTE 5) pin as input for the Exit sensor
*************************************/
void ldr2_pin_config (void)
{
	DDRE  = DDRE & 0xDF;  //Set the direction of the PORTE 5 pin as input
	PORTE = PORTE | 0x20; //Enable internal pull-up for PORTE 4 pin
}

/**************************************
Servo Connected to PORTB pin 6 and 7 for rotation of sensor 1 and 2 
PWM channel initialization as out put for PORTB
**************************************/
void servo_pin_config (void)
{
	DDRB  = DDRB | 0x40;  //making PORTB 6 pin output for PWM 1
	PORTB = PORTB | 0x40; //setting PORTB 6 pin to logic 1
	DDRB  = DDRB | 0x80;  //making PORTB 7 pin output for PWM 2
	PORTB = PORTB | 0x80; //setting PORTB 7 pin to logic 1
}

/******************************************
Initialization of PIR sensor input pin as INPUT 
PIR  is connected to PORTE 
******************************************/
void pir_input_pin (void)
{
	DDRE = DDRE & 0x7F;  	//PORTE 7 pin set as input for PIR2
	PORTE = PORTE | 0x80; 	//PORTE7 internal pull-up enabled
	DDRE = DDRE & 0xBF; 	//PORTE 6 pin set as input for PIR2
	PORTE = PORTE | 0x40; 	//PORTE7 internal pull-up enabled
}

/*****************************************
Function to on the buzzer 
Will not affect other port pins
*****************************************/
void buzzer_on (void)
{
	unsigned char port_restore = 0;			
	port_restore = PINC;						// store the previous value 
	port_restore = port_restore | 0x08;			// AND operation with pin to do not disturb other pin 
	PORTC = port_restore;						// Write to port pin 
}

/*****************************************
Function to off the buzzer 
Will not affect other port pins
*****************************************/
void buzzer_off (void)
{
	unsigned char port_restore = 0;				
	port_restore = PINC;						// store the previous value 
	port_restore = port_restore & 0xF7;			// AND operation with pin to do not disturb other pin
	PORTC = port_restore;						// Write to port pin 
}

/*****************************************
Function to set buzzer PIN as a out put pin
Buzzer is connected to PORTC 3
*****************************************/
void buzzer_pin_config (void)
{
	DDRC = DDRC | 0x08;   						//Setting PORTC 3 as output
	PORTC = PORTC & 0xF7; 						//Setting PORTC 3 logic low to turn-off buzzer
}
/*****************************************
Function to initialize necessary PORT 
*****************************************/
void port_init()
{
	lcd_port_config();				//lcd config
	buzzer_pin_config();			//Buzzer pin config
	uart0_init();					//USART0 COnfig
	ldr1_pin_config();				//LDR_1 config
	ldr2_pin_config();				//LDR_2 pin config
	servo_pin_config(); 			//Configure PORTB pin for servo motor operation 
	pir_input_pin();				//PIR sensor pin config
}

/********************************************
Function to initialize PORT pin as interrupt 4 input pin
Interrupt 4 pin is connected to entry sensor 
********************************************/ 
void interrupt4_init (void) 	//Interrupt 4 enable
{
	cli(); 										//Clears the global interrupt
	EICRB = EICRB | 0x02; 						// INT4 is set to trigger with falling edge
	EIMSK = EIMSK | 0x10; 						// Enable Interrupt INT4 for left position encoder
	sei();   									// Enables the global interrupt
}

/********************************************
Function to initialize PORT pin as interrupt 5 input pin
Interrupt 4 pin is connected to EXIT sensor 
********************************************/ 
void interrupt5_init (void) //Interrupt 5 enable
{
	cli(); 											//Clears the global interrupt
	EICRB = EICRB | 0x08; 							// INT5 is set to trigger with falling edge
	EIMSK = EIMSK | 0x20; 							// Enable Interrupt INT5 for right position encoder
	sei();   										// Enables the global interrupt
}

/*******************************************
TIMER1 initialization in 10 bit fast PWM mode  
prescale:256
WGM: 7) PWM 10bit fast, TOP=0x03FF
actual value: 52.25Hz 
*******************************************/
void timer1_init(void)
{
 TCCR1B = 0x00; 	//stop
 TCNT1H = 0xFC; 	//Counter high value to which OCR1xH value is to be compared with
 TCNT1L = 0x01;		//Counter low value to which OCR1xH value is to be compared with
 OCR1AH = 0x03;		//Output compare Register high value for servo 1
 OCR1AL = 0xFF;		//Output Compare Register low Value For servo 1
 OCR1BH = 0x03;		//Output compare Register high value for servo 2
 OCR1BL = 0xFF;		//Output Compare Register low Value For servo 2
 OCR1CH = 0x03;		//Output compare Register high value for servo 3
 OCR1CL = 0xFF;		//Output Compare Register low Value For servo 3
 ICR1H  = 0x03;	
 ICR1L  = 0xFF;
 TCCR1A = 0xAB; 	/*{COM1A1=1, COM1A0=0; COM1B1=1, COM1B0=0; COM1C1=1 COM1C0=0}
						For Overriding normal port functionality to OCRnA outputs.
						{WGM11=1, WGM10=1} Along With WGM12 in TCCR1B for Selecting FAST PWM Mode*/
 TCCR1C = 0x00;
 TCCR1B = 0x0C; 	//WGM12=1; CS12=1, CS11=0, CS10=0 (Prescaler=256)
}

/******************************************
Relay port pin initialization
Relay is connected to PORTJ 
******************************************/ 
void relay_port (void)
{
	DDRJ = 0xFF;  	//PORT J is configured as output
	PORTJ = 0x00; 	//Output is set to 0 initially 
}

/********************************************
Function to initialize devices connected to micro controller 
********************************************/  
void init_devices (void)
{
	cli(); 					//Clears the global interrupts
	port_init();			// All devices port initialization connected to uc
	interrupt4_init();		//Interrupt 4 initialize
	interrupt5_init();		//Interrupt 5 initialize
	timer1_init();			//Timer1 initialize
	relay_port();			//relay port initialize
	sei(); 					//Enables the global interrupts
}

/**********************************************
interrupt service routine for interrupt5_init
**********************************************/
ISR(INT5_vect)
{
	inward++;  //increment right shaft position count
	entry=1;
}


/**********************************************
interrupt service routine for interrupt4_init
**********************************************/
ISR(INT4_vect)
{
	outward++;  //increment left shaft position count
	out=1;
}
/***********************************************
Function to rotate Servo 3 by a specified angle in the multiples of 1.86 degrees
***********************************************/
void servo_3(unsigned char degrees)
{
	float PositionServo = 0;
	PositionServo = ((float)degrees / 1.86) + 35.0;
	OCR1CH = 0x00;
	OCR1CL = (unsigned char) PositionServo;
}

/***********************************************
Function to rotate Servo 2 by a specified angle in the multiples of 1.86 degrees
***********************************************/
void servo_2(unsigned char degrees)
{
	float PositionTiltServo = 0;
	PositionTiltServo = ((float)degrees / 1.86) + 35.0;
	OCR1BH = 0x00;
	OCR1BL = (unsigned char) PositionTiltServo;
}

/***********************************************
Function for transmitting a char via serial communication
***********************************************/
void uart0_tx_char(unsigned char data)
{
	while(!(UCSR0A & (1<<UDRE0)));
	UDR0 = data;
}

/***************************************************
Function to transmit a string via serial communication 
***************************************************/
void uart0_tx_str(const unsigned char *str)
{
	while(1)
	{
		if( *str == '\0' )		// checking for termination of string (nul char)
		break;
		uart0_tx_char(*str++);	//Transmit next char
	}
}

/****************************************************
Function to print and frame a string via serial communication
****************************************************/
void serial_print_data(const unsigned char *Data_buffer)
	{
	uart0_tx_char(36); 									//starts new transmission with dollar
	uart0_tx_char(44);									//comma  
	for(j=0;j<4;j++)
		{
		sprintf(buffer,"%d",Data_buffer[j]);
		uart0_tx_str((const unsigned char *)buffer);
		uart0_tx_char(44);								//comma between each data
		}
	
	uart0_tx_char(10);									//newline after end of transfer of one set of data 
	uart0_tx_char(13);									//carriage return
	}

/****************************************************
Function to read sensors value via serial communication
****************************************************/
void send_all_data()
	{
	Data_buffer[0] = inside;
	Data_buffer[1] = outside;
	Data_buffer[2] = pir_detection1;
	Data_buffer[3] = pir_detection2;
	serial_print_data(Data_buffer);
	}
	
/****************************************************
Detection of PIR sensor 
updated a char pir_detection1 and pir_detection2 to 1 if detection happen 
otherwise makes it 0 for non detection
****************************************************/
void PIR(void)
	{
	cli();									//Disable interrupt 
	pir_detection1=0;						//Initially make 0 
	pir_detection2=0;
	TWOD=0;									//clear char initially
	ONED=0;
	for(degree=0;degree<=180;degree++)		//Scan servo from 0 to 180 degree 
		{		
		servo_3(degree);
		servo_2(degree);
		if((PINE & 0x80) == 0x80) 			//check if any detection for PIR sensor 1
			{
			lcd_cursor(2,15);
			lcd_string("2D");
			pir_detection2=1;
			TWOD=1;
			PORTJ|=0x0F;
			}
		else								
			{
			lcd_cursor(2,15);
			lcd_string("2N");
			}
		if((PINE & 0x40) == 0x40) 			//check if any detection for PIR sensor 2	
			{
			lcd_cursor(1,15);
			lcd_string("1D");
			pir_detection1=1;
			ONED=1;
			PORTJ|=0xF0;
			}
			else
			{
			lcd_cursor(1,15);
			lcd_string("1N");				
			}
		}
		sei();
	}

//Main Function
int main(void)
	{
	init_devices();					//Initialization all the devices 
	lcd_init();                     // initialize the LCD with its commands
	lcd_cursor(1,1);				// Default position of LCD
	lcd_string("Wel-Come");			//Wel-Come massage 
	lcd_cursor(2,1);				
	lcd_string("The e-Team");		
	_delay_ms(2000);
	pir_detection1=0xff;			//Ideal value of PIR1 sensor detection 
	pir_detection2=0xff;			//Ideal value of PIR2 sensor detection 
	while(1)
		{
		if(time>=200)					// timer condition for PIR check periodically 
			{
			PIR();						//Checking detection
			time=0;						//timer condition rest for periodically check
			}
		send_all_data();				//Send data to PC 
		if(pir_detection1<=1)			//Rest PIR1 sensor to its ideal state 
			{
			pir_detection1=0xff;
			}
		if(pir_detection2<=1)			//Rest PIR1 sensor to its ideal state 
			{
			pir_detection2=0xff;	
			}
		count= inside-outside;			// Get count of present no. of person inside
		if(ONED==1)						// If any present in room make appliance on otherwise off for sensor 1
			{
			PORTJ|=0xF0;
			}
		else
			{ PORTJ &=0x0F;
			}
		if(TWOD==1)						// If any present in room make appliance on otherwise off for sensor 2
			{
			PORTJ|=0x0F;
			}
		else
			{ PORTJ &=0xF0;
			}
		
		if(entry==1)					// condition for checking entry 
			{
			out =0;
			count=0;
			overflow=0;
			while(out==0)				//wait for complete the entry 
				{				
				i++;
				lcd_print(1,9,i,3);		//Print status on LCD
				//send_all_data();
				if(i>=200)				// Condition for false entry 
					{
					overflow=1;
					out = 0;
					break;
					}
				}
			if(overflow==0)				// If entry is success then increment inside count 
				{
				inside++;
				buzzer_on();
				_delay_ms(100); //delay
				buzzer_off();
				//send_all_data();
				}
			i=0;
			out=0;
			overflow=0;
			entry=0;
			//EIMSK= EIMSK | 0x20;
		}
		if(out==1)						// condition for checking Exit
			{
			//	EIMSK= EIMSK & 0xEF;
			entry=0;
			count=0;
			overflow=0;
			while(entry==0)				//wait for complete the Exit
			{
				//_delay_ms(10);
				i++;
				lcd_print(2,9,i,3);
				//send_all_data();
				if(i>=200)				// Condition for false Exit
				{
					overflow=1;
					entry=0;
					break;
				}
			}
			if(overflow==0)				// If entry is success then Exit inside count 
				{
				outside++;
				buzzer_on();
				_delay_ms(100); 		//delay
				buzzer_off();
				//	send_all_data();
				}
			i=0;
			entry=0;
			overflow=0;
			out=0;
		//	EIMSK= EIMSK | 0x10;
		}
		lcd_print(1,1,inside,3);
		lcd_print(1,5,outside,3);
		time++;
		lcd_print(2,1,time,3);
		lcd_print(2,12,(inside-outside),3);
	//	lcd_print(2,1,Left,4);
	//	lcd_print(2,6,Right,4);
	//	send_all_data();
	}	
}

//// Working code//////