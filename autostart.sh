#!/bin/bash
printf "Launching outstreamer\n"
python /home/pi/openob-gui/outstreamer.py autostart > /dev/null 2> /dev/null &
