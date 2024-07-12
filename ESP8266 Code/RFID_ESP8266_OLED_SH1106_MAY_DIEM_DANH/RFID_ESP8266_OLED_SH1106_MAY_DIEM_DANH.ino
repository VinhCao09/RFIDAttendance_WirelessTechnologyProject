
//RFID-----------------------------
#include <SPI.h>
#include <MFRC522.h>
//NodeMCU--------------------------
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
//OLED---------------------------
#include <Adafruit_GFX.h>
#include <Adafruit_SH110X.h>

//************************************************************************
#define SS_PIN  D3 //D8
#define RST_PIN D4  //D3

#define i2c_Address 0x3c //initialize with the I2C addr 0x3C Typically eBay OLED's
#define SCREEN_WIDTH 128 // OLED display width, in pixels
#define SCREEN_HEIGHT 64 // OLED display height, in pixels
#define OLED_RESET -1   //   QT-PY / XIAO
Adafruit_SH1106G display = Adafruit_SH1106G(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, OLED_RESET);
//************************************************************************
MFRC522 mfrc522(SS_PIN, RST_PIN); // Create MFRC522 instance.
MFRC522::MIFARE_Key key;
//************************************************************************
const char *ssid = "Wi-MESH 2.4G";
const char *password = "";
const char* device_token  = "8d89ff7072deb40a";
//************************************************************************
// String URL = "http://192.168.102.74/project_rfid/getdata.php"; 
String URL = "https://rfid.vinhcaodatabase.com/getdata.php"; 
String getData, getmssv, Link;
String OldCardID = "";
unsigned long previousMillis = 0;
int dem=0;
//************************************************************************
void setup() {
  delay(1000);
  Serial.begin(115200);
  SPI.begin();  // Init SPI bus
  mfrc522.PCD_Init(); // Init MFRC522 card
  //---------------------------------------------

  display.begin(i2c_Address, true);
  display.display();
  //-------------------
  connectToWiFi();
  display.clearDisplay(); 
// gan gia tri de chuyan bi kiem tra
  key.keyByte[0] = 0x00;
  key.keyByte[1] = 0x11;
  key.keyByte[2] = 0x22;
  key.keyByte[3] = 0x33;
  key.keyByte[4] = 0x44;
  key.keyByte[5] = 0x55;

}
//************************************************************************
void loop() {
  if(!WiFi.isConnected()){
    connectToWiFi();   
  }
  if(WiFi.isConnected()){
    if(dem==0) {
    //############OLED#############////
          display.clearDisplay();
          display.setTextSize(1);
          display.setTextColor(SH110X_WHITE); 
          display.setCursor(0,20);
          display.print("KET NOI THANH CONG!");
          display.setCursor(0,30);
          display.print("SSID: "); display.print(ssid);
          display.setCursor(0,40);
          display.print("IP: "); display.print(WiFi.localIP());
          display.display();
          delay(3000);
          dem++;
    //############OLED#############////  
    }
  }
    READ_TAG();
}

void READ_TAG()
{
//---------------------------------------------
  // if (millis() - previousMillis >= 15000) {
  //   previousMillis = millis();
  //   OldCardID="";
  // }
  // delay(50);
  //---------------------------------------------
  //look for new card
  if ( ! mfrc522.PICC_IsNewCardPresent()) {
    return;//got to start of loop if there is no card present
  }
  // Select one of the cards
  if ( ! mfrc522.PICC_ReadCardSerial()) {
    return;//if read card serial(0) returns 1, the uid struct contians the ID of the read card.
  }
  byte status;
  byte block = 3;
   // Authenticate using key A
    Serial.println(F("Authenticating using key A..."));
        //############OLED#############////
        display.clearDisplay();
        display.setTextSize(1);
        display.setTextColor(SH110X_WHITE); // 'inverted' text
        display.setCursor(0,30);
        display.println("Dang xac thuc the...");
        display.display();
        display.clearDisplay();
    //############OLED#############////
    // Kiem tra KEy A Sector 0 Block 3
    status = (MFRC522::StatusCode) mfrc522.PCD_Authenticate(MFRC522::PICC_CMD_MF_AUTH_KEY_A, block, &key, &(mfrc522.uid));
    if (status != MFRC522::STATUS_OK) {
        Serial.print(F("PCD_Authenticate() failed: "));
        mfrc522.PICC_HaltA();
        mfrc522.PCD_StopCrypto1();
          //############OLED#############////
        display.clearDisplay();
        display.setTextSize(1);
        display.setTextColor(SH110X_WHITE); // 'inverted' text
        display.setCursor(0,30);
        display.println("XAC THUC THE THAT BAI");
        display.display();
        delay(2000);
        display.clearDisplay();
    //############OLED#############////
    }
    else{
      String CardID ="";
      for (byte i = 0; i < mfrc522.uid.size; i++) {
        CardID += mfrc522.uid.uidByte[i];
      }
      //---------------------------------------------
      // if( CardID == OldCardID ){
      //   return;
      // }
      // else{
      //   OldCardID = CardID;
      // }
      Serial.println(CardID);
      SendCardID(CardID);
      delay(1000);

    }
    // Ghi 1 lan khi quet the
  mfrc522.PICC_HaltA();
  mfrc522.PCD_StopCrypto1();
}


