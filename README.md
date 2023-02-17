<p align="left"> <img src="https://camo.githubusercontent.com/41b4407c394c2bd65aa1f4199f5ce149017b80e314e1207a505c26e9f8f677c5/68747470733a2f2f696d672e736869656c64732e696f2f62616467652f7374617475732d646973636f6e74696e7565642d7265642e737667" alt="discontinued" /> </p>

# Door Lock System Prototype

An IoT prototype project using Arduino Uno and NodeMCU ESP8266 with MySQL Database and PHP localhost website.\
This project was made from April to May 2021.

## Hardware
* Arduino Uno R3
* NodeMCU ESP8266
* NodeMCU ESP8266 Expansion Base Board (For 5V)
* RFID-RC522
* Ultrasonic Sensor HC-SR04
* Active Buzzer
* Micro Servo SG90
* LCD1602
* 12V Power Adapter (For Arduino Uno R3)
* Laptop or Computer (For Server)

## Software
* XAMPP

## Connections
#### Connect the NodeMCU8266 and its Expansion Base Board first.

| Arduino Uno R3 | NodeMCU ESP8266 |   
| --- | --- |
| A5 (SCL) | D1 (GPIO5/SCL) |
| A4 (SDA) | D2 (GPIO4/SDA) |
| GND | GND |
| 5V | 5V |
---
| Arduino Uno R3 | Active Buzzer |
| --- | --- |
| D3 (Digital Pin 3/PWM) | Positive |
| GND | Negative |

| Arduino Uno R3 | Micro Servo SG90|
| --- | --- |
| GND | Brown (GND) |
| 5V | Red (5V) |
| D2 (Digital Pin 2) | Orange (PWM) |

| Arduino Uno R3 | LCD1602 |   
| --- | --- |
| D19 (Digital Pin 19/SCL) | SCL |
| D18 (Digital Pin 18/SDA) | SDA |
| GND | GND |
| 5V | 5V |
---
| NodeMCU ESP8266 | RFID-RC522 |   
| --- | --- |
| 3V | 3.3V |
| D3 (GPIO0/Flash) | RST |
| GND | GND |
| D6 (GPIO12/MISO) | MISO |
| D7 (GPIO13/MOSI) | MOSI |
| D5 (GPIO14/SCLK) | SCK |
| D4 (GPIO02/TXD1) | SDA |
---
| NodeMCU ESP8266 | Ultrasonic HC-SR04 |   
| --- | --- |
| GND | GND |
| D0 | ECHO |
| D8 | GND |
| 5V | VCC |

## Pinouts
<p align="center">
<img alt="Arduino Uno R3" width="600" src="https://docs.arduino.cc/static/6ec5e4c2a6c0e9e46389d4f6dc924073/2f891/Pinout-UNOrev3_latest.png">
<img alt="NodeMCU ESP8266" width="600" src="https://i0.wp.com/randomnerdtutorials.com/wp-content/uploads/2019/05/ESP8266-NodeMCU-kit-12-E-pinout-gpio-pin.png?quality=100&strip=all&ssl=1">
<img alt="NodeMCU ESP8266 Expansion Base Board" width="600" src="https://store.roboticsbd.com/img/cms/1402.PNG">
</p>

## External Libraries
* MFRC522 - https://github.com/miguelbalboa/rfid
* LiquidCrystal_I2C - https://github.com/johnrickman/LiquidCrystal_I2C
