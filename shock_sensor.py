### Shock sensor ###

from ossaudiodev import openmixer
import RPi.GPIO as GPIO
from push_alert import *
from open_door import *
import time

shock_pin = 40  # define sensor pin

def setup():
        GPIO.setmode(GPIO.BOARD)
        GPIO.setup(shock_pin, GPIO.IN, pull_up_down=GPIO.PUD_DOWN)

def loop():
        while True:
            result = GPIO.input(shock_pin)
            if result == 1:
                    time.sleep(1)
                    print("Vibration Detected")
                    email_alert("HELLO", "DOOR BELL ALARM", email_address)

def destroy():
        GPIO.cleanup()          # Release all GPIO

if __name__ == '__main__':      # Program entrance
        setup()
        try:
            loop()
        except KeyboardInterrupt:   # Press ctrl-c to end the program FOR TESTING.
            destroy()
