import lcddriver
import time
import datetime

display = lcddriver.lcd()
print("Writing to display")
try:
    display.lcd_display_string("No time to waste", 1)
    display.lcd_display_string_right("gotta go right now",2)
    time.sleep(5)
except KeyboardInterrupt: # If there is a KeyboardInterrupt (when you press ctrl+c), exit the program and cleanup
    print("Cleaning up!")
finally:
    display.lcd_clear()