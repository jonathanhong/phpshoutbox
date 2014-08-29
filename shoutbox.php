<?php
  require_once("connection.php");
?>
<div id="shoutbox">
<?php	
	$result = $mysqli->query("SELECT * FROM shoutbox ORDER BY date_time DESC LIMIT 10");
	$messages = '';	
	while ($row = $result->fetch_assoc()) {
?>
		<div class="shout">
			<div class="suser">[<?= date("M d g:ia", $row['date_time']) ?>]<?= $row['name'] ?></div>
			<div class="smessage"><strong><?= $row['message'] ?></strong></div>
		</div><?= $messages ?>
<?php
  }
?>	
<?= $messages ?>
</div>
<form method="post" action="shout.php">
	<input type="hidden" id="sbname" name="name" value="<?= $row['name'] ?>">
	Message: <textarea type="text" id="sbmessage" name="message" class="message"></textarea>
	<input type="submit" id="sbsubmit" onclick="return sb_message();" value="Submit" />
	<input type="submit" id="sbupdate" onclick="return sb_refresh();" value="Refresh" />	
</form>
