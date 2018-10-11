import lcddriver
import time
import datetime

display = lcddriver.lcd()
print("Writing to display")
try:
    display.lcd_display_string("No time to waste", 1)
except KeyboardInterrupt: # If there is a KeyboardInterrupt (when you press ctrl+c), exit the program and cleanup
    print("Cleaning up!")
    display.lcd_clear()
