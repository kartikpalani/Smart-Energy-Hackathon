#include "HX711.h"
//ultrasonic part
#define echoPin 7 // Echo Pin
#define trigPin 8 // Trigger Pin
#define LEDPin 13 // Onboard LED
// HX711.DOUT	- pin #A1
// HX711.PD_SCK	- pin #A0

int maximumRange = 200; // Maximum range needed
int minimumRange = 0; // Minimum range needed
long duration, distance; // Duration used to calculate distance


HX711 scale(A1, A0);		// parameter "gain" is ommited; the default value 128 is used by the library

void setup() {
  Serial.begin(38400);
  //ultrasonic
  pinMode(trigPin, OUTPUT);
 pinMode(echoPin, INPUT);
 pinMode(LEDPin, OUTPUT); // Use LED indicator (if required)
 
  
 // Serial.println("HX711 Demo");

  //Serial.println("Before setting up the scale:");
  //Serial.print("read: \t\t");
 // Serial.println(scale.read());			// print a raw reading from the ADC
  scale.read();

 // Serial.print("read average: \t\t");
 // Serial.println(scale.read_average(20));  	// print the average of 20 readings from the ADC
  scale.read_average(20);

  //Serial.print("get value: \t\t");
  //Serial.println(scale.get_value(5));		// print the average of 5 readings from the ADC minus the tare weight (not set yet)
  scale.get_value(5);

//  Serial.print("get units: \t\t");
 // Serial.println(scale.get_units(5), 1);	// print the average of 5 readings from the ADC minus tare weight (not set) divided 
						// by the SCALE parameter (not set yet)  
scale.get_units(5);

  scale.set_scale(80.f);                      // this value is obtained by calibrating the scale with known weights; see the README for details
  scale.tare();				        // reset the scale to 0

//  Serial.println("After setting up the scale:");

//  Serial.print("read: \t\t");
//  Serial.println(scale.read());                 // print a raw reading from the ADC
  scale.read();

//  Serial.print("read average: \t\t");
//  Serial.println(scale.read_average(20));       // print the average of 20 readings from the ADC
scale.read_average(20);

//  Serial.print("get value: \t\t");
//  Serial.println(scale.get_value(5));		// print the average of 5 readings from the ADC minus the tare weight, set with tare()
scale.get_value(5);

 // Serial.print("get units: \t\t");
//  Serial.println(scale.get_units(5), 1);        // print the average of 5 readings from the ADC minus tare weight, divided 
						// by the SCALE parameter set with set_scale
scale.get_units(5);

 // Serial.println("Readings:");
}

void loop() {
   Serial.print("$");
  /* The following trigPin/echoPin cycle is used to determine the
 distance of the nearest object by bouncing soundwaves off of it. */ 
 digitalWrite(trigPin, LOW); 
 delayMicroseconds(2); 

 digitalWrite(trigPin, HIGH);
 delayMicroseconds(10); 
 
 digitalWrite(trigPin, LOW);
 duration = pulseIn(echoPin, HIGH);
 
 //Calculate the distance (in cm) based on the speed of sound.
 distance = duration/58.2;
  Serial.print("D");
 if (distance >= maximumRange || distance <= minimumRange){
 /* Send a negative number to computer and Turn LED ON 
 to indicate "out of range" */
 Serial.print("-1");
 digitalWrite(LEDPin, HIGH); 
 }
 else {
 /* Send the distance to the computer using Serial protocol, and
 turn LED OFF to indicate successful reading. */
 
 Serial.print(distance);
 digitalWrite(LEDPin, LOW); 
 }
//  Serial.print("one reading:\t");
   Serial.print("L");
  Serial.print(scale.get_units(), 1);
//  Serial.print("\t| average:\t");
 // Serial.println(scale.get_units(10), 1);
   Serial.println("#");
  scale.power_down();			        // put the ADC in sleep mode
  delay(1000);
  scale.power_up();
}
