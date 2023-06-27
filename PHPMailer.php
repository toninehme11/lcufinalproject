
<?php
    require 'vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // sendMail($_POST['fname'],'','',$_POST['email'],null);

       $mail = new PHPMailer;
       $mail->isSMTP();
       $mail->SMTPDebug = 0;
       $mail->Host = 'smtp.gmail.com';
       $mail->Port = 465;
       $mail->SMTPSecure = "ssl";
       $mail->SMTPAuth = true;
       $mail->Username = 'learniverseonline@gmail.com';
       $mail->Password = 'stsfzvjjtyctdvln';
       $mail->setFrom($_POST['email'], $_POST['fname']);
       $mail->IsHTML(true);
       $mail->addReplyTo($_POST['email'], $_POST['fname']);
       $mail->addAddress('learniverseonline@gmail.com' , $_POST['email']);
       $mail->Subject = 'Contact us from ' .  $_POST['email'];
    //    $mail->msgHTML(file_get_contents('message.html'), __DIR__);
       $mail->Body = $_POST['body'];
    //    $mail->send();
       if(!$mail->send()){
       }


?>
