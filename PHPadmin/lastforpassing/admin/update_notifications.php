<?php
include '../shared/connection.php';
$update = "UPDATE notifications SET read_at=now() WHERE read_at is null and notification_type='Admin'";
             $update_result = mysqli_query($conn, $update) or die(mysqli_error($conn));
          
 ?>