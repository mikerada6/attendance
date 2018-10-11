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
    currentDT = datetime.datetime.now()
    timestamp = currentDT.day+"/"
    display.lcd_display_string(timestamp, 1)
    buttons1 = ["Sign","","","Sign"]
    buttons2 = ["Out","","","In"]
    display.lcd_display_string_buttons(buttons1,3)
    display.lcd_display_string_buttons(buttons2,4)
    time.sleep(600)
except KeyboardInterrupt: # If there is a KeyboardInterrupt (when you press ctrl+c), exit the program and cleanup
    print("Cleaning up!")
finally:
    display.lcd_clear()