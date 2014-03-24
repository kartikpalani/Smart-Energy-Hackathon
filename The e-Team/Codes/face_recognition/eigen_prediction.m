%%code moved to initialization code
% clc
% %clear all
% [X y width height names] = read_images('pics2');
% 
% % compute a model
% model = eigenfaces(X,y,10);
% % importing the list of names with id from name_db.txt file
% import_name_db;
% profilePics=dir('./profile_pics_database/*.jpg');
% 
% %starting the haar face detection object
% faceDetector = vision.CascadeObjectDetector;
% 
% %initialising the camerea
% vid = videoinput('winvideo', 1,'YUY2_640x480');
% set(vid, 'ReturnedColorSpace', 'RGB');
% 
% %initialising the com port 
% % s2 = serial('COM14','BaudRate',115200);
% % s3 = serial('COM3','BaudRate',96500);
% 
% 
 


% fopen(s2); 
% fopen(s3);
%% this program continuously checks for increment of 'in_count' which if increases triggers the camera and recognition
while(1)

close all; 

%reading serial data and modifying to mat data   
data=fscanf(s2);
data_mod=data(strfind(data,'$')+2:end);
if (isempty(data_mod)==0)
str_to_cell=textscan(data_mod,'%f %f %f %f', 'delimiter', ',');
end
ocupancy_data=cell2mat(str_to_cell); %occupancy_data consist of data 1.in count 2.out count 3.PIR1 sensor ping 4.PIR2 sensor ping

% getting the in_data from the occupancy_data
in_data=ocupancy_data(1);

    %% start of image capture
    if (in_data>in_data_last)

        preview(vid)
        pause(1)
        img = getsnapshot(vid); %getting image form camera
        closepreview(vid);

        %face detection bboxes gives the position of face in image
        bboxes = step(faceDetector, img);
        
        [m,n]=size(bboxes)
		%logic for cropping the image and passing to recognition algorithm
        if(isempty(bboxes)==0)
            if(m>1)
                display('Multiple Images found');
                test_img=imread('unknown.jpg');
                detect=0;
            else
                IFaces = insertObjectAnnotation(img, 'rectangle', bboxes, 'Face');
                figure, imshow(IFaces), title('Detected faces');
                %cropping the detected face for recognition
				test_img=imcrop(img,bboxes);
                test_img=rgb2gray(test_img);
                test_img=imresize(test_img,'OutputSize',[100,100]);
                %imshow(test_img);
                imwrite(test_img,'test.pgm');
                
                %passing the image to face recognition model 'predicted' gives the label of personID in database  				
                Xtest=read_image('test.pgm');
                predicted = eigenfaces_predict(model, Xtest, 1);

                if (predicted>0)
                    disp(['Hello ',name_db(predicted)]);
                     imshow(profilePics(predicted).name);%,'Parent', handles.axes1)
                    fwrite(s3,predicted);
                end
            end    
            
           else
            display('No faces found!!!!')
            test=imread('unknown.jpg');
            detect=0;
        end

    end
        
   in_data_last=in_data;
%    fclose(s2);
%    fclose(s3);
end