#!/usr/bin/python
'''
This program helps in doing the machine learning by running the ACs 
in all possible combinations as per given in a list.
The result is stored in a csv file called config.csv 
(using csv file is not a must. user can edit the code to use any other file as per his need)
Here we have use code from http://learn.adafruit.com/dht-humidity-sensing-on-raspberry-pi-with-gdocs-logging/software-install
 to fetch data from the AM2302 temperature sensors. Here ./Adafruit_DHT is renamed as ./hackTemp

'''
# There is scope for a lot of improvements in this code
# Code is more a prototype of the way we wanted to implement machine learning

import csv
import re
import time
import subprocess


startTime=time.time()
timeDifference=0              
oldTemperature=50.1			#setting up maximum value for old temperature and current temperature 
temper=50.1				
#this particular combination list stores the possible AC combinations
'''TODO this list can be generated in practice by any combination generating for a given set of ACs.'''

combinationList=["1,3","2,4","1,2,3","2,3,4","3,4,1","4,2,1","1,2,3,4"]

#following function fetches data from the temperature sensor
#and sets it to oldTemperature and temper
def checktemp():
    #the ./hackTemp is run with 2302 as model of sensor. 27 the pin to which sensor is connected.
    output =subprocess.check_output(["./hackTemp","2302",'27']);
    #regular expression extracts temperature data 
    matches = re.search("Temp =\s+([0-9.]+)", output)
    global oldTemperature
    global temper
    if (not matches):
	#sets oldTemperature data as current temperature data if no matches occur 
        temper=oldTemperature;
    else:
	#if match found the oldTemperature and current temperature are updated maintained
        temper=float(matches.group(1))
        oldTemperature=temper

# config.csv file stores the configuration for machine learning
with open('config.csv','wb') as csvfile:
	writer=csv.writer(csvfile)

	for comb in combinationList:
		#TODO trigger the ACs according to the combination
		lowestTemperature=50.0
		#checking temperature change for 50 min, increase the value for better results
		while (timeDifference < 3000):	
			checktemp()
			timeDifference=time.time()-startTime;
			new=str(temper)+","+str(timeDifference)
			print new
			if(temper < lowestTemperature):
				lowestTemperature=temper	
		
			time.sleep(50)
		temper=50.1
		oldTemperature=50.1
		
		writer.writerow([str(lowestTemperature)+" : "+str(comb)])
        	csvfile.flush()
	



