<?php 


if (isset($_GET['searchbar'])) {
$searchresult = $_GET['topicsearch'];
include "./constants/db_conn.php";
$sql = "SELECT * FROM topics  where topic_name LIKE '%$searchresult%' ORDER BY topic_id DESC";
$stmt = $conn->prepare($sql); 
$stmt->execute();
$results = $stmt->get_result();

}else
    {
   include "./constants/db_conn.php";
    $sql = "SELECT * FROM topics  where global_topic_id = '$globaltopic' ORDER BY topic_id DESC";
    $stmt = $conn->prepare($sql); 
    $stmt->execute();
    $results = $stmt->get_result();
    
}  
?> 



    
