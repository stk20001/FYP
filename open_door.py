### DOOR CONTROL ###


import RPi.GPIO as GPIO
import time

door_lock_pin = 36  # define doorlockPin

def setup():
    GPIO.setmode(GPIO.BOARD)
    GPIO.setup(door_lock_pin, GPIO.OUT)

def door_unlock():
    while True:
        GPIO.output(door_lock_pin, GPIO.HIGH)  # Unlock the door
        destroy()

def destroy():
    time.sleep(10)
    GPIO.cleanup()              # Release all GPIO

if __name__ == '__main__':      # Program entrance
    setup()
    try:
       door_unlock()
    except KeyboardInterrupt:   # Press ctrl-c to end the program.
        destroy()
