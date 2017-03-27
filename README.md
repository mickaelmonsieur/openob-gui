# openob-gui

OpenOB-gui is a simple graphical user interface for OpenOB (Open Outside Broadcast), a simple Python/GStreamer based application which implements a highly configurable RTP-based audio link system.
This application is designed to run on Raspberry with Raspbian 8 (Debian Jessie) and is coded in PHP and requires some system permissions. (To modify the interfaces or restart)

# Installation

Install Raspbian Jessie Lite on a SD card: https://www.raspberrypi.org/downloads/raspbian/ (**Do not install PIXEL !**)

Install OpenOB on your Debian system: http://jamesharrison.github.io/openob/tutorial.html#openob-system-basics

Install a Nginx HTTP server with PHP-FPM. Follow this tutorial: https://www.howtoforge.com/tutorial/installing-nginx-with-php-fpm-and-mariadb-lemp-on-debian-jessie/#installing-nginx
MariaDB is not necessary.

# Clone the project

	cd /home/pi
	git clone https://github.com/mickaelmonsieur/openob-gui.git
	
# Adapt Nginx/PHP

nano /etc/nginx/sites-available/default
	
	root /home/pi/openob-gui/html;

nano /etc/php5/fpm/pool.d/www.conf

	user = pi
	group = pi

/etc/init.d/nginx restart

/etc/init.d/php5-fpm restart

# Configure sudo permissions

nano /etc/sudoers

	pi ALL=(ALL) NOPASSWD:/sbin/shutdown

Add the user "pi" to netdev group for editing dhcp client

	usermod -a -G netdev pi

# Add autostart support

nano /etc/rc.local

	su - pi -c /home/pi/openob-gui/autostart.sh
	
# Set application mode

Specify if your raspberry is a outstreamer (player) or a instreamer (encoder)
per default, the config file is a instreamer.
simply comment/uncomment the correct line.

nano /home/pi/openob-gui/html/config.php

	//define('MODE', 'outstreamer');
	define('MODE', 'instreamer');

# Test-it!

Go to: http://raspberry_ip:80/


Developpers, do not hesitate to suggest your pull requests! :)

I am available in consulting for the radios that would be interested to deploy the solution.
(To do this through my personal website : http://www.mickael.be)

Licence: GNU General Public License version 3

https://opensource.org/licenses/gpl-3.0.html