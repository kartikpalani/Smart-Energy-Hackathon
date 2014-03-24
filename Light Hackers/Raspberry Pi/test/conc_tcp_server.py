#!/usr/bin/python

#'''A concurrent TCP server'''

# See: http://docs.python.org/2/library/socket.html
# See: http://docs.python.org/2/library/struct.html
# See: http://docs.python.org/2/library/threading.html
# See: http://code.activestate.com/recipes/578247-basic-threaded-python-tcp-server
# See: http://stackoverflow.com/questions/4783735/problem-with-multi-threaded-python-app-and-socket-connections

import socket
import struct
import time
import threading

value = 0

class ClientHandler(threading.Thread):

	def __init__(self, client):
		threading.Thread.__init__(self)
		self.client_sock, self.client_addr = client

	def run(self):

		global value

		while True:
			value = int(struct.unpack('>H', self.client_sock.recv(struct.calcsize('>H')))[0])
			print 'Received', value,
			time.sleep(1)
			print 'and_sending', value
 
			self.client_sock.sendall(struct.pack('>H', value))

sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
sock.bind(('', 9999))
sock.listen(0)
print 'Waiting_for_clients_...'

while True: # Serve forever.
    client = sock.accept()
    ClientHandler(client).start()