clc
clear all

%initialising the com port 

s2 = serial('COM14','BaudRate',115200);
s3 = serial('COM3','BaudRate',9600);
fopen(s2); 
fopen(s3);

[X y width height names] = read_images('pics2');

% compute a model
model = eigenfaces(X,y,10);
% importing the list of names with id from name_db.txt file
import_name_db;
profilePics=dir('./profile_pics_database/*.jpg');

%starting the haar face detection object
faceDetector = vision.CascadeObjectDetector;

%initialising the camerea
vid = videoinput('winvideo', 1,'YUY2_640x480');
set(vid, 'ReturnedColorSpace', 'RGB');




