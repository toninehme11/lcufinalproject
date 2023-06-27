<?php 
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="./img/learniverselogo.ico" type="image/x-icon">
    <title>Learniverse Login</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.5/sweetalert2.min.js" integrity="sha512-jt82OWotwBkVkh5JKtP573lNuKiPWjycJcDBtQJ3BkMTzu1dyu4ckGGFmDPxw/wgbKnX9kWeOn+06T41BeWitQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" type="text/css" href="./login.css">
</head>
<body>
<?php include './Header.php' ?>
<div class="body2 bg_img">
    <div class="container h-100">
        <div class="wrapper" id='login_wrapper'>
            <h2>Login to learniverse</h2>
        <form id="formContent" method="post">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <label>Email:</label>

            <input class="font_fix" type="email" id ="email" name="email" placeholder="Enter your Email"><br>

            <label>Password:</label>

            <input type="password" id ="password" name="password" placeholder="Enter your Password" autocomplete="current-password"><br> 
            <div class="button-container">
                <a id='chajara' class="btn-prime btn1">Login</a>
                <a href="./register.php" class='btn-prime btn2' style="margin-left: 2rem;">Register</a>
               
            </div>
            </form>
            <a href="forgot_password.php" id="forgot" style="text-decoration: none;">Forgot Your Password?</a>
            <span id='addUser_error-msg' class='hide_error err-msg'>Please Fill All Fields</span>
        </div> 
    </div>   
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.3/build/js/intlTelInput.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script>

    $('#chajara').on('click', function(){
        var email = $('#email').val();
        var pwd = $('#password').val();
        if (email == '' || pwd == ''){
            $("#email").addClass('error_frame');
            $("#password").addClass('error_frame');
            $('#addUser_error-msg').html('Please Fill All Fields');
            $('#addUser_error-msg').removeClass('hide_error');
        }else{
            $.ajax({
                type: "POST",
                url: "./checkLogin.php",
                data: { 
                    type: 'student',
                    email: $('#email').val(),
                    pass: $('#password').val(),
                },
                success: function(result) {
                    console.log(result);
                    if (result == 'wrong pass') {
                        $("#password").addClass('error_frame');
                        $('#addUser_error-msg').html('password incorrect');
                        $('#addUser_error-msg').removeClass('hide_error');	
                    }else if (result == 'Account does not exist'){
                        $("#email").addClass('error_frame');
                        $("#password").addClass('error_frame');
                        $('#addUser_error-msg').html('Account does not exist');
                        $('#addUser_error-msg').removeClass('hide_error');	
                    }else{
                        window.location.href = './index.php';
                    }
                },
                error: function(result) {
                }
            });
        }
     });
</script>
<?php include './footer.php'; ?>
</body>
</html>
