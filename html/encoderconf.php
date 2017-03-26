<?php

require("config.php");
include("header.php");

if(isset($_POST['encoder_ip']) && isset($_POST['encoder_port']) && isset($_POST['soundcard_id']) && isset($_POST['receiver_ip']) && isset($_POST['bitrate']) && isset($_POST['samplerate'])) {

	$ini_template = "[instreamer]
Encoder_IP=%Encoder_IP%
Listen_Port=%Listen_Port%
Receiver_IP=%Receiver_IP%
Bitrate=%Bitrate%
Samplerate=%Samplerate%
Soundcard_ID=%Soundcard_ID%
Boot=%Boot%";
	
	$boot = isset($_POST['boot']) ? $_POST['boot'] : 0;
	$search=array("%Encoder_IP%", "%Listen_Port%", "%Receiver_IP%", "%Bitrate%", "%Samplerate%", "%Soundcard_ID%", "%Boot%");
	$replace=array($_POST['encoder_ip'], $_POST['encoder_port'], $_POST['receiver_ip'], $_POST['bitrate'], $_POST['samplerate'], $_POST['soundcard_id'], $boot);
	
	$ini_content=str_replace($search,$replace,$ini_template);
	
	if(file_put_contents(PATH_APPLICATION . "/instreamer.ini", $ini_content, LOCK_EX)) {
		echo "<p class=\"bg-success\" style=\"padding:20px\">Settings stored. If you want to apply the changes now, have the encoder stop/start.</p>";
	}
	else {
		echo "<p class=\"bg-danger\" style=\"padding:20px\">Settings not stored!</p>";
	}
	
	
}

$config = parse_ini_file(PATH_APPLICATION . "/instreamer.ini", true);

?>

<form class="form-horizontal" method="post" action="">
<fieldset>

<!-- Form Name -->
<legend>Encoder settings</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="encoderip">Encoder IP</label>  
  <div class="col-md-4">
  <input id="encoderip" name="encoder_ip" placeholder="10.1.0.10" value="<?=$config['instreamer']['Encoder_IP']?>" class="form-control input-md" type="text">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="encoderport">Encoder port</label>  
  <div class="col-md-4">
  <input id="encoderport" name="encoder_port" placeholder="3000" value="<?=$config['instreamer']['Listen_Port']?>" class="form-control input-md" type="text">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="receiverip">Receiver IP</label>  
  <div class="col-md-4">
  <input id="receiverip" name="receiver_ip" placeholder="10.1.0.11" value="<?=$config['instreamer']['Receiver_IP']?>" class="form-control input-md" type="text">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="bitrate">Bitrate</label>  
  <div class="col-md-4">
  <input id="bitrate" name="bitrate" placeholder="128" value="<?=$config['instreamer']['Bitrate']?>" class="form-control input-md" type="text">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="samplerate">Samplerate</label>  
  <div class="col-md-4">
  <input id="samplerate" name="samplerate" placeholder="48000" value="<?=$config['instreamer']['Samplerate']?>" class="form-control input-md" type="text">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="soundcard">Soundcard ID</label>  
  <div class="col-md-4">
  <input id="soundcard" name="soundcard_id" placeholder="1" value="<?=$config['instreamer']['Soundcard_ID']?>" class="form-control input-md" type="text">
  </div>
</div>

<!-- Multiple Checkboxes (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="start_at_boot">Start at boot</label>
  <div class="col-md-4">
    <label class="checkbox-inline" for="start_at_boot-0">
      <input name="boot" id="start_at_boot-0" value="1" <?=($config['instreamer']['Boot']==1)?'checked="checked"':'' ?> type="checkbox">
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
