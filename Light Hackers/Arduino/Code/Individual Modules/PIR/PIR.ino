int pir = 2;
int led = 13;
int pir_interrupt = 1;
int previous_pir_state = 0;
void setup() 
{
  Serial.begin(9600);
  pinMode(led,OUTPUT);
  pinMode(pir,INPUT);
  attachInterrupt(pir_interrupt, pir_isr, CHANGE);
}

void loop() 
{
}

void pir_isr()
{
  int current_pir_state = digitalRead(pir);
  if(previous_pir_state == 0 && current_pir_state == 1)
  {
    previous_pir_state = 1;
    digitalWrite(led,HIGH);
     Serial.println("H");
  }
  else if(previous_pir_state == 1 && current_pir_state == 0)
  {
    previous_pir_state = 0;
    digitalWrite(led,LOW);
    Serial.println("L");
    Serial.println("Motion detected");
  }
  
  
}

