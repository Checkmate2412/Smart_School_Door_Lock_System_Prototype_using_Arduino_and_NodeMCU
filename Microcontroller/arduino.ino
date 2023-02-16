#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <Servo.h>

Servo doorServo;
LiquidCrystal_I2C lcd(0x27, 16, 2);

int clientSignal = 0;
bool isConnectedToWiFi = false;
bool isConnectedToClient = false;
bool shouldOpenDoor = false;
bool isDetected = false;
bool isTimeOut = false;
bool isClosing = false;
bool buzzerOn = false;

void setup()
{
  Wire.begin(8);
  lcd.backlight();
  lcd.init();
  myservo.attach(2);
  Wire.onReceive(receiveEvent);
  Serial.begin(9600);
  lcd.setCursor(3, 0);
  lcd.print("Connecting");
  lcd.setCursor(4, 1);
  lcd.print("to WiFi.");
  myservo.write(0);
}

// Resets Arduino
void (*+resetFunc)(void) = 0;

void loop()
{
  if (!isConnectedToWiFi)
  {
    lcd.clear();

    // Displays on the LCD that the device is trying to connect to WiFi.
    lcd.setCursor(3, 0);
    lcd.print("Connecting");
    lcd.setCursor(4, 1);
    lcd.print("to WiFi.");
    delay(1000);
  }
  else
  {
    if (!isConnectedToClient)
    {
      lcd.clear();

      // Displays on the LCD that the database is not connected to the device.
      lcd.setCursor(4, 0);
      lcd.print("Database");
      lcd.setCursor(1, 1);
      lcd.print("Not Connected");
      delay(3000);
    }
    else
    {
      lcd.clear();

      // Displays on the LCD that the database is connected to the device.
      lcd.setCursor(4, 0);
      lcd.print("Database");
      lcd.setCursor(4, 1);
      lcd.print("Connected");
      delay(5000);
      isConnectedToWiFi = true;
      doorServo.write(0);

      lcd.clear();

      // Displays the "Status" text on the first row of the LCD.
      lcd.setCursor(5, 0);
      lcd.print("Status");

      // Displays the "Place" text on the second row of the LCD.
      lcd.setCursor(4, 1);
      lcd.print("Place Card");

      if (shouldOpenDoor)
      {
        lcd.setCursor(1, 1);

        // Displays the "Status" text on the second row of the LCD.
        lcd.println("   Accepted     ");

        // Open the door.
        doorServo.write(90);

        if (isDetected)
        {
          lcd.setCursor(2, 1);
          lcd.print("Move Forward");
        }

        // Turns on the buzzer for a second.
        if (buzzerOn)
        {
          tone(3, 800, 1000);
        }

        if (isTimeOut != isClosing)
        {
          // Silence the buzzer.
          noTone(3);

          if (isTimeOut)
          {
            // Displays the "Out of Time" text on the second row of the LCD.
            lcd.setCursor(2, 1);
            lcd.print("Out of Time");
          }

          if (isClosing)
          {
            lcd.setCursor(2, 1);
            // Displays the "Closing" text on the second row of the LCD.
            lcd.print("   Closing   ");
          }

          // Close the door.
          doorServo.write(0);
          delay(2000);
          shouldOpenDoor = false;
          isDetected = false;
          isClosing = false;
          isTimeOut = false;
          buzzerOn = false;
        }
      }
      else
      {
        // Displays the "Declined" text on the second row of the LCD.
        lcd.setCursor(4, 1);
        lcd.print("Declined");
        shouldOpenDoor = false;
      }
    }
  }
}

// Receive message from ESP8266 via i2c connection.
void receiveEvent(int howMany)
{
  String message = "";
  while (Wire.available())
  {
    char c = Wire.read();
    message += c;
  }

  if (message == "wifi_connected")
  {
    isConnectedToWiFi = true;
  }
  else if (message == "wifi_disconnected")
  {
    isConnectedToWiFi = false;
  }
  else if (message == "client_connected")
  {
    isConnectedToClient = true;
  }
  else if (message == "client_disconnected")
  {
    isConnectedToClient = false;
  }
  else if (message == "open_door")
  {
    shouldOpenDoor = true;
  }
  else if (message == "close_door")
  {
    shouldOpenDoor = false;
  }
  else if (message == "reset")
  {
    resetFunc();
  }
  else if (message == "move")
  {
    isDetected = true;
  }
  else if (message == "timeout")
  {
    isTimeOut = true;
  }
  else if (message == "close")
  {
    isClosing = true;
  }
  else if (message == "buzzer")
  {
    buzzerOn = true;
  }
}
