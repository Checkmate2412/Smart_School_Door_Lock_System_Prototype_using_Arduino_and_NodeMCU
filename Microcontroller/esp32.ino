#include <Wire.h>
#include <SPI.h>
#include <MFRC522.h>
#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
#include <ESP8266mDNS.h>
#include <SoftwareSerial.h>
#include <WiFiClient.h>

String strID, keyStatus = "";
int duration, distance, timer;
bool reset = false;
bool wifiEnable = false;
bool buzzerOn = false;
bool shouldOpenDoor = false;
bool isTimeOut = false;
bool isClosing = false;

const int trigPin = D8;
const int echoPin = D0;
const int rstPin = D3;
const int ssPin = D4;

// WiFi credentials.
const char *ssid = "*";
const char *password = "*";

// IP Address of MySQL Database.
const char host[] = "*";

WiFiClient client;
MFRC522 rfid(ssPin, rstPin);
MFRC522::MIFARE_Key key;

void setup()
{
  Serial.begin(9600);
  Wire.begin(D2, D1);
  SPI.begin();
  rfid.PCD_Init();
  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);

  // Connecting to WiFi
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);

  // Reconnecting to WiFi
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(500);
  }
  wifiEnable = true;
  Wire.beginTransmission(8);
  // Send "wifi_connected" message to Arduino.
  Wire.write("wifi_connected");
  Wire.endTransmission();
  delay(3000);
}

void loop()
{

  // Checks if the device is not connected to WiFi.
  while (WiFi.status() != WL_CONNECTED)
  {
    Wire.beginTransmission(8);
    // Send "wifi_disconnected" message to Arduino.
    Wire.write("wifi_disconnected");
    Wire.endTransmission();

    wifiEnable = false;
    delay(500);

    if (!reset)
    {
      Wire.beginTransmission(8);
      // Send "reset" message to Arduino.
      Wire.write("reset");
      Wire.endTransmission();
      reset = true;
    }
  }

  // Checks if the device is connected to WiFi.
  if (WiFi.status() == WL_CONNECTED)
  {
    Wire.beginTransmission(8);
    // Send "wifi_connected" message to Arduino.
    Wire.write("wifi_connected");
    Wire.endTransmission();
    wifiEnable = true;
    reset = false;
  }

  if (wifiEnable)
  {
    // If the database is connected.
    if (client.connect(host, 80))
    {
      client.stop();
      Wire.beginTransmission(8);
      // Send "client_connected" message to Arduino.
      Wire.write("client_connected");
      Wire.endTransmission();

      strID = "", keyStatus = "";
      if (!rfid.PICC_IsNewCardPresent() || !rfid.PICC_ReadCardSerial())
        return;

      MFRC522::PICC_Type piccType = rfid.PICC_GetType(rfid.uid.sak);

      // Checks if the scanned RFID is MIFARE Classic Type.
      if (piccType != MFRC522::PICC_TYPE_MIFARE_MINI && piccType != MFRC522::PICC_TYPE_MIFARE_1K &&
          piccType != MFRC522::PICC_TYPE_MIFARE_4K)
      {
        return;
      }

      // Converts UUID from RFID to 4 hex bytes.
      for (byte i = 0; i < 4; i++)
      {
        strID += (rfid.uid.uidByte[i] < 0x10 ? "0" : "") + String(rfid.uid.uidByte[i], HEX) + (i != 3 ? ":" : "");
      }

      strID.toUpperCase();
      dataBase();
      keyStatus = keyStatus.substring(keyStatus.length() - 2, keyStatus.length());

      // If the RFID key exists in the database.
      if (keyStatus == "OK")
      {
        Wire.beginTransmission(8);
        // Send "open_door" message to Arduino.
        Wire.write("open_door");
        Wire.endTransmission();

        do
        {
          // Ultrasonic is turned on to detect if someone is
          // standing in front of the door.
          digitalWrite(trigPin, LOW);
          digitalWrite(trigPin, HIGH);
          digitalWrite(trigPin, LOW);
          pinMode(echoPin, INPUT);
          duration = pulseIn(echoPin, HIGH);
          distance = (duration / 2) / 29.1; // centimeter (cm)

          // 10 second timer before the door automatically closes
          if (timer >= 0 && timer <= 1000 && !shouldOpenDoor)
          {
            timer++;

            if (timer > 700)
            {

              if (!buzzerOn)
              {
                Wire.beginTransmission(8);
                // Send "buzzer" message to Arduino.
                Wire.write("buzzer");
                Wire.endTransmission();
                buzzerOn = true;
                ;
              }
            }

            // If the timer is done, the door will automatically close.
            if (timer == 1000)
            {
              Wire.beginTransmission(8);
              // Send "timeout" message to Arduino.
              Wire.write("timeout");
              Wire.endTransmission();
              isTimeOut = true;
            }
          }

          // If the distance between the ultrasonic sensor and the person
          // is below or equal to 20 cm, then the timer will stop.
          if (distance <= 20 && !shouldOpenDoor)
          {
            shouldOpenDoor = true;
            Wire.beginTransmission(8);
            Wire.write("move");
            Wire.endTransmission();
          }
          // Assuming that the person has already entered the door,
          // the door will automatically close.
          if (distance > 20 && shouldOpenDoor)
          {
            delay(300);
            dataBase();
            Wire.beginTransmission(8);
            Wire.write("close");
            Wire.endTransmission();
            isClosing = true;
            shouldOpenDoor = false;
          }
        } while (isClosing == false && isTimeOut == false);

        timer = 0;
        buzzerOn = false;
        isTimeOut = false;
        isClosing = false;
      }

      // If the RFID key does not exist in the database.
      else if (keyStatus == "NO")
      {
        Wire.beginTransmission(8);
        // Send "close_door" message to Arduino.
        Wire.write("close_door");
        Wire.endTransmission();
      }
      rfid.PICC_HaltA();
      rfid.PCD_StopCrypto1();
    }

    // If the database is disconnected.
    else if (!client.connect(host, 80))
    {
      Wire.beginTransmission(8);
      // Send "client_disconnected" message to Arduino.
      Wire.write("client_disconnected");
      Wire.endTransmission();
    }
  }
}

// Responsible for the database.
void dataBase()
{
  String databaseLink = "";

  if (keyStatus != "")
  {
    // Insertion of time-in or time-out record into the database.
    databaseLink = "/school_management/arduinoinsert.php?keyCard=";
  }

  else if (keyStatus == "")
  {
    // Determines if an RFID key exists.
    databaseLink = "/school_management/arduinorfid.php?keyCard=";
  }

  if (client.connect(host, 80))
  {
    client.print("GET " + databaseLink + strID + " HTTP/1.1\r\nHost: " + host + "\r\n" + "Connection: close\r\n\r\n");

    if (keyStatus == "")
    {
      while (client.connected() && !client.available())
        delay(1);

      while (client.available())
      {
        char c = client.read();
        keyStatus += c;
      }
    }
    client.stop();
  }
  // If the database is disconnected.
  else
  {
    Wire.beginTransmission(8);
    // Send "client_disconnected" message to Arduino.
    Wire.write("client_disconnected");
    Wire.endTransmission();
  }
}
