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
    <title>learniverse register</title>
    <link rel="stylesheet" type="text/css" href="./login.css">
</head>
<body  >
<?php include './Header.php' ?>
<div class="body2 bg_img">
    <div class="container h-100">
        <div class="wrapper" id='login_wrapper'>
            <h2>Register to learniverse</h2>
        <form id="formContent">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <label>Full Name:</label>
            <input type="text" id="fullN" name="fname" placeholder="Enter your Full Name"><br>
            <label>Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your Email"><br>
            <label>Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your Password"><br> 
            <label>Enter Password Again:</label>
            <input type="password" id="password1" name="password" placeholder="Enter your Password"><br> 
            <a class="BUTTON" id="hello">Register</a>
        </form>
        <span id='addUser_error-msg' class='hide_error err-msg'>Please Fill All Fields</span>
        </div> 
    </div> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.3/build/js/intlTelInput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>  
    <script>

        $('#hello').on('click', function(){
            var fname = $('#fullN').val();
            var email = $('#email').val();
            var pwd = $('#password').val();
            var pwd1 = $('#password1').val();
            if (fname == '' || email == '' || pwd == '' ||  pwd1 == ''){
                $("#fullN").addClass('error_frame');
                $("#email").addClass('error_frame');
                $("#password").addClass('error_frame');
                $("#password1").addClass('error_frame');
                $('#addUser_error-msg').html('Please Fill All Fields');
                $('#addUser_error-msg').removeClass('hide_error');
            }else if(pwd != pwd1){
                $("#fullN").removeClass('error_frame');
                $("#email").removeClass('error_frame');
                $("#password").addClass('error_frame');
                $("#password1").addClass('error_frame');
                $('#addUser_error-msg').html('passwords do not match');
                $('#addUser_error-msg').removeClass('hide_error');
            }else{
                $.ajax({
                    type: "POST",
                    url: "./add_user.php",
                    data: { 
                        type: 'student',
                        name: $('#fullN').val(),
                        email: $('#email').val(),
                        pass: $('#password').val(),
                    },
                    success: function(result) {
                        if (result == 'email already registered') {
                            $("#fullN").removeClass('error_frame');
                            $("#email").addClass('error_frame');
                            $("#password").removeClass('error_frame');
                            $("#password1").removeClass('error_frame');
                            $('#addUser_error-msg').html('email already registered');
                            $('#addUser_error-msg').removeClass('hide_error');	
                        }else{
                            $('#addUser_error-msg').html('registered successfuly');
                            $('#addUser_error-msg').removeClass('hide_error');	
                            window.location.href="./login.php";
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