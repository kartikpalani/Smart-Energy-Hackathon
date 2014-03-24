Smart Chairs
========================

Team Energon has made a hack called "Smart chair" in smart energy hackathon 2014 held at Seil,KReSIT,IIT,Bombay

Team members:

Samrudha Kelkar

Nimish Kothari

Idea: Smart chair utilizes most natural input given by user i.e. weight on chair and distance from back as an input to the system to switch ON/OFF the monitor screen of workstation. It sends serial data to the workstation  over a USB cable. 
Same cable is used to power up the setup. Security feature is provided, so that when unknown/guest person sits on the chair, system will log off from windows. When known person sits, system can be used again from where user left.   


Here is the documentation for the same.

Part 1: Circuit diagram
	   
Part 2: Experimental set-up diagram
	   
Part 3: Arduino code
	   
Part 4: Python code

	   
	   

Components used:
Arduino Uno, 
Hx711 module (24 bit ADC),
Load cell (10Kg capacity), 
HC-SR04 Ping distance sensor,
Laptop,
Connectors, breadboard, chair, foam,

Description:

Part 1: circuit diagram of the image is shown in "smartchair-circuitdiagram.jpg".

Part 2: Experimental setup is shown in image file "smartchair-experimental setup.jpg" in the Energon. It depicts the workspace environment where smart-chair can be used.
 
Part 3: It is arduino code for fusion of sensors: load cell (Hx711)and ultrasonic sensor(HC-SR04). 
Ref: git source-> https://github.com/bogde/HX711

Part 4: It has python script which receives data on serial port and use it for operations like monitor On/OFF, cursor movement, log off from windows etc...
Currently monitor ON/OFF functionality is made using application MonitorOff.exe
Its path MUST be included in the python script for proper operation. MonitorOff.exe is used from open source code available on internet. But system calls in Python using "os.subprogram" also can do the same functionality.

