Add the folder to matlab source path. Steps for running the programs:
1.database_creation(For adding the subject to database folder with 10 images and id number)
For system to be triggerd by subject entrance data is gatherd from serial port and also to indicate the recognised output arduino is connected to serial port.
2.initialization (Intializes the serial ports, face detection and recognition model)
3.eigen_prediction (Give the id and image of recognized subject)

For running recognition without serial data:
face_detect_recog (Give the image and id for the subject with 5 burst images obtained from webcam)

Folders:
facerec-consists m files for face recognition
pics2- image database where each folder represent each subject 10 face images
profile_pics_database-profile pictures for showing the recognised subject

Files:
import_namde_db:-m files for importing the name database
Namedatabase:- text file for name database for subjects 