<?php
$urlarray = explode("/", $_SERVER['REQUEST_URI']);
if($urlarray[sizeof($urlarray) - 1] == 'index.php' || $urlarray[sizeof($urlarray) - 1] == '')
{ 
    include './constants/db_conn.php';
}
else{
    include '../constants/db_conn.php';
    
}

if(isset($_FILES['image'])){
    $id = $_POST['id'];
    $images = $_FILES['image'];
    $date = date(" Y_m_d h_i");
    $file_img_tmp = $images['tmp_name'];
    $file_name = $_POST['file_name'];
    $extension = $_POST['extension'];
    $title = $_POST['title'];
    $caption = $_POST['caption'];
    $image_name = "".$file_name."".$date.".".$extension."";

    $deleteImgQuery = "SELECT * FROM carousel Where id = '".$id."'";
    $imgDeleteSelect = $conn->prepare($deleteImgQuery);
    $imgDeleteSelect->execute();
    $result_img = $imgDeleteSelect->get_result(); 
    $row = $result_img->fetch_assoc();
    $image_path = $row['images'];


    if (file_exists($image_path)) {
        unlink($image_path);
    }

    $img_destination = '../img/'.$image_name;
    move_uploaded_file($file_img_tmp, $img_destination);


    $query = mysqli_query($conn, "UPDATE carousel SET images = '$img_destination', Title = '$title', caption = '$caption' WHERE id = $id");
    echo 'success';
}else{
    $id = $_POST['id'];
    $title = $_POST['title'];
    $caption = $_POST['caption'];
    $query = mysqli_query($conn, "UPDATE carousel SET Title = '$title', caption = '$caption' WHERE id = $id");
    echo 'success';

}
?>
