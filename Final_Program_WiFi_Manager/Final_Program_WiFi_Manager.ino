#include <WiFiManager.h>

#include <ESP8266HTTPClient.h>
String url = "http://192.168.0.102/kwhmeter/api/create.php";
String url2 = "http://192.168.0.102/kwhmeter/api/update.php";

#include <PZEM004Tv30.h>
PZEM004Tv30 pzem(D3, D4); //D3 //D4

#include <LiquidCrystal_I2C.h>
LiquidCrystal_I2C lcd(0x27, 20, 4); //jika gagal ganti alamat jadi 0x3F

#include <ArduinoJson.h>

#define stop_kontak D5

const unsigned long jeda = 1000;
unsigned long zero  = 0;

#define buzzer D6
int count;

boolean flag = false;

void setup() {
  Serial.begin(115200);

  lcd.begin();
  lcd.setCursor(0, 0);
  lcd.print("Connecting...");

  pinMode(stop_kontak, OUTPUT);
  pinMode(buzzer, OUTPUT);

  WiFiManager wm;
  bool res;
  res = wm.autoConnect("AutoConnectAP", "password"); // password protected ap
  if (!res) {
    Serial.println("Failed to connect");
    // ESP.restart();
  }
  else {
    Serial.println("connected...yeey :)");
  }

  lcd.clear();
}

void loop() {

  float voltage = pzem.voltage();
  if ( !isnan(voltage) ) {
    //    Serial.print("Voltage: "); Serial.print(voltage); Serial.println("V");
  } else {
    Serial.println("Error reading voltage");
  }
  float current = pzem.current();
  if ( !isnan(current) ) {
    //    Serial.print("Current: "); Serial.print(current); Serial.println("A");
  } else {
    Serial.println("Error reading current");
  }
  float power = pzem.power();
  if ( !isnan(power) ) {
    //    Serial.print("Power: "); Serial.print(power); Serial.println("W");
  } else {
    Serial.println("Error reading power");
  }
  float energy = pzem.energy();
  if ( !isnan(energy) ) {
    //    Serial.print("Energy: "); Serial.print(energy); Serial.println("kWh");
  } else {
    Serial.println("Error reading energy");
  }
  float frequency = pzem.frequency();
  if ( !isnan(frequency) ) {
    //    Serial.print("Frequency: "); Serial.print(frequency, 1); Serial.println("Hz");
  } else {
    Serial.println("Error reading frequency");
  }
  float pf = pzem.pf();
  if ( !isnan(pf) ) {
    //    Serial.print("PF: "); Serial.println(pf);
  } else {
    Serial.println("Error reading power factor");
  }
  //  Serial.println();

  lcd.setCursor(0, 0);
  lcd.print(String() + "V:" + voltage + "  ");
  lcd.setCursor(10, 0);
  lcd.print(String() + "C :" + current + "  ");
  lcd.setCursor(0, 1);
  lcd.print(String() + "P:" + power + "  ");
  lcd.setCursor(10, 1);
  lcd.print(String() + "E :" + energy + "  ");
  lcd.setCursor(0, 2);
  lcd.print(String() + "F:" + frequency + "  ");
  lcd.setCursor(10, 2);
  lcd.print(String() + "Pf:" + pf + "   ");

  if (millis() - zero >= jeda) {
    HTTPClient http;
    http.begin(url);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    String httpRequestData = String() + "voltage=" + voltage + "&current=" + current +
                             "&power=" + power + "&energy=" + String(energy, 5) +
                             "&freq=" + frequency + "&pf=" + pf;
    int httpResponseCode = http.POST(httpRequestData);
    if (httpResponseCode > 0) {
      Serial.print("HTTP ");
      Serial.println(httpResponseCode);
      String payload = http.getString();
      Serial.println();
      Serial.println(payload);

      // ArduinoJSon
      //      StaticJsonDocument<64> doc;
      DynamicJsonDocument doc(2048);
      DeserializationError error = deserializeJson(doc, payload);
      if (error) {
        Serial.print(F("deserializeJson() failed: "));
        Serial.println(error.f_str());
        return;
      }
      String status = doc["status"];
      String relay = doc["relay"];
      float batas_kwh = doc["batas_kwh"].as<float>();
      float sisa_kwh = batas_kwh - energy;
      if (sisa_kwh <= 0.009)
        sisa_kwh = 0;

      Serial.println("Status: " + status);
      Serial.println("Relay: " + relay);
      Serial.println("Batas KWH: " + String(batas_kwh));
      Serial.println("Sisa KWH: " + String(sisa_kwh));

      if (status == "OK") {

        //Stop Kontak
        if (relay == "ON") {
          digitalWrite(stop_kontak, HIGH);
        } else if (relay == "OFF") {
          digitalWrite(stop_kontak, LOW);
        }

        //Sisa KWH 0
        if (sisa_kwh <= 0) {
          lcd.setCursor(0, 3);
          lcd.print(String() + "KWH Habis: " + sisa_kwh + "     ");
          count++;
          if (count == 1) {
            digitalWrite(buzzer, HIGH);
          } if (count == 2) {
            digitalWrite(buzzer, LOW);
            count = 0;
          }
          Serial.println("count: " + count);
          if (flag == false) {
            String path = url2 + "?relay=OFF";
            http.begin(path);
            int httpResponseCode = http.GET();
            if (httpResponseCode > 0) {
              Serial.print("HTTP ");
              Serial.println(httpResponseCode);
              String payload = http.getString();
              Serial.println();
              Serial.println(payload);
            }
            else {
              Serial.print("Error code: ");
              Serial.println(httpResponseCode);
              Serial.println(":-(");
            }
            flag = true;
          }
        }
        else if (sisa_kwh > 0) {
          lcd.setCursor(0, 3);
          lcd.print(String() + "KWH Tersedia: " + sisa_kwh + "  ");
          digitalWrite(buzzer, LOW);
          flag = false;
        }


      }

    }
    else {
      Serial.print("Error code: ");
      Serial.println(httpResponseCode);
      Serial.println(":-(");
    }
    zero = millis();
  }

}
