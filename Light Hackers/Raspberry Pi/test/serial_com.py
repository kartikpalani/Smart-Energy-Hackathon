#!/usr/bin/python
import threading
import serial
import sys


class serial_reader_thread (threading.Thread):
    def __init__(self, threadID):
        threading.Thread.__init__(self)
        self.threadID = threadID;
    def run(self):
        print "Starting " + str(self.threadID);
        read();
        print "Exiting " + str(self.threadID);

def read():
    try:
        while 1:
            rec_data = con.read(1);
            sys.stdout.write(rec_data);
            sys.stdout.flush();
    except serial.SerialException:
        print "connection error";
     
def write(): 
    try:
        con.write("a");
    except serial.SerialException:
        print "connection error";    
con = serial.Serial(port = "/dev/ttyAMA0", baudrate=9600);
con.close();
con.open();
if con.isOpen():
    thread1 = serial_reader_thread(1);
    thread1.start();
    write();
    while 1:
        pass;
con.close();
