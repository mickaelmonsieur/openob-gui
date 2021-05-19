#!/usr/bin/python
#-- coding: utf-8 --

import ConfigParser
import RPi.GPIO as GPIO

Config = ConfigParser.ConfigParser()
Config.read("/home/pi/openob-gui/instreamer.ini")

LED = Config.getint("instreamer", "GPIO")
GPIO.setmode(GPIO.BOARD)
GPIO.setwarnings(False)
GPIO.setup(LED, GPIO.OUT)
GPIO.output(LED, GPIO.LOW)
