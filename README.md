# S-Farms
**Smart Farm Management System using Iot**

**Architecural Design of the system is displayed in the image below**
![CALEB 14 BY 24](https://user-images.githubusercontent.com/48515473/204706840-fd139ab2-60e6-43a4-ad0f-69afb1fb9c3b.jpg)

**Hardware Requirements**
1. ESP8266 NodeMCU
2. PIR Motion Sensor
3. Soil Moisture Sensor
4. DHT11 sensor
5. Relay Module
6. Water Pump
7. Buzzer
8. Led 
9. BreadBoard
10. Jumper wires
11. USB cable

**Software Requirements**
1. Arduino IDE
2. Xampp / Wamp / Lamp.
3. Text Editors like VsCode, Atom, etc.


**Instruction on How to Use**
- Step 1: Follow the architecural design in the image above to connect all hardware materials together.
- Step 2: Connect the the microcontroller with the USB cable to microcontroller, and upload the code in the Harware folder of this repository
  1)Select the Port you are connected to
  2)Select the board which is "Generic ESP8266 Module"
  3)Download "DHT library"
  After doing all this then you can proceed to upload the code to the microcontroller
- Step 3: After installing Xampp, navigate to "C:\xampp\htdocs" (note that it can be different depending on your drive), upload the folders "Frontend and Hardware"
- Step 4: Go to your browser and go to the url "http://localhost/phpmyadmin", create a database called "sfms" and import the file in the database folder
- Step 5: After doing all above, you can proceed to view the project on "http://localhost", select the folder and you will see the output
You should see something like this 

![image](https://user-images.githubusercontent.com/48515473/204709007-21f42d8d-fbb9-4b4b-9975-a2b1b5df8027.png)


**Names of Contributors**
1. Dr Emmanuel Ajulo
2. Mr Olaoye
3. Mr Oloko
4. Somade Daniel Oluwaseunfunmi
5. Falola Olamide
6. Nifemi Odukoya
7. Daniel Abati
8. Soyemi Zainab
9. Precious Nwaenze
10. Jide-Aremo Obamisilekunayo
