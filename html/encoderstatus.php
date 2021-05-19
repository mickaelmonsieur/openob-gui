<?php

require ("config.php");
if(MODE=='outstreamer') {
	header("Location: /playerstatus.php");
}
include ("header.php");

if (isset($_GET['action'])) {
	if ($_GET['action'] == 'start') {
		shell_exec("python " . PATH_APPLICATION . "/instreamer.py > /dev/null 2> " . PATH_LOG . "/instreamer.log &");
		sleep(2); //The time the log is created
	}
	elseif ($_GET['action'] == 'stop') {
		shell_exec("/usr/bin/pkill -f instreamer.py");
		shell_exec("python " . PATH_APPLICATION . "/instreamer_stopled.py");
	}
}

$process = shell_exec("ps -aux | grep 'python " . PATH_APPLICATION . "/instreamer.py'");
$lines_arr = preg_split('/\n|\r/', $process);
$lines = count($lines_arr);

echo "<h3>Status</h3>";

if ($lines == 4) {
	echo "<p>Encoder running</p>";
	echo "<a href=\"?action=stop\" class=\"btn btn-danger\">STOP</a>";
}
else {
	echo "<p>Encoder not running</p>";
	echo "<a href=\"?action=start\" class=\"btn btn-success\">START</a>";
}

echo "<h3>Logging</h3>";
echo "<pre>" . shell_exec("tail -n 20 " . PATH_LOG . "/instreamer.log") . "</pre>";

include ("footer.php");
?>
