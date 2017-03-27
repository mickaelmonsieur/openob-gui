#!/usr/bin/python
# Imports
import sys
import logging
import ConfigParser

argv = sys.argv
sys.argv = []
from openob.logger import LoggerFactory
from openob.node import Node
from openob.link_config import LinkConfig
from openob.audio_interface import AudioInterface
sys.argv = argv

Config = ConfigParser.ConfigParser()
Config.read("/home/pi/openob-gui/outstreamer.ini")

if len(sys.argv) > 1 and sys.argv[1] == 'autostart':
	if Config.get("outstreamer", "Boot") != '1':
		print "Autostart off"
		sys.exit()

logger_factory = LoggerFactory(level=logging.INFO)
link_config = LinkConfig("transmission", Config.get("outstreamer", "Encoder_IP"))
audio_interface = AudioInterface("recepteur")
link_config.set("port", Config.get("outstreamer", "Listen_Port"))
audio_interface.set("mode", "rx")
audio_interface.set("type", "alsa")
audio_interface.set("alsa_device", "hw:" + Config.get("outstreamer", "Soundcard_ID"))
node = Node("recepteur")
node.run_link(link_config, audio_interface)

