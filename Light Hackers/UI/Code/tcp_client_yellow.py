#!/usr/bin/python

#'''A client for a concurrent server'''

# See: http://docs.python.org/2/library/socket.html
# See: http://wiki.python.org/moin/TcpCommunication
# See: http://docs.python.org/2/library/random.html

import socket
import struct
import random

sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
sock.connect(('10.129.28.241', 9999))

value = int(2)
sock.sendall(struct.pack('>H', value))
#print "Yellow was called"