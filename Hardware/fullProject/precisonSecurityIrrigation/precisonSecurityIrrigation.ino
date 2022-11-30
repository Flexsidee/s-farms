//Including all required libraries
#include <DHT.h>
#include <WiFiClient.h>
#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>

//all pins connection here
const int buzzer = 5; //D1 pin
const int pir_pin = 4; //D2 pin
const int green_led = 0; //D3 pin
const int dht_pin = 14; //D5 pin
const int moisture_pin = 12; //D6 pin
const int relay_pin = 13; //D7 pin

//set inital pir motion sensor value to 0
int pir_val = 0;

//set wifi name and password that will be created by esp8266
const char* ssid = "Smart Farm Management System";
const char* password = "87654321";

//set the endpoint that data will be dropped
const String apikey = "somade_daniel";
const String servername = "http://192.168.4.2/ncs_comp/backend/recieveReadings/receive.php";

//add api key to the name
const String serverApi = servername + "?apikey=" + String(apikey);

//calling libraries
ESP8266WebServer server(80);
DHT dht(dht_pin, DHT11);
 
void setup(){
    //set the baud rate
   Serial.begin(115200);
   delay(100);

   //set what the pins are for
   pinMode(relay_pin,OUTPUT); //output pin for relay board, this will send signal to the relay
   pinMode(moisture_pin,INPUT); //input pin coming from soil sensor
  
   //on the buzer and led on startup
   pinMode(green_led, HIGH);
   pinMode(buzzer, HIGH);
   
   //start the dht11 
   dht.begin();

   //create wifi 
   WiFi.softAP(ssid, password);

  //start sever and display details in serial monitor
   server.begin();
   Serial.println("HTTP server started");
   Serial.print("Access Point: "); Serial.print(ssid);
   Serial.println("");
   Serial.print("IP address: "); Serial.print(WiFi.softAPIP());
   Serial.println("");
   Serial.println("");
   }
 
void loop(){
  //get all the sensor readings
  pir_val = digitalRead(pir_pin);
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  float m = digitalRead(moisture_pin);
  m = 100 - ( (m * 100)/ 1024); //converted the moisture reading to percentage

  //display all reading values;
  Serial.print("PIR motion value: "); Serial.print(pir_val);
  Serial.println("");
  Serial.print("Humidity: "); Serial.print(h); Serial.print("%");
  Serial.println("");
  Serial.print("Temperature: "); Serial.print(t); Serial.print("C");
  Serial.println("");
  Serial.print("Soil Moisture: "); Serial.print(m); Serial.print("%");
  Serial.println("");

  //control water pump from moisture value
  if(m == LOW){ // if water level is full then cut the relay 
    digitalWrite(relay_pin,LOW); // low is to cut the relay
  } else{
    digitalWrite(relay_pin,HIGH); //high to continue proving signal and water supply
  }

  
  //control led and buzzer based on input from pir motion sensor
  if(pir_val == 1){
    digitalWrite(green_led, HIGH);
    digitalWrite(buzzer, HIGH);
  }else{
    digitalWrite(green_led, LOW);
    digitalWrite(buzzer, LOW);
  }

  //concantenate readings with endpoint to send data
  String request = serverApi + "&temperature=" + String(t) + "&humidity=" + String(h) + "&moisture=" + String(m);
  Serial.print("Request: "); Serial.print(request);
  Serial.println("");

  WiFiClient client;
  HTTPClient http;

  http.begin(client, request.c_str());

  int httpResponseCode = http.GET();

  if(httpResponseCode > 1){
    //diplay response of request from server 
    String payload = http.getString();
    Serial.println(payload);
  }else{
    //display error code is request is not sent
    Serial.print("Error code: "); Serial.print(httpResponseCode);
  }

  //add an empty line
  Serial.println("");
  Serial.println("");

  http.end();

  //send data every 1secondd
  delay(1000);
}
