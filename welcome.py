import lcddriver
import time
import datetime
import os
import configparser
import requests
import RPi.GPIO as GPIO

contMainMenu=False
contSignInMenu=False
menus = [contSignInMenu,contMainMenu]

for i in menus:
    i=False
contMainMenu=True
def signIn(channel):
    global menus
    for i in menus:
        i=False
    contSignInMenu=True
    display = lcddriver.lcd()
    display.lcd_clear()
    while contSignInMenu:
        currentDT = datetime.datetime.now()
        timestamp = str(currentDT.month)+"/"+str(str(currentDT.day))+"/"+str(currentDT.year)+"  " + format(currentDT.hour%12, '02d')+":"+format(currentDT.minute, '02d')+":"+format(currentDT.second, '02d')
        display.lcd_display_string_right(timestamp, 1)
        display.lcd_display_string("Sign In", 3)
        display.lcd_display_string("Please swipe card now", 4)
        time.sleep(.95)


GPIO.setmode(GPIO.BOARD)

display = lcddriver.lcd()
print("Writing to display")
DIR_PATH = os.path.dirname(os.path.realpath(__file__))
cfgfile = DIR_PATH+"/"+"attendance.ini"
exists = os.path.isfile(cfgfile)
if not exists:
    import configWriter
config = configparser.ConfigParser()
config.sections()
config.read('attendance.ini')
teacher = config['ROOM']['Teacher']
room = config['ROOM']['Room']
channel=37
GPIO.setup(channel, GPIO.IN, pull_up_down=GPIO.PUD_UP)
GPIO.add_event_detect(channel, GPIO.FALLING, callback=signIn, bouncetime=300)
try:
    while contMainMenu:
        currentDT = datetime.datetime.now()
        timestamp = str(currentDT.month)+"/"+str(str(currentDT.day))+"/"+str(currentDT.year)+"  " + format(currentDT.hour%12, '02d')+":"+format(currentDT.minute, '02d')+":"+format(currentDT.second, '02d')
        display.lcd_display_string_right(timestamp, 1)
        display.lcd_display_string(teacher + "-" + room, 2)
        buttons1 = ["Sign","","","Sign"]
        buttons2 = ["Out","","","In"]
        display.lcd_display_string_buttons(buttons1,3)
        display.lcd_display_string_buttons(buttons2,4)
        time.sleep(.95)
except KeyboardInterrupt: # If there is a KeyboardInterrupt (when you press ctrl+c), exit the program and cleanup
    print("Cleaning up!")
finally:
    display.lcd_clear()
    GPIO.cleanup()
GPIO.cleanup() 
