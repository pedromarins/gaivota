
///Bibliotecas
#include <Wire.h>

#include <SHT1x.h>
#include <BMP085.h>

// Libs e config da rede wifi
#include <SPI.h>
#include <WiFly.h>
#include "Credentials.h"

// Lib sensor temperatura
#include <OneWire.h>
#include <DallasTemperature.h>

#define pump1 4 //relay controlador da bomba de irrigacao
#define soil1 0 //sensor de humidade do solo

// Pinos data e clock do Sensor SHT15
#define dataPin  9
#define clockPin 8
SHT1x sht1x(dataPin, clockPin);


// Id da estacao de monitoramento

String id="6a7a2bd182362eb6d039ee11b58674aa";

// Valores de sensores

int hs1;
int soil_humidity;
float soil_temperature;
float air_humidity;
long Temperature = 0, Pressure = 0, Altitude = 0;

int temp = 10; 
OneWire ds(temp); 
DallasTemperature sensors(&ds);

WiFlyClient client("209.41.75.203", 80);
  
boolean isConnected;

void setup() {
  Serial.begin(9600);
  pinMode(soil1,INPUT);
  pinMode(pump1,OUTPUT);
  
  sensors.begin();
    
  while (!Serial) {
  }

  Serial.println("started");
  WiFly.begin();
  Serial.println("wifly started");

  if (!WiFly.join(ssid, passphrase)) {
    Serial.println("Association failed.");
    isConnected = false;
  }  
  else {
    isConnected = true;
    Serial.println("wifly connected");

  }
  
  if (client.connect()) {
    Serial.println("connected");
    client.println("GET /recebeDados.php?id=6a7a2bd182362eb6d039ee11b58674aa&air_temperature=30&soil_temperature=&humidity=60&pressure=1000&air_co=2.3&air_particule=34&wind_speed=12&wind_direction=34&soil_humidity= HTTP/1.0");
    client.println();
  }
  else {
    Serial.println("connection failed");
  }
}

void loop(){
  soil_humidity = getSoilHumidity();
  Serial.println(soil_humidity);  
  soil_temperature =  getTemp2();
  Serial.println(soil_temperature);
  air_humidity = getHumidity();
  Serial.println(air_humidity);
  
  if (isConnected) {
    if (client.available()) {
      char c = client.read();
      Serial.print(c);
    }
    if (!client.connected()) {
      Serial.println();
      Serial.println("disconnecting.");
      client.stop();
    }
  }
}

/* Funcao para verificacao da humidade do solo//
// descrio de valores do sensor
// 0  ~310     solo seco
// 310~650     solo humido
// 650 > ...   solo enxarcado
*/

int getSoilHumidity(){
  hs1 = analogRead(soil1);
  return hs1; 
}


// Funcao para coletar temperatura do solo/agua

float getTemp2(){
  sensors.requestTemperatures();
  soil_temperature = sensors.getTempCByIndex(0);
  return soil_temperature = 24; 
}


// Funcao para coletar presso atmosfrica
float getAtPressure(){
  float temp_c;
  temp_c = sht1x.readTemperatureC();
  return(temp_c, DEC);
}

float getHumidity(){
  float hum;
  hum = sht1x.readHumidity();
  return(hum);
}
