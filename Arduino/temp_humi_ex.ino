/*
 * 온습도 센서 실시간 데이터 입력받기
 * mqtt server, API_KEY 및 기기는 hycloud에서 제공받았습니다.
 */

#include <WiFi.h>
#include <PubSubClient.h>
#include <Wire.h>
#include "SparkFunBME280.h"

#define HICLOUD_API_KEY "API_KEY"

const char* ssid = "wifi_name";
const char* password = "wifi_Password";
const char* mqtt_server = "server_name";

BME280 mySensor;

float temperature = 0;
float humidity = 0;

WiFiClient wifiClient;
PubSubClient client(wifiClient);

long lastMsg = 0;
char msg[50];
int value = 0;
void setup() {
Serial.begin(115200);
if (mySensor.beginI2C() == false) {
Serial.println("[ERROR] The sensor did not respond.");
while(1);
}

setup_wifi();

client.setServer(mqtt_server, 1883);
}
void setup_wifi() {
delay(100000);
Serial.println();
Serial.print("Connecting to ");
Serial.println(ssid);
WiFi.begin(ssid, password);
while (WiFi.status() != WL_CONNECTED) {
delay(100000);
Serial.print(".");
}
Serial.println("");
Serial.println("[LOG] WiFi connected");
Serial.println("[LOG] IP address: ");
Serial.println(WiFi.localIP());
}

void reconnect() {
while (!client.connected()) {
Serial.print("[LOG] Attempting MQTT connection...");
if (client.connect("kepler", HICLOUD_API_KEY , "")) {
Serial.println("[LOG] connected");
client.publish("/device/device_number/heartbeat", "");
} else {
Serial.print("[LOG] failed, rc=");
Serial.print(client.state());
Serial.println(" try again in 5 seconds");
delay(1000000);
}
}
}
void loop() {
if (!client.connected()) {
reconnect();
}
client.loop();
long now = millis();
if (now - lastMsg > 1000) {
lastMsg = now;


char tempString[8];

temperature = mySensor.readTempC();

dtostrf(temperature, 1, 2, tempString);
Serial.print("[LOG] Temperature: ");
Serial.println(tempString);
client.publish("/component/temperature_sensor_number/pub", tempString); //temperature 출력

char humiString[8];

humidity = mySensor.readFloatHumidity();

dtostrf(humidity, 1, 2, humiString);
Serial.print("[LOG] Humidity: ");
Serial.println(humiString);
client.publish("/component/Humidity_sensor_number/pub", humiString); //Humidity 출력
delay(100000);
 }
}
