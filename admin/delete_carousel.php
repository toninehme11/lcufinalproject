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
$id = $_POST['id'];


$deleteImgQuery = "SELECT images FROM carousel Where id = $id";
$imgDeleteSelect = $conn->prepare($deleteImgQuery);
$imgDeleteSelect->execute();
$result_img = $imgDeleteSelect->get_result(); 
$row = $result_img->fetch_assoc();
$image_paths = $row['images'];

if (file_exists($image_paths)) {
  unlink($image_paths);
}


$query = "DELETE FROM carousel WHERE id = $id";
mysqli_query($conn, $query);
echo 'Deleted successfully.';
}
?>
