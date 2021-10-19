/* mqtt server, API_KEY 및 기기는 hycloud에서 제공받았습니다.
 * 
 * 가변저항센서와 LED , 조도센서 실시간 데이터 입력받기
 * 
*/
#include <WiFi.h>
#include <PubSubClient.h>
#include <ArduinoJson.h>
#define HICLOUD_API_KEY "API_KEY"

const char* ssid = "wifi_name";
const char* password = "wifi_password";
const char* mqtt_server = "server_name";

int value = 0;
float val = 0;
float valuee = 0;

WiFiClient wifiClient;
PubSubClient client(wifiClient);
DynamicJsonDocument doc(1024);

void callback(char* topic, byte* payload, unsigned int length) {
  DeserializationError error = deserializeJson(doc, String((const char*) payload));
  const char* _value = doc["value"];
  String value = String(_value);

  if (value == "1") {
    digitalWrite(15, HIGH);
    Serial.println("LED ON");
  } else if (value == "0") {
    digitalWrite(15, LOW);
    Serial.println("LED OFF");
  }
}

void setup() {
  Serial.begin(115200);
  pinMode(15, OUTPUT);  //LED
  setup_wifi();
  client.setServer(mqtt_server, 1883);
  client.setCallback(callback);
}

void setup_wifi() {
  delay(10);
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(10000);
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
    if (client.connect("kepler", HICLOUD_API_KEY, "")) {
      Serial.println("[LOG] connected");
      client.publish("/device/device key", ""); //control device
      client.subscribe("/component/LED_number/sub"); // LED sub
      client.subscribe("/component/rotation_sensor_number/sub"); //rotation_sensor sub
      client.subscribe("/component/lightening_sensor_number/sub"); // lightening_sensor sub
    } else {
      Serial.print("[LOG] failed, rc=");
      Serial.print(client.state());
      Serial.println(" try again in 5 seconds");
      delay(100000);
    }
  }
}
void loop() {
  if (!client.connected()) {
    reconnect();
  }
  client.loop();
  char valString[8];
  val = analogRead(36); // rotation sensor connection(analog)
  dtostrf(val, 1, 2, valString);
  Serial.print("[LOG] rotation_data: ");
  Serial.println(valString);
  client.publish("/component/rotation_sensor_number/pub", valString); //rotation_sensor pub
  delay(100000);

  char lightString[8];
  valuee = analogRead(35); // lightening sensor connection(analog)
  dtostrf(valuee, 1, 2, lightString);
  Serial.print("[LOG] light_data: ");
  Serial.println(lightString);
  client.publish("/component/lightening_sensor_number/pub", lightString); //lightening_sensor pub
  delay(100000);
}
