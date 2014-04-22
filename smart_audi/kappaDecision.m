global dispText;
global N1;
global N2;
global N3;
global capacity;


for i=1:n
fprintf('Total capacity of grid %g = ',i);  
capacity(1,i) = input('');
end

totCap=sum(capacity);
%N1,N2, N3
N=N1+N2+N3;

if N<capacity(1,1)
    %output 1st scene
    dispText='Every one move to grid1 to save 68% energy';
elseif N<(capacity(1,2)+capacity(1,1))
    %output 2
    dispText='People in grid3 please move in grid2 to save 32% energy';
else %output 3
    dispText='Configuration is optimal - no adjustments required';
end
NOTICE