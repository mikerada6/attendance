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
    display.lcd_display_string("No time to waste", 1)
    display.lcd_display_string_right("abcdefghijklmnopqrstuvwxyz",2)
    display.lcd_display_string_right("Michael",3)
    time.sleep(600)
except KeyboardInterrupt: # If there is a KeyboardInterrupt (when you press ctrl+c), exit the program and cleanup
    print("Cleaning up!")
finally:
    display.lcd_clear()