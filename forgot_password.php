<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/learniverselogo.ico" type="image/x-icon">
    <link rel="stylesheet" href="./forgot.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Forgot Password</title>
</head>
<body>
<?php include './Header.php' ?>
<div class="body2">
    <div class="container h-100">
        <div class="wrapper w-50 ">
            <h2>Forgot Your Password</h2>
        <form id='formContent' action="forgot_password_process.php" method="post"> 
            <label>Email:</label>

            <input class="font_fix" type="email" id ="email" name="email" placeholder="Enter your Email"><br>
                <button id='chajara' type="submit" class="btn-prime btn1" name="reset">Reset</button>
               
            </form>
            <span id='addUser_error-msg' class='hide_error err-msg'>Please Fill All Fields</span>
        </div> 
    </div>   
</div>
</body>
</html>