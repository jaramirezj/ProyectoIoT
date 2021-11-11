import serial,time,json
import requests


URL = "http://192.168.1.21/ProyectoIoT/controller/IOTcontroller.php"
with serial.Serial("/dev/ttyUSB0",9600,timeout=1) as ser:
    while True:
        read = ser.readline().decode()
        rfid = ""
        password = ""
        if read[0:3] == 'uid':
            print("uid")
            while rfid=="":
                rfid = ser.readline().decode('utf-8').strip()
            print(rfid)
            while read[0:4] != 'pass':
                read = ser.readline().decode()
            password = ser.readline().decode('utf-8').strip()
            PARAMS = {'rfid':rfid, 'pass':password}
            r = requests.get(url = URL, params = PARAMS)
            respuesta = r.text
            ser.write(respuesta.encode())
        elif read[0:6] == 'estado':
            estado=1
            PARAMS = {'estado':estado}
            r = requests.get(url = URL, params = PARAMS)
            respuesta = r.text
            ser.write(respuesta.encode())
        elif read[0:6] == 'salida':
            estado=1
            PARAMS = {'salida':salida}
            r = requests.get(url = URL, params = PARAMS)
            respuesta = r.text
