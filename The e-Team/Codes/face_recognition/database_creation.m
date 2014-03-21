clc
clear all
close all
%import_name_db;
%profilePics=dir('./profile_pics_database/*.jpg');
person_id=input('Enter the person id?','s');
mkdir('./pics2',person_id);
dest=strcat('./pics2/',person_id);
addpath(dest);

faceDetector = vision.CascadeObjectDetector;
vid = videoinput('winvideo', 1,'YUY2_640x480');
set(vid, 'ReturnedColorSpace', 'RGB');
preview(vid)
pause(1.5)
for i=1:10
    count=i;
    i = getsnapshot(vid);
    pause(0.5)
    bboxes = step(faceDetector, i);
    [m,n]=size(bboxes);
    if m==1
        IFaces = insertObjectAnnotation(i, 'rectangle', bboxes, 'Face');
        figure, imshow(IFaces), title('Detected faces');
        face=imcrop(i,bboxes);
        face=rgb2gray(face);
        face=imresize(face,'OutputSize',[100,100]);
        figure,imshow(face);
        
        %saving image in database
        picid=int2str(count);
        picid_pgm=strcat('pics2/',person_id,'/',picid,'.pgm');
        imwrite(face,picid_pgm);
    else
        i=count-1;
    end
end
closepreview(vid);

