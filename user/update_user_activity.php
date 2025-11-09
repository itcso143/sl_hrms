<?php
$user_id = $_SESSION['id'] ?? null;

if ($user_id) {
  $now2 = date('Y-m-d H:i:s');
  $sql = "UPDATE tbl_users SET last_activity = '$now2', status_online = 'online' WHERE id = '$user_id'";
  $con->query($sql);
}


?>
