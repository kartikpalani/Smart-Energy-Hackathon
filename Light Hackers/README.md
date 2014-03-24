Project Name : Smart Street Light System
=======================
 
 - This project was a outcome of Hackathon held at IIT Bombay on 22-23 March,2014.


 Team Members:

 - Prashant Rupapara
 
 - Shreyas Shyamsunder
 
 - Bhaskar Bandyopadhyay 
 
 - Shailesh Jain 


 
 
 System Overview :


 - Major components of the system are Web Server, Hubs and Nodes. 
 
 - To know how they communicate with each other, you can refer to "System Architecture.pdf".
 
 - Each node is basically a street light which can control light, sense ambient light & motion in front of street light, measure current and voltage consumed by street light. Node also has a xbee for communication.
 
 - Each hub is a linux based small board(you can use either raspberry pi or beagle bone black or any similar board (even your PC for testing)). Hub also has xbee to communicate with nodes.
 
 - Hub communicates with web server via TCP/IP and regularly updates status of each of the node. 
 
 - for detailed information about hub and node, you can refer to FSMs
 
 - You can see working prototype's pics in "pics" folder.

 
 - PIR sensors that dim the lights when there's no one around. Use of LDR resistors to operate the street lights based on the sunlight intensity. 
 
 - Measure the current and voltage across each of the street light and current reading is also used to find out whether light is actually working or not. In case it is not working then server is notified for the same and in morning maintenance person will be given a list of street light with exact location to replace lights.
 
 - Motion sensor data is used along with ldr in night time to control the intensity of light as an when required. So once moving vehicle is detected, its path will be fully illuminated and after some time if there is no motion then again light will be put on dim mode. 
  
 - Once this infrastructure is installed it can be used for other applications with no added cost. for example we implemented the following,
  
  - During the daytime the Motion sensor can also be used to monitor and analyse the traffic.

  - The central server software can also be used to strobe the lights to lead police, ambulance and fire to the site of an emergency. The emergency signals generated will be processed by the server and incorporated with the street lights to provide navigation through another small light installed on each street light. So people will be ready to give path to these vehicles and not wait till they hear siren from ambulance!
  
  

