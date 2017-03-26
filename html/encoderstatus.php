<?php

require("config.php");
include("header.php");

if(isset($_GET['action'])) {
	if($_GET['action'] == 'start') {
		shell_exec("python ".PATH_APPLICATION."/instreamer.py > /dev/null 2> /dev/null &");
	}
	elseif($_GET['action'] == 'stop') {
                shell_exec("/usr/bin/pkill -f instreamer.py");
        }
}

$process = shell_exec("ps -aux | grep 'python ".PATH_APPLICATION."/instreamer.py'");
$lines_arr = preg_split('/\n|\r/',$process);
$lines = count($lines_arr);

if($lines == 4) {
	echo "Running<br>";
	echo "<a href=\"?action=stop\">STOP</a>";
}
else {
	echo "Not running<br>";
	echo "<a href=\"?action=start\">START</a>";
}


include("footer.php");


?>
