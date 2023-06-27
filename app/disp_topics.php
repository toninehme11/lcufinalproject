<?php 
include "./constants/db_conn.php";

    $sql = "SELECT * FROM topics ORDER BY topic_id asc";
    $stmt = $conn->prepare($sql); 
    $stmt->execute();
    $result = $stmt->get_result();

?>