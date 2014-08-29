<?php
  require_once("connection.php");
  $DATE_ORDER = "ASC";
  $MAX_MSGS = 10;

  if (isset($_POST['name']) && isset($_POST['message'])) {
		$name = $_POST['name'];
		$message = $_POST['message'];
		if (!empty($name) && !empty($message)) {
      if (!($query = $mysqli->prepare("INSERT INTO shoutbox (date_time, name, message) VALUES (" . time() . ", '" . $name . "', '" . $message . "')"))) {
        echo "500 Internal Server Error #1";
      }
      if (!$query->bind_param("i", time())) {
        echo "500 Internal Server Error #2";
      }
      if (!$query->bind_param("s", $name)) {
        echo "500 Internal Server Error #3";
      }
      if (!$query->bind_param("s", $message)) {
        echo "500 Internal Server Error #4";
      }
      if (!$query->execute()) {
        echo "500 Internal Server Error #5";
      }
      $query_counter++;
      echo "200 Success";
		}
	}
	if (isset($_POST['action'])) {
		if (strcmp($_POST['action'], "update") == 0) {
			$result = $mysqli->query("SELECT * FROM shoutbox ORDER BY date_time " . $DATE_ORDER . " LIMIT " . $MAX_MSGS);
      while ($row = $result->fetch_assoc()) {
?>
					<div class="shout">
          <div class="suser">[<?= date("M d g:ia", $row['date_time']) ?>]<?= $row['name'] ?></div>
          <div class="smessage"><strong><?= $row['message'] ?></strong></div>
					</div>
<?php
      }
		}
	}
?>
