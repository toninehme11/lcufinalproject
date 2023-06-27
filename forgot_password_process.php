<?php
    if (isset($_POST['reset'])){
        $email = $_POST['email'];
    }
    else{
        exit();
    }

require './vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPAuth = true;
    $mail->Username = 'learniverseonline@gmail.com';
    $mail->Password = 'stsfzvjjtyctdvln';
    $mail->setFrom('learnivereonline@gmail.com', 'Admin');
    $mail->IsHTML(true);
    $mail->addAddress($email);
    $mail->Subject = 'Password Reset';

    $code = substr(str_shuffle('1234567890QWERTYUIOPASDFGHJKLZXCVBNM'),0,10);


    //Content
    $mail->Body    = 'To reset your password click <a href="http://localhost/FinalProject/change_password.php?code='.$code.'">here </a>. </br>Reset your password in a day.';

    $conn = new mysqli('localhost', 'root', '', 'learniverse_project');
    if($conn->connect_error){
        die('Could not connect to the database, Please try again.');
    }

    $today = date('d-m-Y'); // Get the current date
    $nextDay = date('d-m-Y', strtotime($today . ' +1 day'));
   
    $verifyQuery = $conn->query("SELECT * FROM students WHERE email = '".$email."'");


    if($verifyQuery->num_rows){

        $nameQuery = $conn->query("UPDATE students SET code = '".$code."', updated_time = '".$nextDay."' WHERE email = '$email'");
        $mail->send();
        echo 'Message has been sent, check your email';
    }else{
        $sql = "SELECT * FROM teachers WHERE email='".$email."'";
        $stmt = $conn->prepare($sql); 
        $stmt->execute();
        $results = $stmt->get_result();
        if($row = $results->fetch_assoc()) {
            $namedQuery = $conn->query("UPDATE teachers SET code = '".$code."', updated_time = '".$nextDay."' WHERE email = '$email'");
            $mail->send();
            echo 'Message has been sent, check your email';
        }else{
            echo 'error';
        }
    }
    
    $conn->close();

?>