########################################################################
# DOORBELL PUSH - NOTIFICATION
########################################################################

import RPi.GPIO as GPIO
from push_alert import *

ledPin = 11    # define ledPin
buttonPin = 12    # define buttonPin

def setup():
    
    GPIO.setmode(GPIO.BOARD)      # use PHYSICAL GPIO Numbering
    GPIO.setup(ledPin, GPIO.OUT)   # set ledPin to OUTPUT mode
    GPIO.setup(buttonPin, GPIO.IN, pull_up_down=GPIO.PUD_UP)    # set buttonPin to PULL UP INPUT mode

def loop():
    while True:
        if GPIO.input(buttonPin)==GPIO.LOW: # if button is pressed
            GPIO.output(ledPin,GPIO.HIGH)   # turn on led
            email_alert("HELLO", "DOOR BELL", email_address)
        else : # if button is relessed
            GPIO.output(ledPin,GPIO.LOW) # turn off led  

def destroy():
    GPIO.output(ledPin, GPIO.LOW)     # turn off led 
    GPIO.cleanup()                    # Release GPIO resource

if __name__ == '__main__':     # Program entrance
    setup()
    try:
        loop()
    except KeyboardInterrupt:  # Press ctrl-c to end the program FOR TESTING.
        destroy()