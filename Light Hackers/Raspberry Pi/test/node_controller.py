import serial

ser = serial.Serial('/dev/ttyAMA0', 9600)
while True:
	print ser.read(1)
	#ser.write("B")
