/*
 * 
 * Proyect developed by Julian Andres Ramirez Jimenez
 * Student of Systems Enginering
 * Version 1
 * 
 * File designed to sense and send the data to
 * the local server
 */

#include <ESP8266WiFi.h>
#include <WiFiClient.h>

const char ssid = "UNE_HFC_7BB0";
const char password = "";

void setup() {
  Serial.begin(9600);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
 Serial.println("");
 Serial.println("WiFi connected");
 Serial.println("IP address: ");
 Serial.println(WiFi.localIP());
}

void loop() {
  

}

String sendValues(String data){
  
}
