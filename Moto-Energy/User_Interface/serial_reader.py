# Reads the serial port and puts it in the HTML file to display 
import os,serial

def myfn():
    connected = False
    locations=['/dev/ttyACM0'] #port to be listened
    for device in locations:
        try:
            print "Trying...",device
            ser = serial.Serial(device, 9600)
            break
        except:
            print "Failed to connect on",device
            
    while not connected:
        serin = ser.read()
        connected = True
    colour = ["red", "red", "green", "yellow"]
    y=0
    with open('display.html', 'w') as myFile:
        myFile.write('<html>')
        myFile.write('<meta http-equiv="refresh" content="5" > ')
        myFile.write('<body>')
        myFile.write('<table border=2 align=center>')
        myFile.write('<tr><td>')
        while (y<200):
            if ser.inWaiting():
                x=ser.readline()#write the serial port data to the HTML file
                myFile.write(x)
            y = y + 1
        myFile.write('</td></tr>')
        myFile.write('</table>')
        #myFile.write('tabl ending')
        myFile.write('</body>')
        myFile.write('</html>')
        myFile.close()
    #os.system('firefox mypage.html')
    #os.system('firefox mypage.html')


