tempImg=imresize(referenceImage,1);

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
M=uint8(M);
M=M/varN;
grid=referenceImage.*M;
str=num2str(varN);
% strcat('grid',str,'.jpg')
imwrite(grid,strcat('refGrid',str,'.jpg'))
end
