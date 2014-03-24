import serial
import time
import subprocess
import win32api
import win32con


port = "COM3"
ser = serial.Serial(port,38400)
value = 0
loadmin1=-200
loadmin2=1400
loadmax1=200
loadmax2=1700
out = ''
dist = ''
L=''
k=1
shutdown =0
cursor=0
def click(x,y):
    win32api.SetCursorPos((x,y))
    win32api.mouse_event(win32con.MOUSEEVENTF_LEFTDOWN,x,y,0,0)
    win32api.mouse_event(win32con.MOUSEEVENTF_LEFTUP,x,y,0,0)
while 1:
    time.sleep(1)
    while ser.inWaiting() > 0:
           line = ser.readline()
           a,b =line.split("L")
           c,dist=a.split("D")
           load,e=b.split("#")
           load=int(float(load))
           loadmin1=float(loadmin1)
           loadmax1=float(loadmax1)
           #if load < 0:
           #     load=load*(-1)
            
             
           if dist == "-1":
               subprocess.call(['C:\Users\Sam\enrgHack14\MonitorOff_1_02\MonitorOff.exe'])
               if load<loadmax1 and load > loadmin1:
                  print "screenOFF"
                  subprocess.call(['C:\Users\Sam\enrgHack14\MonitorOff_1_02\MonitorOff.exe'])
                  k=0
               
               else:
                  subprocess.call('shutdown /l')
                  
           else:
                 
                 if load<loadmax1 and load> loadmin1:
                     if cursor==1:
                       print "Load:"
                       print load
                       break
                     else :
                       click(10,10)
          
                       click(1000,1000)
                       click(10,10)
                       cursor=1
                       print "Load:"
                       print load
                 else:
                    if shutdown==1:
                               print "Unknown Person:"
                               print load
                      
                    else:
                              subprocess.call('shutdown /l') 
                              shutdown=1
                     
           print "dist" 
           print dist
           print "load"
           print load
           