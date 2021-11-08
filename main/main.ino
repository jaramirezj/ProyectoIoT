#include <SPI.h>
#include <MFRC522.h>
#include <Keypad.h>

#define pinEnter 13

const byte rows = 4;
const byte cols = 4;
 
char keys[rows][cols] = {
   { '1','2','3','A'},
   { '4','5','6','B'},
   { '7','8','9','C'},
   { '#','0','*','D'}
};

#define RST_PIN 9
#define SS_PIN 10

Keypad keypad = Keypad(makeKeymap(keys), rowPins, columnPins, rows, cols);
MFRC522 mfrc522(SS_PIN, RST_PIN);

const byte rowPins[rows] = { 21, 20, 19, 18 };
const byte colPins[cols] = { 17, 16, 15, 14 };

void mostrarID(byte* buffer, byte bufferSize) {
  for (byte i = 0; i < bufferSize; i++) {
    Serial.print(buffer[i] < 0x10 ? " 0" : " ");
    Serial.print(buffer[i], HEX);
  }
}

void leerTarjeta(){
  // Si no hay una tarjeta cerca no sigue el programa
  lcd.print("Ingrese una tarjeta");
  if (!mfrc522.PICC_IsNewCardPresent()) {
    return;
  }
  // Si hay una tarjeta cerca, que la eleccione// En caso contrario que no continúe
  if (!mfrc522.PICC_ReadCardSerial()) {
    return;
  }
  Serial.print(F("uid="));
  mostrarID(mfrc522.uid.uidByte, mfrc522.uid.size);  // Mostrar el UID
  Serial.println();
  // Detener el lector
  mfrc522.PICC_HaltA();
}

void leerTeclado(){
  String pass = "";
  while(digitalRead(botonEnter)){
    char key = keypad.getKey();
    if (key) {
      pass+=key;
    }
  }
  Serial.println(pass);
}

void setup() {
  Serial.begin(9600);
  while (!Serial);      // Bucle que no permite continuar hasta que no se ha abierto el monitor serie
  SPI.begin();          // Iniciar bus SPI
  mfrc522.PCD_Init();   // Iniciar lector RFID RC522
  pinMode(pinEnter,INPUT);
}

void loop() {
  lcd.print("Ingrese una tarjeta");
  leerTarjeta();
  lcd.print("Ingrese su contraseña");
  leerTeclado();
  if(Serial.available()>0){
    String respuesta = Serial.readStringUntil("/n");
    if(dato=="correct"){
      lcd.print("Puede ingresar");
      abrirPuerta();
    }else if(dato == "wrong_card"){
      lcd.print("Tarjeta no reconocida");
      lcd.print("Intentalo de nuevo");
    }else if(dato == "wrong_pass"){
      lcd.print("Contraseña incorrecta");
      lcd.print("Intentalo de nuevo");
    }else if(dato == "locked"){
      
    }else if(
    
  }
  Serial.println(F("Proceso finalizado. Ya puedes retirar la tarjeta del lector RFID"));
}
