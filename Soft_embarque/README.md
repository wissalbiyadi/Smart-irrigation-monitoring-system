🌿 Smart Automatic Watering System

## 🎯 Project Description

This project aims to design an embedded system* based on a **Raspberry Pi** that automates plant watering.
By integrating several sensors and a user-friendly web interface, the system measures soil humidity, temperature, and water level to water the plants automatically and efficiently.

The project is built on a client–server architecture:

* Server: Raspberry Pi running Python and C scripts to control the sensors and the water pump.
* Client: A web interface developed in PHP/HTML/JS to monitor and control the system in real time.

## 🧩 Main Features

* 🌱 Automatic soil moisture measurement (FC-28 sensor)
* 🌡️ Temperature and humidity monitoring (DHT11 sensor)
* 💧 Automatic control of the water pump
* 📊 Real-time data display on a web interface
* 💾 Data logging in an SQLite3 database
* 🧠 Historical data visualization for analysis and optimization


## 🏗️ Technical Architecture

### Server (Raspberry Pi)

* **Languages:** Python / C
* **Sensors and actuators:**

  * FC-28 (Soil moisture sensor)
  * DHT11 (Temperature and humidity sensor)
  * Ultrasonic sensor (Water level)
  * Water pump and indicator LEDs
* **Database:** SQLite3

### Client (Web Interface)

* **Languages:** PHP, HTML, CSS, JavaScript
* **Web server:** lighttpd
* **Communication:** RESTful API in Python


## 📂 Project Structure

📦 SmartWateringSystem
├── README.md
├── server/
│   ├── sol.py
│   ├── temperature_humidite.py
│   ├── pompe.py
│   ├── water_sensor.py
│   ├── io.c
│   └── io.h
├── web/
│   ├── web_led7.php
│   ├── test1.php
│   ├── test2.php
│   ├── pompe.php
│   ├── water_sensor.php
│   └── assets/
│       └── style.css
├── database/
│   ├── sol.db
│   ├── temperature_humidite.db
│   └── historique.db
└── docs/
    └── Report.pdf

🧪 Testing and Validation

* Unit tests performed for each sensor (LEDs, FC-28, DHT11, pump, ultrasonic).
* Regression testing done on the web interface to ensure stability after updates.
* Real-world validation with live sensor readings and active pump control.


📈 Results and Future Improvements

The system successfully maintains optimal soil humidity while reducing water consumption.
Future enhancements could include:

* Adding Wi-Fi remote control via mobile app.
* Sending alerts when the water tank is empty.
* Improving the user interface design.



