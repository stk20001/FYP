### LIGHT CONTROL OFF ###

import RPi.GPIO as GPIO

GPIO.setmode(GPIO.BOARD)

GPIO.setup(16, GPIO.OUT)

GPIO.output(16, False)

def destroy():
    GPIO.cleanup()  # Release all GPIO