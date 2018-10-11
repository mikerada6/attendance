import lcddriver
import time
import datetime
import os

display = lcddriver.lcd()
print("Writing to display")
DIR_PATH = os.path.dirname(os.path.realpath(__file__))
cfgfile = DIR_PATH+"/"+"attendance.ini"
exists = os.path.isfile('/path/to/file')
if not exists:
    import configWriter
try:
    while True:
        currentDT = datetime.datetime.now()
        timestamp = str(currentDT.month)+"/"+str(str(currentDT.day))+"/"+str(currentDT.year)+"  " + str(currentDT.hour)+":"+str(currentDT.minute)+":"+str(currentDT.second)
        display.lcd_display_string_right(timestamp, 1)
        display.lcd_display_string("What would you like to do?", 2)
        buttons1 = ["Sign","","","Sign"]
        buttons2 = ["Out","","","In"]
        display.lcd_display_string_buttons(buttons1,3)
        display.lcd_display_string_buttons(buttons2,4)
        time.sleep(.95)
except KeyboardInterrupt: # If there is a KeyboardInterrupt (when you press ctrl+c), exit the program and cleanup
    print("Cleaning up!")
finally:
    display.lcd_clear()