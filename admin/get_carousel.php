<?php
$urlarray = explode("/", $_SERVER['REQUEST_URI']);
if($urlarray[sizeof($urlarray) - 1] == 'index.php' ||$urlarray[sizeof($urlarray) - 1] == '')
{ 
    include './constants/db_conn.php';
}
else{
    include '../constants/db_conn.php';
    
}
if ($_POST){
$id = $_POST['carouselID'];
$query = mysqli_query($conn, "SELECT * FROM carousel WHERE id = $id");
$result = mysqli_fetch_assoc($query);
echo json_encode($result);
}

$query1 = mysqli_query($conn, "SELECT * FROM carousel");
?>
