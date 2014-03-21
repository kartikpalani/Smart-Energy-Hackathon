int ldr = A0;
float ldr_voltage_val = 0.0;
float VREF = 4.56;
void setup() 
{
  Serial.begin(9600);
  Serial.println("started");
  pinMode(ldr,INPUT);
}

void loop() 
{
  float adc_cnt = (float)analogRead(ldr);
  ldr_voltage_val = adc_cnt * VREF /1023.0;
  Serial.print("ldr voltage : ");
  Serial.print(ldr_voltage_val);
  Serial.println("V");
  delay(500);
}
