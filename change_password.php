<?php
 if(isset($_GET['code'])){
    $code = $_GET['code'];
    echo "<script>var code = '" . $code . "';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/learniverselogo.ico" type="image/x-icon">
    <link rel="stylesheet" href="./changepassword.css">
    <title>Change Password</title>
</head>
<body>
<?php include './Header.php' ?>
<div class="body2">
    <div class="container h-100">
        <div class="wrapper w-50 ">
            <h2>Change Password</h2>
        <form id="formContent" method="post">
            <label>Email:</label>

            <input class="font_fix" type="email" id ="email" name="email" placeholder="Enter your Email" required><br>

            <label>New Password</label>
            <input class="font_fix" type="password" id ="inputpassword" name="new_password" placeholder="Enter your new password" required><br>

            <div class="button-container">
                <a id='chajara' type="button" class="btn-prime btn1" name="change">Change Password</a>
               
            </div>
            </form>
            <span id='addUser_error-msg' class='hide_error err-msg'>Please Fill All Fields</span>
        </div> 
    </div>   
</div>

<script>
    
    $('#chajara').on('click', function(){
            var email = $('#email').val();
            var pwd = $('#inputpassword').val();
            if (email == '' || pwd == ''){
                $("#email").addClass('error_frame');
                $("#password").addClass('error_frame');
                $('#addUser_error-msg').html('Please Fill All Fields');
                $('#addUser_error-msg').removeClass('hide_error');
            }else{
                $.ajax({
                    type: "POST",
                    url: "./change_password_process.php",
                    data: { 
                        code: code,
                        email: $('#email').val(),
                        pass: pwd,
                    },
                    success: function(result) {
                        console.log(result);
                        if (result == 'done') {
                            window.location.href = './index.php';
                            }
                        else if(result == 'not donedone'){
                            window.location.href = './index.php';
                        }else{
                            window.location.href = './login.php';
                        }
                    },
                    error: function(result) {
                    }
                });
            }
         });
</script>
</body>
</html>