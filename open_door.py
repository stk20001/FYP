########################################################################
# DOOR CONTROL
########################################################################

import RPi.GPIO as GPIO
import time

door_lock_pin = 36  # define doorlockPin

def setup():
    GPIO.setmode(GPIO.BOARD)       # use PHYSICAL GPIO Numbering
    GPIO.setup(door_lock_pin, GPIO.OUT)   # set the ledPin to OUTPUT mode

def door_unlock(open_door_timer):
    while True:
        GPIO.output(door_lock_pin, GPIO.HIGH)  # Unlock the door
        return open_door_timer == 0
        destroy()

def destroy():
    time.sleep(10)
    GPIO.cleanup()  # Release all GPIO


if __name__ == '__main__':    # Program entrance
    setup()
    try:
       door_unlock()
    except KeyboardInterrupt:   # Press ctrl-c to end the program FOR TESTING.
        destroy()
