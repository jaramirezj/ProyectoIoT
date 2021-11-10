import requests,serial,time

URL = "http://192.168.X.X/ProyectoIoTcontroller/IOTcontroller.php"

rfid = "uid"
password = "pass"

PARAMS={'rfid':rfid, 'password':password}
r = requests.get(url=URL,params=PARAMS)
respuesta = r.text
print(respuesta)