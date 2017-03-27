<?php

require("config.php");
if(MODE=='instreamer') {
	header("Location: /encoderstatus.php");
}
include("header.php");

if(isset($_POST['encoder_ip']) && isset($_POST['encoder_port']) && isset($_POST['soundcard_id'])) {

	$ini_template = "[outstreamer]
Encoder_IP=%Encoder_IP%
Listen_Port=%Listen_Port%
Soundcard_ID=%Soundcard_ID%
Boot=%Boot%";
	
	$boot = isset($_POST['boot']) ? $_POST['boot'] : 0;
	$search=array("%Encoder_IP%", "%Listen_Port%", "%Soundcard_ID%", "%Boot%");
	$replace=array($_POST['encoder_ip'], $_POST['encoder_port'], $_POST['soundcard_id'], $boot);
	
	$ini_content=str_replace($search,$replace,$ini_template);
	
	if(file_put_contents(PATH_APPLICATION . "/outstreamer.ini", $ini_content, LOCK_EX)) {
		echo "<p class=\"bg-success\" style=\"padding:20px\">Settings stored. If you have changed the IP or port or ID of the card and you want to apply the changes, have the player stop/start.</p>";
	}
	else {
		echo "<p class=\"bg-danger\" style=\"padding:20px\">Settings not stored!</p>";
	}
	
	
}

$config = parse_ini_file(PATH_APPLICATION . "/outstreamer.ini", true);

?>

<form class="form-horizontal" method="post" action="">
<fieldset>

<!-- Form Name -->
<legend>Player settings</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="encoderip">Encoder IP</label>  
  <div class="col-md-4">
  <input id="encoderip" name="encoder_ip" placeholder="10.1.0.11" value="<?=$config['outstreamer']['Encoder_IP']?>" class="form-control input-md" type="text">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="encoderport">Encoder port</label>  
  <div class="col-md-4">
  <input id="encoderport" name="encoder_port" placeholder="3000" value="<?=$config['outstreamer']['Listen_Port']?>" class="form-control input-md" type="text">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="soundcard">Soundcard ID</label>  
  <div class="col-md-4">
  <input id="soundcard" name="soundcard_id" placeholder="1" value="<?=$config['outstreamer']['Soundcard_ID']?>" class="form-control input-md" type="text">
  </div>
</div>

<!-- Multiple Checkboxes (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="start_at_boot">Start at boot</label>
  <div class="col-md-4">
    <label class="checkbox-inline" for="start_at_boot-0">
      <input name="boot" id="start_at_boot-0" value="1" <?=($config['outstreamer']['Boot']==1)?'checked="checked"':'' ?> type="checkbox">
      Yes
    </label>
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

<?php


include("footer.php");


?>
