[nRows,nCols,nBands]=size(referenceImage);
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
grid=referenceImage.*M;
str=num2str(varN);
% strcat('grid',str,'.jpg')
imwrite(grid,strcat('grid',str,'.jpg'))
end
% 
% for i=1:nRows
%     for j=1:nCols
%         for k=1:nBands
%             if labels1(i,j)==2
%                 M2(i,j,k)=labels1(i,j);
%             else M2(i,j,k)=0;
%             
%          end
%         end
%     end
% end
% 
%         
% for i=1:nRows
%     for j=1:nCols
%         for k=1:nBands
%             if labels1(i,j)==3
%                 M3(i,j,k)=labels1(i,j);
%             else M3(i,j,k)=0;
%             
%          end
%         end
%     end
% end
% M1=uint8(M1);
% M2=uint8(M2)/2;
% M3=uint8(M3)/3;
% grid1=referenceImage.*M1;
% grid2=referenceImage.*M2;
% grid3=referenceImage.*M3;
% 
% % [nRows,nCols,nBands]=size(referenceImage);
% grid=zeros(nRows,nCols,nBands);
% gridx=int8(grid);
% for varN=1
%     for varR=1:nRows
%         for varC=1:nCols
%             if labels(varR,varC)==varN
%                 gridx(varR,varC,nBands)=referenceImage(varR,varC,nBands);
%             end
%         end
%     end            
% end
%         