//************send the Card UID to the website*************
void SendCardID( String Card_uid ){
  Serial.println("Sending the Card ID");
//############OLED#############////
  display.clearDisplay();
  display.setTextSize(1);
  display.setTextColor(SH110X_WHITE); // 'inverted' text
  display.setCursor(10,28);
  display.println("Sending the Card ID");
  display.display();
//############OLED#############////
  if(WiFi.isConnected()){
      WiFiClientSecure *client = new WiFiClientSecure;
      client->setInsecure(); //don't use SSL certificate
      HTTPClient https;
// String postData = "card_uid=" + Card_uid + "&device_token=" + device_token;

   https.begin(*client, URL);
  https.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Specify content-type header

 String httpRequestData = "card_uid=" + String(Card_uid) + "&device_token=" + String(device_token);

    int  httpCode = https.POST(httpRequestData); //Send the request
    // String payload = https.getString(); //Get the response payload
      Serial.print("httpRequestData: ");
      Serial.println(httpRequestData);
      Serial.println(httpCode);

//     HTTPClient http;    //Declare object of class HTTPClient
//     //GET Data
//     getData = "?card_uid=" + String(Card_uid) + "&device_token=" + String(device_token); // Add the Card ID to the GET array in order to send it
//     //GET methode
//     Link = URL + getData;
//     http.begin(Link); //initiate HTTP request   
//     Serial.println(Link); 
//     int httpCode = http.GET();   //Send the request
        String payload = https.getString();    //Get the response payload
// //    Serial.println(Link);   //Print HTTP return code



    // Serial.println(httpCode);   //Print HTTP return code
    Serial.println(Card_uid);     //Print Card ID
    Serial.println(payload);    //Print request response payload
//############OLED#############////
  display.clearDisplay();
  display.setTextSize(1);
  display.setTextColor(SH110X_WHITE); // 'inverted' text
  if (httpCode == -1) {
  display.setCursor(0,30);
  display.println("KHONG THE KET NOI TOI DATABASE");
  }
  display.setCursor(0,40);
  display.println(payload);
  display.display();
//############OLED#############////


  if (httpCode == 200) {
      if (payload.substring(0, 5) == "login") {
        String mssv = payload.substring(5,13);
        String user_name = payload.substring(13); 
  //############OLED#############////
        display.clearDisplay();
        display.setTextSize(1);
        display.setTextColor(SH110X_WHITE); // 'inverted' text
        display.setCursor(0,20);
        display.print("ID THE:");
        display.println(Card_uid);     //Print Card ID
        display.setCursor(30,30);
        display.println("Xin chao");
        display.setCursor(15,40);
        display.println(user_name);
        display.setCursor(0,50);
        display.print("MSSV:");
        display.println(mssv);
        display.display();
        delay(2000);
        display.clearDisplay();
    //############OLED#############////

      }
      else if (payload.substring(0, 6) == "logout") {
        String mssv = payload.substring(6,14);
        String user_name = payload.substring(14); 
    //############OLED#############////
        display.clearDisplay();
        display.setTextSize(1);
        display.setTextColor(SH110X_WHITE); // 'inverted' text
        display.setCursor(0,20);
        display.print("ID THE:");
        display.println(Card_uid);     //Print Card ID
        display.setCursor(30,30);
        display.println("Tam biet");
        display.setCursor(15,40);
        display.println(user_name);
        display.setCursor(0,50);
        display.print("MSSV:");
        display.println(mssv);
        display.display();
        delay(2000);
        display.clearDisplay();
    //############OLED#############////
        
      }
  
    else if (payload.substring(0, 10) == "Not found!") {
    //############OLED#############////
        display.clearDisplay();
        display.setTextSize(1);
        display.setTextColor(SH110X_WHITE); 
        display.setCursor(0,20);
        display.print("ID THE:");
        display.println(Card_uid);     //Print Card ID
        display.setCursor(0,30);
        display.println("THE KHONG TON TAI!");
        display.display();
        delay(2000);
        display.clearDisplay();
    //############OLED#############////
      //  Serial.println(user_name);
        
      }
      else if (payload.substring(0, 12) == "Not Allowed!") {
  //############OLED#############////
        display.clearDisplay();
        display.setTextSize(1);
        display.setTextColor(SH110X_WHITE);
        display.setCursor(0,20);
        display.print("ID THE:");
        display.println(Card_uid);     //Print Card ID
        display.setCursor(0,30);
        display.println("NHAN VIEN PHONG KHAC!");
        display.setCursor(0,40);
        display.println("KHONG THE CHAM CONG!");
        display.display();
        delay(2000);
        display.clearDisplay();
      }
    }
        delay(100);
      https.end();  //Close connection
  }

}


//********************connect to the WiFi******************
void connectToWiFi(){
    WiFi.mode(WIFI_OFF);        //Prevents reconnection issue (taking too long to connect)
    delay(1000);
    WiFi.mode(WIFI_STA);

    Serial.print("Connecting to ");
    Serial.println(ssid);
    WiFi.begin(ssid, password);
    //############OLED#############////
          display.clearDisplay();
          display.setTextSize(1);
          display.setTextColor(SH110X_WHITE); // 'inverted' text
          display.setCursor(0,20);
          display.print("DANG KET NOI WIFI");
          display.setCursor(0,30);
          display.print("SSID: "); display.print(ssid);
          
    //############OLED#############////  
    int i = 0;
    while (WiFi.status() != WL_CONNECTED) {

      delay(999); i++;
      Serial.print(".");
      display.setCursor(45,40);
      display.setTextColor(SH110X_BLACK,SH110X_WHITE);
      display.print(" "); 
      display.print(i); 
      display.print("s "); 
      display.display();
    }
    
    Serial.println("");
    Serial.println("Connected");
  
    Serial.print("IP address: ");
    Serial.println(WiFi.localIP());  //IP address assigned to your ESP
    
    delay(1000);
}
//=======================================================================
