import socket
import struct
import time
import threading
import serial
#import MySQLdb

value = 0
hub_id = 1
cmd = 6
#server = '10.129.154.129'
#db = MySQLdb.connect(host=server, user='smart', passwd='smart', db='smartlight')

class ClientHandler(threading.Thread):

	def __init__(self, client):
		threading.Thread.__init__(self)
		self.client_sock, self.client_addr = client

	def run(self):

		global value
		#global db
		global cmd

		value = int(struct.unpack('>H', self.client_sock.recv(struct.calcsize('>H')))[0])
		print 'Received', value,
		#time.sleep(1)
		
		port = serial.Serial("/dev/ttyAMA0", baudrate=9600)
		if value == 1:
			send = "$H,%s,1,1,%s#"%(hub_id,cmd)
			#time.sleep(1)
			port.write(send)

			send = "$H,%s,3,1,%s#"%(hub_id,cmd)
			#time.sleep(1)
			port.write(send)

			send = "$H,%s,5,1,%s#"%(hub_id,cmd)
			#time.sleep(1)
			port.write(send)
					
			#upd = "update node set emergencylight = 1 where id in(1,3,5) and hubid=%s" %(hub_id);
			#cur = db.cursor()
			#cur.execute(upd)
			#cur.execute("commit")
			#cur.close()
			
		elif value == 2:
			send = "$H,%s,2,1,%s#"%(hub_id,cmd)
			#time.sleep(1)
			port.write(send)

			send = "$H,%s,4,1,%s#"%(hub_id,cmd)
			#time.sleep(1)
			port.write(send)

			send = "$H,%s,6,1,%s#"%(hub_id,cmd)
			#time.sleep(1)
			port.write(send)
			
			#db = MySQLdb.connect(host=server, user='smart', passwd='smart', db='smartlight')
			#upd = "update node set emergencylight = 1 where id in(2,4,6) and hubid=%s" %(hub_id);
			#cur = db.cursor()
			#cur.execute(upd)
			#cur.execute("commit")
			#cur.close()

		
		port.close()
		#print 'and_sending', value
		#self.client_sock.sendall(struct.pack('>H', value))

		#assume 10 secs as timeout
		print "Thread that received %s is going to poweoff after 10 seconds"
		time.sleep(10)
		cmd = 3
		print cmd

		port = serial.Serial("/dev/ttyAMA0", baudrate=9600)
		if value == 1:
			send = "$H,%s,1,1,%s#"%(hub_id,cmd)
			#time.sleep(1)
			port.write(send)

			send = "$H,%s,3,1,%s#"%(hub_id,cmd)
			#time.sleep(1)
			port.write(send)

			send = "$H,%s,5,1,%s#"%(hub_id,cmd)
			#time.sleep(1)
			port.write(send)
			
			'''db = MySQLdb.connect(host=server, user='smart', passwd='smart', db='smartlight')
			upd = "update node set emergencylight = 1 where id in(1,3,5) and hubid=%s" %(hub_id);
			cur = db.cursor()
			cur.execute(upd)
			cur.execute("commit")
			cur.close()
			'''
			
		elif value == 2:
			send = "$H,%s,2,1,%s#"%(hub_id,cmd)
			#time.sleep(1)
			port.write(send)

			send = "$H,%s,4,1,%s#"%(hub_id,cmd)
			#time.sleep(1)
			port.write(send)

			send = "$H,%s,6,1,%s#"%(hub_id,cmd)
			#time.sleep(1)
			port.write(send)
			
			'''db = MySQLdb.connect(host=server, user='smart', passwd='smart', db='smartlight')
			upd = "update node set emergencylight = 1 where id in(2,4,6) and hubid=%s" %(hub_id);
			cur = db.cursor()
			cur.execute(upd)
			cur.execute("commit")
			cur.close()
			'''

		
		port.close()
		print "Thread halted"
		

sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
sock.bind(('', 9999))
sock.listen(0)
print 'Waiting_for_clients_...'

while True: # Serve forever.
    client = sock.accept()
    ClientHandler(client).start()