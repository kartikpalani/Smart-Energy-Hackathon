
    //pin which triggers ultrasonic sound for all the sensors and receive echo from all sensors
    const int tolerence=20;
    
    const int n=4;  // n represents number of sensors implemented also in this case equal to number of zones
    int strigger[n]; //array of trigger (transmitter) pins of sensors
    int secho[4]; //array of echo (receiver) pins of the circuit
        
    //variables to remember prevoius states of the variables
    volatile int flag1 = 0;
    volatile int flag2 = 0;
    


    //Thresholds *******need to caliberate it **********
    int thr[n]={310,310,310,310};
    
    //pins used to control LED of various zones
    int led[] = {33, 34,35,36};
    void setup() 
    {
    Serial.begin(9600);
	
	//pin numbers of arduino
    strigger[0] = 23;
    secho[0] = 22;
    strigger[1] = 25;
    secho[1] = 24;
    strigger[2] = 27;
    secho[2] = 26;
    strigger[3] = 29;
    secho[3] = 28;
    
	learnEnvironment();
    
    //turn off all lights initially
        for(int i=0;i<n;i++){
            digitalWrite(led[i], LOW);      
        }
    }
     
    void loop()
    {
      int dist[n];
      const int cnt=10;
      int i,k;
      
      //sense distances by all sensors for 1 sec
      int scm[n][cnt];
      for(i=0;i<cnt;i++){
        for(k=0;k<n;k++){  // n= number of sensors = number of zones
          scm[k][i]=setPIN(strigger[k],secho[k]);
        }      
          //Serial.println(i);
          delay(100);
      }
      
      //get actual distance as mode of above values and then control lights based on the values,
      //this helps to avoid noise
      String light="";    
      for(k=0;k<n;k++){
        dist[k]=modeOf(scm[k], cnt);         
        if(dist[k] < (thr[k]-tolerence)){
          digitalWrite(led[k], HIGH);              

             light+="1 ";
        }
        else {
             digitalWrite(led[k], LOW);              
             light+="0 ";          
        }
      }
      
      //light array stores current status of all zones (occupied or not) so sending it via serial port
      Serial.println(light);
      delay(70);
    }
     
    /**
    calculates mode of array a, cnt= array size
    **/
    int modeOf(int a[], int cnt){
      int maxcnt=0; 
      int mode;
      int i,j,val,temp;
      for(i=0;i<cnt;i++){
            val=a[i];
            temp=1;
            for(j=i+1;j<cnt;j++){
                 if(val==a[j]){
                     temp++; 
                 }
            }
            if(temp>maxcnt){
               maxcnt=temp;
               mode=val;
            }
      } 
      return mode;
    }
    
    
    /**
    learns the structure of empty room
    
    **/
    void learnEnvironment(){
      const int setsize=20;
      int i,k,buff[n][setsize];
     //to do learning 
     for(i=0;i<setsize;i++){
        for(k=0;k<n;k++){  // n= number of sensors = number of zones
          buff[k][i]=setPIN(strigger[k],secho[k]);
        }      
          delay(100);
      } 
      for(k=0;k<n;k++){
        thr[k]=modeOf(buff[k], setsize);         
      }
    }

    long microsecondsToCentimeters(long microseconds)
    {
      // The speed of sound is 340 
      //m/s or 29 microseconds per centimeter.
      // The ping travels out and back, so to find the distance of the
      // object we take half of the distance travelled.
      return microseconds / 29 / 2;


    }
    
    
/** 
Input Parameters: sTrig - the trigger pin (transmitter) number for ultrasonic sensors
				  sEcho - echo pin (receiver)) of the sensor
				  This function sends ultrasonic pulse and captures the echoed pulse. 
				  And calculates distance of nearest object in the range based on the time difference between 
				  transmitted signal and echo.
Returns : Distance in centimeters
**/    
int setPIN(int sTrig,int sEcho)
{
      //initializing the pin states
      pinMode(sTrig, OUTPUT);
      
      //sending the signal, starting with LOW for a clean signal
      digitalWrite(sTrig, LOW);
      delayMicroseconds(2);
      digitalWrite(sTrig, HIGH);
      delayMicroseconds(5);
      digitalWrite(sTrig, LOW);
      
      //setting up the input pin, and receiving the duration in
      //microseconds for the sound to bounce off the object infront
      pinMode(sEcho, INPUT);
      
      //pulseIn function monitors the echo signal and returns time duration for which echo signal is high
      int sDuration = pulseIn(sEcho, HIGH);
      
        //raw duration in milliseconds, cm is the  
        //converted amount into a distance
      int sCM = microsecondsToCentimeters(sDuration);
      
   return sCM;

}
