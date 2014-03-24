Project Name: Smart Street Light System
=======================

-> This project was a result of Hackathon held at IIT Bombay on 22-23 March,2014.

-> Team Members:

 -Prashant Rupapara
 
 -Shreyas Shyamsunder
 
 -Bhaskar Bandyopadhyay 
 
 -Shailesh Jain 

System Overview:


 - Major components of the system are Web Server, Hubs and Nodes. 
 
 - To know how they communicate with each other, you can refer to "System Architecture.pdf".
 
 - Each node is basically a street light which can control light, sense ambient light & motion in front of street light, measure current and voltage consumed by street light. Node also has a xbee for communication.
 
 - Each hub is a linux based small board(you can use either raspberry pi or beagle bone black or any similar board (even your PC for testing)). Hub also has xbee to communicate with nodes.
 
 - Hub communicates with web server via TCP/IP and regularly updates status of each of the node. 
 
 - for detailed information about hub and node, you can refer to FSMs
 
 
