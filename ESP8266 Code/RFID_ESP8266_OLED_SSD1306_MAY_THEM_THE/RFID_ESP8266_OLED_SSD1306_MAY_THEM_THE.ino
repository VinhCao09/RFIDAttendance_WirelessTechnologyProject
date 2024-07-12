
//RFID-----------------------------
#include <SPI.h>
#include <MFRC522.h>
//NodeMCU--------------------------
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
//OLED---------------------------
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>

//************************************************************************
#define SS_PIN  D3 //D8
#define RST_PIN D4  //D3

#define SCREEN_WIDTH 128 // OLED display width, in pixels
#define SCREEN_HEIGHT 64 // OLED display height, in pixels

// khai bao cau hinh oled
#define OLED_RESET     -1 // Reset pin
#define SCREEN_ADDRESS 0x3C
Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, OLED_RESET);

//************************************************************************
MFRC522 mfrc522(SS_PIN, RST_PIN); // Create MFRC522 instance.
MFRC522::MIFARE_Key newKeyA;
//************************************************************************
const char *ssid = "Wi-MESH 2.4G";
const char *password = "";
const char* device_token  = "5f9977209c597d1b";
//************************************************************************
// String URL = "http://192.168.102.74/project_rfid/getdata.php"; 
String URL = "https://rfid.vinhcaodatabase.com/getdata.php"; 
String getData, getmssv, Link;
String OldCardID = "";
unsigned long previousMillis = 0;
int dem=0, i = 0;
//************************************************************************
void setup() {
  delay(1000);
  Serial.begin(115200);
  SPI.begin();  // Init SPI bus
  mfrc522.PCD_Init(); // Init MFRC522 card
  //---------------------------------------------

  if(!display.begin(SSD1306_SWITCHCAPVCC, SCREEN_ADDRESS)) {
    Serial.println(F("SSD1306 allocation failed"));
    for(;;); // Don't proceed, loop forever
  }
    display.display();
  //-------------------
  connectToWiFi();
  display.clearDisplay();

   //key A mac dinh tu NSX
  for (byte i = 0; i < 6; i++) {
    newKeyA.keyByte[i] = 0xff;
  }

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
          display.setTextColor(WHITE); 
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
    WRITE_TAG();
}

void WRITE_TAG()
{
// Nhận thấy được thẻ!
if (mfrc522.PICC_IsNewCardPresent() && mfrc522.PICC_ReadCardSerial()) {
  // Thực hiện thay đổi khóa A của sector 0 nếu là thẻ mới
    if (mfrc522.PCD_Authenticate(MFRC522::PICC_CMD_MF_AUTH_KEY_A, 0, &newKeyA, &(mfrc522.uid)) == MFRC522::STATUS_OK) {
      // Tạo dữ liệu mới cho khóa A (thay đổi giá trị theo ý muốn) 
       byte newKeyAData[16] = {0x00, 0x11, 0x22, 0x33, 0x44, 0x55,0xFF,0x07,0x80,0x69,0xFF,0xFF ,0xFF,0xFF,0xFF,0xFF};
      // Thực hiện thay đổi khóa A
      if (mfrc522.MIFARE_Write(3, newKeyAData, 16) == MFRC522::STATUS_OK) {
        Serial.println("Thay đổi khóa A thành công!");
        Serial.println("Đây là Key");
         for(int k=0; k<6; k++)
        {
            Serial.print(newKeyAData[k],HEX);
            Serial.print(" ");
        }
      } else {
        Serial.println("Thay đổi khóa A không thành công!");
      }
    }
    else {
      Serial.println("Thẻ này đã được thay đổi khoá A từ trước!");
    }
//Gửi UID thẻ lên khi đã thay đổi khoá A!
              String CardID ="";
              for (byte i = 0; i < mfrc522.uid.size; i++) {
                CardID += mfrc522.uid.uidByte[i];
              }
              SendCardID(CardID);
              delay(1000);
//Gửi UID thẻ lên khi đã thay đổi khoá A!
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
  display.setTextColor(WHITE); // 'inverted' text
  display.setCursor(10,28);
  display.println("Sending the Card ID");
  display.display();
//############OLED#############////
  if(WiFi.isConnected()){
    // neu wifi da ket noi thi thuc hien phuong thuc http post
      WiFiClientSecure *client = new WiFiClientSecure;
      client->setInsecure(); //khai bao cho bao mat
      HTTPClient https;
//

   https.begin(*client, URL);
       https.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Specify content-type header

 String httpRequestData = "card_uid=" + String(Card_uid) + "&device_token=" + String(device_token);

    int  httpCode = https.POST(httpRequestData); //Send the request
    // String payload = https.getString(); //Get the response payload
      Serial.print("httpRequestData: ");
      Serial.println(httpRequestData);
      Serial.println(httpCode);
// nhan ve chuoi ki tu tu website
        String payload = https.getString();    //Get the response payload
// //    Serial.println(Link);   //Print HTTP return code



    // Serial.println(httpCode);   //Print HTTP return code
    Serial.println(Card_uid);     //Print Card ID
    Serial.println(payload);    //Print request response payload
//############OLED#############////
  display.clearDisplay();
  display.setTextSize(1);
  display.setTextColor(WHITE); // 'inverted' text
  if (httpCode == -1) {
  display.setCursor(0,30);
  display.println("KHONG THE KET NOI TOI DATABASE");
  }
  display.setCursor(0,40);
  display.println(payload);
  display.display();
//############OLED#############////


  if (httpCode == 200) {
 
   if (payload == "succesful") {
          display.clearDisplay();
          display.setTextSize(1);
          display.setTextColor(WHITE);
          display.setCursor(0,20);
          display.print("ID THE:");
          display.println(Card_uid);     //Print Card ID
          display.setCursor(0,30);
          display.println("THEM THE THANH CONG!");
          display.print("KIEM TRA TREN WEBSITE");
          display.display();
          delay(2000);
          display.clearDisplay();
      }
      else if (payload == "available") {
    //############OLED#############////
          display.clearDisplay();
          display.setTextSize(1);
          display.setTextColor(WHITE);
          display.setCursor(0,20);
          display.print("ID THE:");
          display.println(Card_uid);     //Print Card ID
          display.setCursor(0,30);
          display.println("THE DA TON TAI! ");
          display.print("VUI LONG THU THE KHAC");
          display.display();
          delay(2000);
          display.clearDisplay();
      //############OLED#############////
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
          display.setTextColor(WHITE); // 'inverted' text
          display.setCursor(0,20);
          display.print("DANG KET NOI WIFI");
          display.setCursor(0,30);
          display.print("SSID: "); display.print(ssid);
    //############OLED#############////  
    while (WiFi.status() != WL_CONNECTED) {
      delay(999); i++;
      Serial.print(".");
      display.setCursor(45,40);
      display.setTextColor(BLACK,WHITE);
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
