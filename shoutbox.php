<?php
  require_once("connection.php");
  $curr_user = "Myself";
  $MAX_MSGS = 10;
  $DATE_ORDER = "ASC";
?>
<div id="shoutbox">
<?php	
	$result = $mysqli->query("SELECT * FROM shoutbox ORDER BY date_time " . $DATE_ORDER . " LIMIT " . $MAX_MSGS);
	$messages = '';	
	while ($row = $result->fetch_assoc()) {
?>
		<div class="shout">
			<div class="suser">[<?= date("M d g:ia", $row['date_time']) ?>]<?= $row['name'] ?></div>
			<div class="smessage"><strong><?= $row['message'] ?></strong></div>
		</div>
<?php
  }
?>	
</div>
<form method="post" action="shout.php">
	<input type="hidden" id="sbname" name="name" value="<?= $curr_user ?>">
	<textarea type="text" id="sbmessage" name="message" class="message"></textarea>
	<input type="submit" id="sbsubmit" onclick="return sb_message();" value="Submit" />
	<input type="submit" id="sbupdate" onclick="return sb_refresh();" value="Refresh" />	
</form>
