<?php 


if (isset($_GET['searchbar'])) {
$searchresult = $_GET['teacher_search'];
include "./constants/db_conn.php";
$sql = "SELECT *
FROM teachers
WHERE (fname LIKE '%$searchresult%' OR lname LIKE '%$searchresult%') 
      AND approval = '1'
ORDER BY topic_name ASC;";
$stmt = $conn->prepare($sql); 
$stmt->execute();
$results = $stmt->get_result();

}else if(isset($_GET['topicname']) )
    {
    $topic_name = $_GET["topicname"];    
    include "./constants/db_conn.php";
    $sql = "SELECT * FROM teachers  where topic_name = '$topic_name' and approval='1' ";
    $stmt = $conn->prepare($sql); 
    $stmt->execute();
    $results = $stmt->get_result();
    
} else{
    include "./constants/db_conn.php";
    $sql = "SELECT * FROM teachers where approval = '1'";
    $stmt = $conn->prepare($sql); 
    $stmt->execute();
    $results = $stmt->get_result();

} 
?> 


