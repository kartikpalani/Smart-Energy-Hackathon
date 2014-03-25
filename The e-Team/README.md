Smart Sensor Fusion for Occupancy Detection and Human Counting
==========
 - The e-Team


Team Members:
=======
 - Piyush Manavar
 - Sanam Shakya
 - Saurav Shandilya
 - Vishwanathan Iyer
	
	
Idea:
=======

Our sensing system uses integration of interruption counter, Passive Infrared (PIR) motion sensors and camera to detect count, occupancy, authenticate user and switch lights in specific region on room. Data regarding entry, exit, occupancy/non-occupancy in region is received and stored in database along with time stamp for future analysis. 


 - Interruption counter gives count of person entering and/or leaving a room. It comprises of LASER as light source and LDR as detector. 
 - Whenever a person enter/exit from a room, count is recorded in the system and triggers camera to capture human face and run face recognition algorithm. 
 - For sensing the  human subject in area PIR motion sensor is used. Where motion sensors are mounted in two different regions in a room covering entire room. Based on region in which person is detected, Fan is switched on respective region.Motion sensor data predict the location of room which is occupied. 
 - Camera is used for detecting human entering a room. A face recognition algorithm is able to detect and recognise human registered in the system.
 - Data regarding entry/exit count, occupancy/non-occupancy is stored along with time-stamp in database. This can be used for further analysis and visualization. 
 
Future Enhancements:
======
 - System can be scaled up to control tube-light, fan, AC and other appliance of rooms. Necessary modification may require permission from department.   
 - Enhancement in face recognition algorithm with moving people.
 - Whenever a person enters a room, he/she can be recognised and by using machine learning algorithm specific user profile can be upload for example set on their PC, lights near their area.  


 
 
  

