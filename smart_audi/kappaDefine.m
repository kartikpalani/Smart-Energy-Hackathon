function kappaDefine
global mask;
global labels;
global n;
global referenceImage;
global runtimeImage;
global grid;
global capacity;
[refFileName,refPathName,refFilterIndex]=uigetfile('*.jpg');
if refFilterIndex==1
referenceImage=imread(strcat(refPathName,refFileName));
% imagesc(referenceImage)
% tempImg=referenceImage;
tempImg=imresize(referenceImage,1);
roiwindow = CROIEditor(tempImg);
addlistener(roiwindow,'MaskDefined',@your_roi_defined_callback)

for i=1:n
fprintf('Total capacity of grid %g = ',i);  
capacity(1,i) = input('');
end

[nRows,nCols,nBands]=size(tempImg);
labels1=uint8(labels);
M=zeros(nRows,nCols,nBands);

for varN=1:n
for i=1:nRows
    for j=1:nCols
%         for k=1:nBands
            if labels1(i,j)==varN
                 M(i,j)=labels1(i,j);
            else M(i,j)=0;
            end
%          end
    end
end
for k=1:3
N(:,:,1:3)=M(:,:);
end
% M=uint8(M);
% M=M/varN;
% grid=referenceImage.*M;
grid=M;
str=num2str(varN);
% strcat('grid',str,'.jpg')
imwrite(grid,strcat('refGrid',str,'.jpg'))
end
end

function your_roi_defined_callback(h,e)
    
            [mask, labels, n] = roiwindow.getROIData;
            delete(roiwindow); 
end
end