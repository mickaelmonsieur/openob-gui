<?php

require("config.php");
include("header.php");


echo shell_exec("uptime") . '<br><br>';

echo nl2br(shell_exec("df -h")) . '<br>';

echo nl2br(shell_exec("free -m")) . '<br>';

echo nl2br(shell_exec("cat /proc/cpuinfo")) . '<br>';

echo nl2br(shell_exec("ifconfig")) . '<br>';

echo nl2br(shell_exec("ps -aux")) . '<br>';

include("footer.php");


?>
