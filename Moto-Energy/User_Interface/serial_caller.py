#calls the serial port reader script after each 5 seconds to get the new value of serial port in the browser via HTML
import csv,os
import serial_reader
#trydemo.myfn()
import time 
while True:
    serial_reader.myfn()
    time.sleep(5) 
