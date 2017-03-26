<?php
include ("header.php");

if(isset($_POST['restart'])&& $_POST['restart']=='1') {
	shell_exec('sudo /sbin/shutdown -r now');
	// pi ALL=(ALL) NOPASSWD:/sbin/shutdown
}

if (isset($_POST['mode']) && isset($_POST['ip']) && isset($_POST['gateway']) && isset($_POST['dns']) && !empty($_POST['ip']) && !empty($_POST['gateway']) && is_array($_POST['dns']) && ($_POST['mode'] == 'static')) {

	$re = '/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])(\/([0-9]|[1-2][0-9]|3[0-2]))$/';
	preg_match($re, $_POST['ip'], $matches);

	if (count($matches) > 1) {

		$dhcpdconf = "interface eth0
static ip_address=" . $_POST['ip'] . "
static routers=" . $_POST['gateway'] . "
static domain_name_servers=" . implode(",", $_POST['dns']);
		echo "<p class=\"bg-success\" style=\"padding:20px\">IP static enabled. Rebooting...</p>";
		file_put_contents("/etc/dhcpcd.conf", $dhcpdconf, FILE_APPEND | LOCK_EX);
		// usermod -a -G netdev pi
		shell_exec('sudo /sbin/shutdown -r now');
		// pi ALL=(ALL) NOPASSWD:/sbin/shutdown
	}
	else {
		echo "<p class=\"bg-danger\" style=\"padding:20px\">Incorrect IP</p>";
	}
}

if ($_POST['mode'] == 'dhcp') {

	echo "<p class=\"bg-success\" style=\"padding:20px\">DHCP enabled. Rebooting...</p>";
	$dhcpdconf = file_get_contents("/etc/dhcpcd.conf");

	$lines = explode("\n", $dhcpdconf);
	$exclude = array();
	foreach ($lines as $line) {
		if (strpos($line, 'interface eth0') !== FALSE OR strpos($line, 'static ip_address') !== FALSE OR strpos($line, 'static routers') !== FALSE OR strpos($line, 'static domain_name_servers') !== FALSE) {
			continue;
		}
		$exclude[] = $line;
	}

	file_put_contents("/etc/dhcpcd.conf", implode("\n", $exclude), LOCK_EX);
	// usermod -a -G netdev pi
	shell_exec('sudo /sbin/shutdown -r now');
	// pi ALL=(ALL) NOPASSWD:/sbin/shutdown
}

$dhcpdconf=file_get_contents("/etc/dhcpcd.conf");
$static = strpos($dhcpdconf, 'interface eth0');

if($static!==false) {
	preg_match('/static ip_address=(.*)/', $dhcpdconf, $ip);
	preg_match('/static routers=(.*)/', $dhcpdconf, $gateway);
	preg_match('/static domain_name_servers=(.*)/', $dhcpdconf, $dns);
	$dns=explode(",", $dns[1]);
}
else {
	$ip='';
	$gateway='';
	$dns=array();
}
?>

<form class="form-horizontal" method="post" action="">
<fieldset>

<!-- Form Name -->
<legend>IP configuration</legend>

<!-- Multiple Radios (inline) -->
<div class="form-group">
<label class="col-md-4 control-label" for="mode">IP mode</label>
<div class="col-md-4">
<label class="radio-inline" for="mode-0">
<input name="mode" id="mode-0" value="dhcp" type="radio" <?=($static!==true)?'checked="checked"':''?>>
DHCP
</label>
<label class="radio-inline" for="mode-1">
<input name="mode" id="mode-1" value="static" type="radio" <?=($static!==false)?'checked="checked"':''?>>
Static
</label>
</div>
</div>

<!-- Text input-->
<div class="form-group">
<label class="col-md-4 control-label" for="ip">IP address</label>
<div class="col-md-4">
<input id="ip" name="ip" placeholder="10.1.0.10/24" value="<?=trim($ip[1]);?>" class="form-control input-md" type="text">
<span class="help-block">With CIDR notation</span>
</div>
</div>

<!-- Text input-->
<div class="form-group">
<label class="col-md-4 control-label" for="gateway">Gateway</label>
<div class="col-md-4">
<input id="gateway" name="gateway" placeholder="10.1.0.1" value="<?=trim($gateway[1]);?>" class="form-control input-md" type="text">

</div>
</div>

<!-- Text input-->
<div class="form-group">
<label class="col-md-4 control-label" for="dns1">Primary DNS</label>
<div class="col-md-4">
<input id="dns1" name="dns[]" placeholder="8.8.8.8" value="<?=trim($dns[0]);?>" class="form-control input-md" type="text">

</div>
</div>

<!-- Text input-->
<div class="form-group">
<label class="col-md-4 control-label" for="dns2">Secondary DNS</label>
<div class="col-md-4">
<input id="dns2" name="dns[]" placeholder="8.8.4.4" value="<?=trim($dns[1]);?>" class="form-control input-md" type="text">

</div>
</div>

<!-- Button -->
<div class="form-group">
<label class="col-md-4 control-label" for="singlebutton"></label>
<div class="col-md-4">
<button id="singlebutton" name="singlebutton" class="btn btn-danger">Save</button>
</div>
</div>

</fieldset>
</form>

<form class="form-horizontal" method="post" action="">
<fieldset>

<!-- Form Name -->
<legend>Maintenance</legend>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="restart" value="1" class="btn btn-danger">Restart system</button>
  </div>
</div>

</fieldset>
</form>

<?php

include ("footer.php");
?>
