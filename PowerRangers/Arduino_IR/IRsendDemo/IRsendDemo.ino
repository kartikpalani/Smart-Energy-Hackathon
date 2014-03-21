
/*
 * IRremote: IRsendDemo - demonstrates sending IR codes with IRsend
 * An IR LED must be connected to Arduino PWM pin 3.
 * Version 0.1 July, 2009
 * Copyright 2009 Ken Shirriff
 * http://arcfn.com
 */

#include "IRremote.h"

IRsend irsend;
int led = 3;
int signal=2;
int old_sel=1;
int new_sel=0;

void setup(){
  pinMode(led, OUTPUT);  
  pinMode(signal,INPUT);

}

void loop()
{
      new_sel=digitalRead(signal);
      if (new_sel!=old_sel)
        {
          {
          if (new_sel==1)
            {
            digitalWrite(led, HIGH);
            irsend.sendVOLTAS(0x3000, 0x8022); // on  18 degreee Compressor
            digitalWrite(led, LOW);
            delay(1000);
            } 
          if (new_sel==0)
            {
            digitalWrite(led, HIGH);
            irsend.sendVOLTAS(0x3500, 0xA337); // on  19 degreee Fan
            digitalWrite(led, LOW);
            delay(1000);
            }  
          }
        }
        old_sel=new_sel;


/*
            digitalWrite(led, HIGH);
            irsend.sendVOLTAS(0x3000, 0x8022); // on  18 degreee
            digitalWrite(led, LOW);
            delay(1000);


            digitalWrite(led, HIGH);
            irsend.sendVOLTAS(0x3500, 0xA337); // on  18 degreee
            digitalWrite(led, LOW);
            delay(1000);
*/

}

