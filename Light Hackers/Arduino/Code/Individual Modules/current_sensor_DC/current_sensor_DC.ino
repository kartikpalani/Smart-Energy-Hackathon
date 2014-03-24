int led = 5;
int current = A0;
float current_val = 0.0;
float voltage_val = 0.0;
float VREF = 4.56;
void setup() 
{
  Serial.begin(9600);
  Serial.write("started");
  pinMode(led,OUTPUT);
  pinMode(current,INPUT);
  digitalWrite(led,HIGH);
}

void loop() 
{
  float adc_cnt = (float)analogRead(current);
  voltage_val = adc_cnt * VREF /1023.0;
  current_val = voltage_val / ( 1.8 * 0.33);
  Serial.print("voltage : ");
  Serial.print(voltage_val);
  Serial.print("V Current : ");
  Serial.print(current_val);
  Serial.println("mA");
  if (Serial.available() > 0) 
  {
    char rec_data = Serial.read();
    if(rec_data == 'a')
    {
      digitalWrite(led,HIGH);
      Serial.println("led on");
    }
    else if(rec_data == 's')
    {
      digitalWrite(led,LOW);
      Serial.println("led off");
    }
  }
  delay(500);
}


