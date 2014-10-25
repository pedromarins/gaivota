///Bibliotecas
#include <Wire.h>
#include <SHT1x.h>

// Libs e config da rede wifi
#include <SPI.h>
#include <WiFly.h>
#include "Credentials.h"

// Lib sensor temperatura solo/agua
#include <OneWire.h>
#include <DallasTemperature.h>

#define pump1 4 //relay controlador da bomba de irrigacao
#define soil1 0 //sensor de humidade do solo

// Pinos data e clock do Sensor SHT15
#define dataPin  2
#define clockPin 3

SHT1x sht1x(dataPin, clockPin);

#define DEBUG
#define REQUEST_TIMEOUT 10000

extern unsigned int __bss_end;
extern unsigned int __heap_start;
extern void *__brkval;

char charVal[5];


// Variaveis de configuracao da string http

String id="1f59f8dca2728b6daa6378c7ac47a147";
String httpData;
String httpMethod = "GET ";
String httpProtocol = " HTTP/1.0";
String serverListener = "/recebeDados.php?";

// Valores de sensores

int hs1;
int soilHumidity;
long ambientTemperature;
long airHumidity;
long soilTemperature;
 

boolean isConnected, receivingData;
unsigned long requestTime;

WiFlyClient client("api.gaivota.org", 80);

void setup() {
#ifdef DEBUG
  Serial.begin(9600);
#endif
  Wire.begin();
  pinMode(soil1,INPUT);
  pinMode(pump1,OUTPUT);
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
}

void loop(){
  if (!client.connected()){
    soilHumidity = getSoilHumidity();
    Serial.println(soilHumidity);  
    airHumidity = getHumidity();
    Serial.println(airHumidity);
    ambientTemperature =  getTemperature();
    Serial.println(ambientTemperature);
    Serial.println(httpData);
    httpData = httpMethod+serverListener+"id="+id+"&ambientTemperature=25&airHumidity=65&soilHumidity=350&soilTemperature=32&pressure=1112"+httpProtocol; //String de conexao http
    // string para postar demais dados (necessario plugar outros sensores) httpData = "&air_co=2.3&air_particule=34&wind_speed=12&wind_direction=3;
  }

  if (!client.connected()) {
    Serial.println("connecting to server");
    if (client.connect()) {

      client.println(httpData);
      client.println();

      Serial.println("http request sent");
      requestTime = millis();
      delay(10000);
    }
    else {
      Serial.println("connection to the failed.");
      Serial.println(freeMemory());
    }
  }

  if (client.connected()) {
    if (millis() - requestTime > REQUEST_TIMEOUT) {
      Serial.println("http request timeout. closing client.");
      client.stop();
    }
    else {
      while (client.available()) {
        requestTime = millis();
        char c = client.read();
        Serial.print(c);
      }
    }    
  }
}

/* Funcao para verificacao da humidade do solo//
 // descrio de valores do sensor
 // 0  ~310     solo seco
 // 310~650     solo humido
 // 650 > ...   solo encharcado
*/

int getSoilHumidity(){
  hs1 = analogRead(soil1);
  return hs1; 
}


/// Funcao para coletar temperatura do solo/agua

float getTemp2(){
  ///sensors.requestTemperatures();
  //soil_temperature = sensors.getTempCByIndex(0);
  return soilTemperature = 24; 
}


///// Funcao para coletar pressao atmosferica

long getPressure(){
  long presAtm;
  presAtm = 1112;
}

///// Funcao para coletar temperatura ambiente

long getTemperature(){
  long temp_c;
  temp_c = sht1x.readTemperatureC();
  //temp_c = (temp_c, DEC);
  return temp_c;
}

///// Funcao para coletar humidade relativa do ar

long getHumidity(){
  long hum;
  hum = sht1x.readHumidity();
  return(hum);
}

// Funcao verifica memoria livre arduino

int freeMemory() {
  int free_memory;
  if((int)__brkval == 0)
    free_memory = ((int)&free_memory) - ((int)&__bss_end);
  else
    free_memory = ((int)&free_memory) - ((int)__brkval);
  return free_memory;
}

/*
//Funcao para irrigacao LIGA/DESLIGA bomba//

long int irrigar(){
  tempo = tempo * 600;
  digitalWrite(pump1,LOW);
  delay(tempo);
  digitalWrite(pump1,HIGH);
}

*/


/*
//Funcao para verificar intensidade luminosidade solar

long int getLDR(){
 int ldr = 1
 return analogRead(ldr);
}
*/

