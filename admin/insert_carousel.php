<?php
$urlarray = explode("/", $_SERVER['REQUEST_URI']);
if($urlarray[sizeof($urlarray) - 1] == 'index.php' || $urlarray[sizeof($urlarray) - 1] == '')
{ 
    include './constants/db_conn.php';
}
else{
    include '../constants/db_conn.php';   
}
    if (isset($_FILES['image'])) {
        $title = $_POST['title'];
        $caption = $_POST['caption'];
        $date = date(" Y_m_d h_i");
        $file = $_FILES['image'];
        $extension = $_POST['extension'];
        $file_name = $_POST['file_name'].$date.".".$extension;
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];


        $file_destination = '../img/' . $file_name;
        move_uploaded_file($file_tmp, $file_destination);

        $upload_sql = "INSERT INTO carousel SET images=?, title=?, caption=?";
        $upload_stmt = $conn->prepare($upload_sql);
        $upload_stmt->bind_param("sss",$file_destination,$title,$caption);
        $upload_stmt->execute();

    }
?>