/*
 * IRremote: IRsendDemo - demonstrates sending IR codes with IRsend
 * An IR LED must be connected to Arduino PWM pin 3.
 * Version 0.1 July, 2009
 * Copyright 2009 Ken Shirriff
 * http://arcfn.com
 */

#include "IRremote.h"

IRsend irsend;
int led = 13;
void setup()
{
  pinMode(led, OUTPUT);  
//  Serial.begin(9600);
}
/*
void loop() {
  if (Serial.read() != -1) {
    for (int i = 0; i < 3; i++) {
      irsend.sendSony(0xa90, 12); // Sony TV power code
      delay(40);
    }
  }
}
*/
void loop() {
//  if (Serial.read() != -1) {
//      Serial.print("Start"); 
      digitalWrite(led, HIGH);
      irsend.sendVOLTAS(0x3000, 0x00008022); // on  18 degreee
      digitalWrite(led, LOW);
      delay(100000);
      /*
      digitalWrite(led, HIGH);
//      Serial.print("1");
      irsend.sendVOLTAS(0x3000, 0x00008031); // on  19 degreee
      digitalWrite(led, LOW);
      delay(100000);
      */
/*
      digitalWrite(led, HIGH);
//      Serial.print("2");
      irsend.sendVOLTAS(0x030000, 0x00018030); // on  19 degreee
      digitalWrite(led, LOW);
      delay(100000);
      digitalWrite(led, HIGH);
//      Serial.print("3");
      irsend.sendVOLTAS(0x030000, 0x0001804F); // on  20 degreee
      digitalWrite(led, LOW);
      delay(100000);
      digitalWrite(led, HIGH);
      irsend.sendVOLTAS(0x030000, 0x0001805E); // on  21 degreee
      digitalWrite(led, LOW);
      delay(100000);
      digitalWrite(led, HIGH);
      irsend.sendVOLTAS(0x030000, 0x0001806D); // on  22 degreee
      digitalWrite(led, LOW);
      delay(100000);
      digitalWrite(led, HIGH);
      irsend.sendVOLTAS(0x030000, 0x0001807C); // on  23 degreee
      digitalWrite(led, LOW);
      delay(100000);
      digitalWrite(led, HIGH);
      irsend.sendVOLTAS(0x030000, 0x0001808B); // on  24 degreee
      digitalWrite(led, LOW);
      delay(100000);
      digitalWrite(led, HIGH);
      irsend.sendVOLTAS(0x030000, 0x0001809A); // on  25 degreee
      digitalWrite(led, LOW);
      delay(100000);
      digitalWrite(led, HIGH);
      irsend.sendVOLTAS(0x030000, 0x000180A9); // on  26 degreee
      digitalWrite(led, LOW);
      delay(100000);
      digitalWrite(led, HIGH);
      irsend.sendVOLTAS(0x030000, 0x000180B8); // on  27 degreee
      digitalWrite(led, LOW);
      delay(100000);
*/
//  }
}

