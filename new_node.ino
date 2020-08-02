#include <BearSSLHelpers.h>
#include <CertStoreBearSSL.h>
#include <ESP8266WiFi.h>
#include <ESP8266WiFiAP.h>
#include <ESP8266WiFiGeneric.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266WiFiScan.h>
#include <ESP8266WiFiSTA.h>
#include <ESP8266WiFiType.h>
#include <WiFiClient.h>
#include <WiFiClientSecure.h>
#include <WiFiClientSecureAxTLS.h>
#include <WiFiClientSecureBearSSL.h>
#include <WiFiServer.h>
#include <WiFiServerSecure.h>
#include <WiFiServerSecureAxTLS.h>
#include <WiFiServerSecureBearSSL.h>
#include <WiFiUdp.h>
#include <Servo.h>
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
#include <SPI.h>
#include <MFRC522.h>
#define SS_PIN D2  //--> SDA / SS is connected to pinout D2
#define RST_PIN D1  //--> RST is connected to pinout D1
MFRC522 mfrc522(SS_PIN, RST_PIN);  //--> Create MFRC522 instance.

#define ON_Board_LED 2  //--> Defining an On Board LED, used for indicators when the process of connecting to a wifi router

const char* ssid = "nani"; //SSID of your WiFi router
const char* password = "123456789";//Password of your WiFi router


ESP8266WebServer server(80);  //--> Server on port 80

int readsuccess;
byte readcard[4];
char str[32] = "";
String StrUID;
Servo servo;

void setup() {
  Serial.begin(115200); //--> Initialize serial communications with the PC
  SPI.begin();      //--> Init SPI bus
  mfrc522.PCD_Init(); //--> Init MFRC522 card

  delay(500);

  WiFi.begin(ssid, password); //--> Connect to your WiFi router
  Serial.println("");
    
  pinMode(ON_Board_LED,OUTPUT); 
  digitalWrite(ON_Board_LED, HIGH); //--> Turn off Led On Board


  Serial.print("Connecting");
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    digitalWrite(ON_Board_LED, LOW);
    delay(250);
    digitalWrite(ON_Board_LED, HIGH);
    delay(250);
  }
  digitalWrite(ON_Board_LED, HIGH); //--> Turn off the On Board LED when it is connected to the wifi router.
 
  Serial.println("");
  Serial.print("Successfully connected to : ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
  Serial.println("Please tag a card or keychain to see the UID !");
  Serial.println("");
   servo.attach(2); //D4
   servo.write(0);
   delay(2000);
}

void loop() {
  // put your main code here, to run repeatedly
  readsuccess = getid();
 
  if(readsuccess) {  
  digitalWrite(ON_Board_LED, LOW);
    HTTPClient http;    //Declare object of class HTTPClient
 
    String UIDresultSend, postData;
    UIDresultSend = StrUID;
   
    //Post Data
      postData = "UIDresult=" + UIDresultSend;
  
    http.begin("http://192.168.43.140/rf/getUID.php");  //Specify request destination
    http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Specify content-type header
   
    int httpCode = http.POST(postData);   //Send the request
    String payload = http.getString();    //Get the response payload
  
    Serial.println(UIDresultSend);
    Serial.println(httpCode);   //Print HTTP return code
    Serial.println(payload);    //Print request response payload
    
    http.end();  //Close connection
    delay(1000);
  digitalWrite(ON_Board_LED, HIGH);
  if(httpCode!=0)
  {
servo.write(90);
delay(10000);
servo.write(0);
delay(100);
  }
  }
 
}

int getid() {  
  if(!mfrc522.PICC_IsNewCardPresent()) {
    return 0;
  }
  if(!mfrc522.PICC_ReadCardSerial()) {
    return 0;
  }
  Serial.print("THE UID OF THE SCANNED CARD IS : ");
  
  for(int i=0;i<4;i++){
    readcard[i]=mfrc522.uid.uidByte[i]; //storing the UID of the tag in readcard
    array_to_string(readcard, 4, str);
    StrUID = str;
  }
  mfrc522.PICC_HaltA();
  return 1;
}

void array_to_string(byte array[], unsigned int len, char buffer[]) {
    for (unsigned int i = 0; i < len; i++)
    {
        byte nib1 = (array[i] >> 4) & 0x0F;
        byte nib2 = (array[i] >> 0) & 0x0F;
        buffer[i*2+0] = nib1  < 0xA ? '0' + nib1  : 'A' + nib1  - 0xA;
        buffer[i*2+1] = nib2  < 0xA ? '0' + nib2  : 'A' + nib2  - 0xA;
    }
    buffer[len*2] = '\0';
}
