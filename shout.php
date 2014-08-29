<?php
	if (isset($_POST['name']) && isset($_POST['message'])) {
		$name = mysql_real_escape_string($_POST['name']);
		$message = mysql_real_escape_string($_POST['message']);
		if (!empty($name) && !empty($message)) {
			$query = "INSERT INTO shoutbox (date_time, name, message) VALUES (" . time() . ", '" . $name . "', '" . $message . "')";
			mysql_query($query);
			$query_counter++;
		}
	}
	if (isset($_POST['action'])) {
		if (strcmp($_POST['action'], "update") == 0) {
			$result = mysql_query("SELECT * FROM shoutbox ORDER BY date_time DESC LIMIT 10");
			$messages = '';
			while ($row = mysql_fetch_array($result)) {
				$messages = '
					<div class="shout">
						<div class="suser">[' . date("M d g:ia", $row['date_time']) . '] ' . $row['name'] . '</div>
						<div class="smessage"><strong>' . $row['message'] . '</strong></div>
					</div>' . $messages;
			}
			echo $messages;
		}
	}
?>
