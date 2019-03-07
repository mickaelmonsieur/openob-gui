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
Config.read("/home/pi/openob-gui/instreamer.ini")

if len(sys.argv) > 1 and sys.argv[1] == 'autostart':
    if Config.get("instreamer", "Boot") != '1':
        print "Autostart off"
        sys.exit()

logger_factory = LoggerFactory(level=logging.INFO)
link_config = LinkConfig("transmission", Config.get("instreamer", "Encoder_IP"))
audio_interface = AudioInterface("emetteur")

link_config.set("port", Config.get("instreamer", "Listen_Port"))
link_config.set("bitrate", int(Config.get("instreamer", "Bitrate")))
link_config.set("encoding", Config.get("instreamer", "Encoding"))
link_config.set("receiver_host", Config.get("instreamer", "Receiver_IP"))
audio_interface.set("mode", "tx")
audio_interface.set("samplerate", int(Config.get("instreamer", "Samplerate")))
audio_interface.set("type", "alsa")
audio_interface.set("alsa_device", "hw:" + Config.get("instreamer", "Soundcard_ID"))

node = Node("emetteur")
node.run_link(link_config, audio_interface)
