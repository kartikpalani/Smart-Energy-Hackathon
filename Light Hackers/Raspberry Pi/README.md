Smart Street Light - Hub
=======================

1. The following files are run continuously on the hub

 - hub.py

    This file is a daemon that runs on the hub and co-ordinates the communication between the hub(itself) and the nodes that are controlled directly by it.

 - hub_tcp_conc_server.py

    This file communicates with the server through Sockets. It listens for emergency requests by the server. When the server sends an emergency requests, it creates a new thread & it broadcasts the message to its nodes, depending on the type of message.

2. The following files are used for testing purposes

 - test/conc_tcp_client

    Unit test for testing tcp client message sending

 - test/conc_tcp_server

    Unit test for testing multithreaded tcp server for receiving requests from the main server.

 - test/hub_db.py

    Tests the sql server running on hub.(itself) Creates atable and checks for success
   
 - test/hub_server.py

    This file tests the communication with the server. Creates a new table and checks for suceess.

 - test/node_controller.py

    Node controller that might be moved to parent folder 'hub' if works properly. An attempt to merge both the 2 files on node
    
 - serial_com.py

    Nicely written serial reader written by prashant to be run in the next iteration of the project

 - test/test.py

    Unit test for testing local-loop on serial port. Send 10 characters and the receiver should receive it
