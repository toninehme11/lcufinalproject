<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <?php
    include './Header.php';
    // include 'PHPMailer.php';
  ?>
    <meta charset="utf-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="./contact_us.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/learniverselogo.ico" type="image/x-icon">

  </head>
  <body>
 
    <div class="container2">
      <div class="text">Contact Us</div>
      <form action="" method="post">
        <div class="form-row">
          <div class="input-data">
            <input type="text" required id="first" name="first">
            <div class="underline"></div>
            <label for="first">First Name</label>
          </div>
          <div class="input-data">
            <input type="text" required id="last" name="last">
            <div class="underline"></div>
            <label for="last">Last Name</label>
          </div>
        </div>
        <div class="form-row">
          <div class="input-data">
            <input type="text" required id="email" name="email">
            <div class="underline"></div>
            <label for="email">Email Address</label>
          </div>
        </div>
        <div class="form-row">
          <div class="input-data textarea">
            <textarea rows="8" cols="80" required id="message" name="message"></textarea>
            <div class="underline"></div>
            <label for="message">Write your message</label>
          </div>
        </div>
        <div class="form-row submit-btn">
          <div class="input-data">
            <div class="inner"></div>
            <input type="button" value="submit" id="submit" >
          </div>
        </div>
      </form>
    </div>
  </body>
  <?php include './Footer.php'?>
  <script>
$("#submit").on("click", function(){

// If the form is not valid, stop here.
if (!document.querySelector('form').checkValidity()) {
    return;
}

$.ajax({
    type: "POST",
    url: "./PHPMailer.php",
    data: { 
      fname: $('#first').val(),
      uname: $('#last').val(),
      email: $('#email').val(),
      body: $('#message').val(),
    },
    success: function(result) {
      Swal.fire({
          icon: 'success',
          title: 'Mail sent successfully',
          showConfirmButton: false,
          timer: 1500
        })
    },
    error: function(result) {
    }
});
});

  </script>
  <?php 

              
  // if($_POST['submit']){
  //   echo 'kessakhtakyajoe';
  // $fname = $_POST['first'];
  // $uname = $_POST['last'];
  // $email = $_POST['email'];
  // $body = $_POST['message'];

  // $sendMail = "learniverseonline@gmail.com";
  // $Subject = 'Contact Email';
  // sendMail($fname, $uname, '',$body,null);
  // }
  ?>
</html>
