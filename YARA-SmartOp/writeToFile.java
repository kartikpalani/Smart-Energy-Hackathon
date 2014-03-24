import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.lang.*;
 
public class writeToFile {
	public static void main(String[] args) {
BufferedWriter out = null;
try  
{
    int i=0;
    while(i<50)
    {    
        try
  {
  Thread.sleep(1500);  
 
  }catch (InterruptedException ie)
  {
  System.out.println(ie.getMessage());
  }    
    FileWriter fstream = new FileWriter("../test.txt", true); //true tells to append data.
    out = new BufferedWriter(fstream);
    String str=String.valueOf((i+1)%30)+","+String.valueOf((i+1)%24)+","+String.valueOf(i+3)+","+String.valueOf(i+2)+","+String.valueOf(i+1)+","+String.valueOf(i+2)+","+String.valueOf(i+1)+","+String.valueOf(i+2)+","+String.valueOf(i+2)+","+String.valueOf(i+1)+","+String.valueOf(i+6)+","+String.valueOf(i+5); 
    out.write("\n"+str);
    out.close();
    //  for(int temp=0;temp<500000000;temp++)
    //  {
     // }
    i++;
    System.out.println(i);
    }
}
catch (IOException e)
{
    System.err.println("Error: " + e.getMessage());
}
finally
{
    if(out != null) {
        try {
            out.close();
        } catch (IOException ex) {
            Logger.getLogger(writeToFile.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
}
	}
}