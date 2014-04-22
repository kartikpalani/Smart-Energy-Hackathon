function kappaRuntime
global mask;
global labels;
global n;
global referenceImage;
global runtimeImage;
[runFileName,runPathName,runFilterIndex]=uigetfile('*.jpg');
if runFilterIndex==1
runtimeImage=imread(strcat(runPathName,runFileName));

tempImg=imresize(runtimeImage,1);
roiwindow = CROIEditor(tempImg);

[nRows,nCols,nBands]=size(tempImg);
labels1=uint8(labels);

for varN=1:n
for i=1:nRows
    for j=1:nCols
        for k=1:nBands
            if labels1(i,j)==varN
                M(i,j,k)=labels1(i,j);
            else M(i,j,k)=0;
            
         end
        end
    end
end
M=uint8(M)/varN;
grid=runtimeImage.*M;
str=num2str(varN);
% strcat('grid',str,'.jpg')
imwrite(grid,strcat('runGrid',str,'.jpg'))

end
end