<?php
    include '../constants/db_conn.php';
    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "UPDATE teachers SET approval = 0 WHERE user_id = $id";
        $result = mysqli_query($conn, $query);
      
        if(!$result) {
          die('Query Failed'. mysqli_error($conn));
        }
      } else {
        echo "ID not set in POST array";
      }
?>
