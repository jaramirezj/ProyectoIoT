#include <SPI.h>
#include <MFRC522.h>
#include <Keypad.h>
#include <Servo.h>

#define pinEnter A0
#define pinServo A1
#define pinIR 8
#define RST_PIN 9
#define SS_PIN 10

const byte rows = 4;
const byte cols = 4;

String uid = "";
String pass = "";
 
char keys[rows][cols] = {
   { '1','2','3','A'},
   { '4','5','6','B'},
   { '7','8','9','C'},
   { '*','0','#','D'}
};


const byte rowPins[rows] = { A5, A4, 2, 3};
const byte colPins[cols] = { 4, 5, 6, 7};

Keypad keypad = Keypad(makeKeymap(keys), rowPins, colPins, rows, cols);
MFRC522 mfrc522(SS_PIN, RST_PIN);
Servo servoMotor;



void leerID(byte* buffer, byte bufferSize) {
  Serial.print("{\'uid\':");
  for (byte i = 0; i < bufferSize; i++) {
    Serial.print(buffer[i] < 0x10 ? " 0" : " ");
    Serial.print(buffer[i], HEX);
  }
}


bool leerTarjeta(){
  if (!mfrc522.PICC_IsNewCardPresent()) {
    return false;
  }
  if (!mfrc522.PICC_ReadCardSerial()) {
    return false;
  }
  leerID(mfrc522.uid.uidByte, mfrc522.uid.size);
  mfrc522.PICC_HaltA();
  return true;
}

void leerTeclado(){
  while(digitalRead(pinEnter)!=1){
    char key = keypad.getKey();
    if (key) {
      //Serial.print(key);
      pass+=key;
    }
  }
 // Serial.println(pass);
}


void setup() {
  Serial.begin(9600);
  while (!Serial);      // Bucle que no permite continuar hasta que no se ha abierto el monitor serie
  SPI.begin();          // Iniciar bus SPI
  mfrc522.PCD_Init();   // Iniciar lector RFID RC522
  pinMode(pinEnter,INPUT_PULLUP);
  pinMode(pinIR,INPUT);
  servoMotor.attach(pinServo);
  servoMotor.write(0);
}

void loop() {
  //Serial.println("Ingrese una tarjeta");
  while(!leerTarjeta()){}
  //Serial.println("Ingrese su contraseña");
  leerTeclado();
  Serial.println(",\'pass\':" + pass + "}");
  while(!Serial.available()>0){}
  //if(Serial.available()>0){
    String respuesta = Serial.readStringUntil('\n');
    if(respuesta == "correct"){
      servoMotor.write(90);
      while(digitalRead(pinIR)==0){}
      servoMotor.write(0);
    }else{
      Serial.println(respuesta);
    }
  //}
  delay(100);
  mfrc522.PCD_Init();
}
