<?php 
include "./constants/db_conn.php";

    $sql = "SELECT * FROM global_topics ORDER BY global_id DESC";
    $stmt = $conn->prepare($sql); 
    $stmt->execute();
    $results = $stmt->get_result();
?>