clc
clear all
close all
%import_name_db;
profilePics=dir('./profile_pics_database/*.jpg');

faceDetector = vision.CascadeObjectDetector;
vid = videoinput('winvideo', 1,'YUY2_640x480');
set(vid, 'ReturnedColorSpace', 'RGB');
preview(vid)
pause(1.5)
img1 = getsnapshot(vid);
pause(0.5)
img2 = getsnapshot(vid);
pause(0.5)
img3 = getsnapshot(vid);
closepreview(vid);

bboxes = step(faceDetector, img1);
bboxes = step(faceDetector, img2);
bboxes = step(faceDetector, img3);


IFaces = insertObjectAnnotation(img1, 'rectangle', bboxes, 'Face');
figure, imshow(IFaces), title('Detected faces');

IFaces = insertObjectAnnotation(img2, 'rectangle', bboxes, 'Face');
figure, imshow(IFaces), title('Detected faces');

IFaces = insertObjectAnnotation(img3, 'rectangle', bboxes, 'Face');
figure, imshow(IFaces), title('Detected faces');

% i1=imcrop(img,bboxes);
% i1=rgb2gray(i1);
% i1=imresize(i1,'OutputSize',[100,100]);
% imshow(i1);
%imwrite(i1,'piyush10.pgm');

img={img1, img2, img3};
[X y width height names] = read_images('pics2');
% compute a model
model = eigenfaces(X,y,10);
for i=1:3
    test_img=imcrop(img{i},bboxes);
    test_img=rgb2gray(test_img);
    test_img=imresize(test_img,'OutputSize',[100,100]);
    %imshow(test_img);
    imwrite(test_img,'test.pgm');

    %passing the image to face recognition model 'predicted' gives the label of personID in database  				
    Xtest=read_image('test.pgm');
    predicted = eigenfaces_predict(model, Xtest, 1)

    if (predicted>0)
       % disp(['Hello ',name_db(predicted)]);
        figure,imshow(profilePics(predicted).name);%,'Parent', handles.axes1)
    end
end
