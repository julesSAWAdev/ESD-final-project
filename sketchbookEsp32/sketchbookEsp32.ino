#include <MySQL_Connection.h>
#include <MySQL_Cursor.h>
#include <WiFi.h>
#include <LiquidCrystal.h>
 
// initialize the library with the numbers of the interface pins
LiquidCrystal lcd(19, 23, 18, 17, 16, 15);

const char* ssid = "TW";
const char* password = "toyota2021@wifi6";

char user[] = "root"; // MySQL user login username
char passwordSQL[] = ""; // MySQL user login password

char SELECT_SQL[] = "SELECT * FROM Schedules WHERE roomid=1";

IPAddress server_addr(192,168,1,70); // IP of the your computer   here


WiFiServer  server(80);
void setup() { 
  Serial.begin(9600);

  connectToNetwork();
  mySqlLoop();
}

void loop() {
}
void connectToNetwork() {
  WiFi.begin(ssid, password);
 
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Establishing connection to WiFi..");
  }
 
  Serial.println("Connected to network");
 
}
void mySqlLoop(){
  WiFiClient client;
  MySQL_Connection conn((Client *)&client);
  if (conn.connect(server_addr, 3306, user, passwordSQL)) {
    Serial.println("Database connected.");
  }
  else{
    Serial.println("Connection failed.");
    Serial.println("Recording data.");
  }
  // Initiate the query class instance
  MySQL_Cursor *cur_mem = new MySQL_Cursor(&conn);
  // Execute the query
  cur_mem->execute(SELECT_SQL);
  curr_res->get(cur_mem);
   lcd.begin(20, 4);
  // Print a message to the LCD.
  lcd.print("Room Allocation.");
  lcd.setCursor(0, 1);
  lcd.print("System");
  lcd.setCursor(0, 2);
  lcd.print("Room ID:".curr_res[1]);
  lcd.setCursor(0, 3);
  lcd.print("Now:".  curr_res[2]);
  // Note: since there are no results, we do not need to read any data
  // Deleting the cursor also frees up memory used
  delete cur_mem;
  Serial.println("closing connection\n");
  //client.stop();
}
