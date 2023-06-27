<?php

if(isset($_POST)){
    $code = $_POST['code'];
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);
    $type = "";

    $conn = new mysqli('localhost', 'root', '', 'learniverse_project');


    if($conn->connect_error){
        die('Could not connect to the database');
    }
}

$verifyQuery = $conn->query("SELECT * FROM students WHERE code = '".$code."' AND STR_TO_DATE(updated_time, '%d-%m-%Y') >= CURDATE() - INTERVAL 1 DAY;");
if($verifyQuery->num_rows == 0){
    $verifyQuery = $conn->query("SELECT * FROM teachers WHERE code = '".$code."' AND STR_TO_DATE(updated_time, '%d-%m-%Y') >= CURDATE() - INTERVAL 1 DAY;");
    $type = "teacher";
    echo "not done";
}else{
    $type = "student";
}


if ($type == "student"){
    $changeQuery = $conn->query("UPDATE students SET password = '".$pass."' WHERE email = '".$email."' and code = '".$code."' and STR_TO_DATE(updated_time, '%d-%m-%Y') >= CURDATE() - INTERVAL 1 DAY");
    
    if($changeQuery){
        echo "done";
    }else{
        echo "not done 2";
    }
}else if($type == "teacher"){
    $changeQuery = $conn->query("UPDATE teachers SET passcode = '".$pass."' WHERE email = '".$email."' and code = '".$code."' and STR_TO_DATE(updated_time, '%d-%m-%Y') >= CURDATE() - INTERVAL 1 DAY");
    
    if($changeQuery){
        echo "done";
    }else{
        echo "not done 2";
    }
}

    $conn->close();
?>