 #include <SPI.h>
#include <MFRC522.h>
#include <Keypad.h>
#include <Servo.h>
#include <Wire.h> 
#include <LiquidCrystal_I2C.h>

#define pinEnter A0
#define pinServo A1
#define pinIR 8
#define RST_PIN 9
#define SS_PIN 10

const byte rows = 4;
const byte cols = 4;

String uid = "";
String pass = "";

unsigned int tInicial;
unsigned int tActual;
unsigned int estado = 1;
 
char keys[rows][cols] = {
   { '1','2','3','A'},
   { '4','5','6','B'},
   { '7','8','9','C'},
   { '*','0','#','D'}
};


const byte rowPins[rows] = { A3, A2, 2, 3};
const byte colPins[cols] = { 4, 5, 6, 7};

Keypad keypad = Keypad(makeKeymap(keys), rowPins, colPins, rows, cols);
MFRC522 mfrc522(SS_PIN, RST_PIN);
LiquidCrystal_I2C lcd(0x27,16,2);
Servo servoMotor;



void leerID(byte* buffer, byte bufferSize) {
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
  Serial.println("uid");
  leerID(mfrc522.uid.uidByte, mfrc522.uid.size);
  mfrc522.PICC_HaltA();
  return true;
}

void leerTeclado(){
  while(digitalRead(pinEnter)!=1){
    char key = keypad.getKey();
    if (key) {
      lcd.print(key);
      pass+=key;
    }
  }
}

void actualizarEstado(){
  Serial.println("estado");
  while(!Serial.available()>0){}
  String respuesta = Serial.readStringUntil('\n');
  if(respuesta =="1"){
    estado = 1;
  }else if(respuesta == "2"){
    estado = 2;
  }else if(respuesta == "3"){
    estado = 3;
  }
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
  lcd.init();
   lcd.backlight();
}

void procesoNormal(){
  lcd.setCursor(0,0);
  lcd.print("Ingrese una");
  lcd.setCursor(0,1);
  lcd.print("tarjeta");
  //while(!leerTarjeta()){}
  if(leerTarjeta()){
    lcd.clear();
    lcd.setCursor(0,0);
    lcd.print("Ingrese codigo");
    lcd.setCursor(0,1);
    leerTeclado();  
    Serial.println();
    Serial.println("pass");
    Serial.println(pass);
    while(!Serial.available()>0){}
    String respuesta = Serial.readStringUntil('\n');
    lcd.clear();
    lcd.setCursor(0,0);
    if(respuesta == "correct"){
      lcd.print("Bienvenido,");
      lcd.setCursor(0,1);
      lcd.print("puede ingresar");
      servoMotor.write(90);
      while(digitalRead(pinIR)!=0){}
      servoMotor.write(0);
      lcd.print("Ingrese una");
      lcd.setCursor(0,1);
      lcd.print("tarjeta");
      delay(200);
    }else if(respuesta == "wrong_card"){
      lcd.print("Tarjeta no");
      lcd.setCursor(0,1);
      lcd.print("reconocida");
      delay(1000);
    }else if(respuesta == "wrong_pass"){
      lcd.print("Codigo ");
      lcd.setCursor(0,1);
      lcd.print("incorrecto");
      delay(1000);
    }else if(respuesta == "full"){
      lcd.print("Parqueadero");
      lcd.setCursor(0,1);
      lcd.print("lleno");
      delay(1000);
    }else if(respuesta == "denied"){
      lcd.print("Acceso");
      lcd.setCursor(0,1);
      lcd.print("denegado");
      delay(1000);
    }
    lcd.clear();
   mfrc522.PCD_Init();
   uid = "";
   pass = "";
  }
}

void loop() {
  actualizarEstado();
  tInicial = millis();
  tActual = millis();
  while(tActual - tInicial < 20000){
    if(estado==1){
      procesoNormal();
    }else if(estado==2){
      lcd.clear();
      lcd.setCursor(0,0);
     lcd.print("Acceso");
      lcd.setCursor(0,1);
      lcd.print("bloqueado");
      delay(100);
    }else if(estado==3){
      lcd.clear();
      lcd.setCursor(0,0);
      lcd.print("Acceso");
      lcd.setCursor(0,1);
      lcd.print("libre");
      delay(100);
    }
   if(digitalRead(pinIR)==0){
      delay(100);
      Serial.println("salida");
    }
    tActual = millis();
  }
  lcd.clear();
  lcd.setCursor(0,0);
}
