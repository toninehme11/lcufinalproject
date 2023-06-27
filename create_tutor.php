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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.3/build/js/intlTelInput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <title>learniverse become a tutor</title>
    <link rel="stylesheet" href="contactus.css">
    <link rel="stylesheet" type="text/css" href="css/createtutr.css">
    <link rel="shortcut icon" href="./img/learniverselogo.ico" type="image/x-icon">

</head>
<body>
<?php include './header.php'?>
<?php include'./app/disp_topics.php' ?>
<div class="spacetotop">
    <div class="container" >
        <div class="wrapper">
            <h2>Become a tutor</h2>
          
        <form id="formContent" action="./app/add-tutor.php" method="POST" name="frm" enctype="multipart/form-data">

            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <label>what topic will you be teaching? </label>
        
            <select class="select-topic" name="topic">
              <option value="">select topic</option>
              <?php
               foreach($result as $row)
               {
                echo'<option value="'.$row['topic_name'].'">'.$row['topic_name'].'</option>';
               }
              ?>
            </select> 

          <label>Tell us about your teaching experience: </label> 
        <div class="form-row">
        
          <div class="input-data textarea">
              <textarea rows="8" cols="80" required id="message" name="teaching_xp" required></textarea>
              <div class="underline"></div>
            
          </div>
        </div>
        <label>How many years have you been teaching?</label>
          <div class="form-row">   
         
        <ul class="list radio_buttons1">
        <li class="list__item">
        <label class="label--radio">
            <input type="radio" class="radio" checked  name="years_teaching" value="0-1 years">
            0-1 years
        </label>
        </li>
        <li class="list__item">
        <label class="label--radio">
             <input type="radio" class="radio" name="years_teaching" value="1-3 years">
             1-3 years
         </label>
        </li>
        <li class="list__item">
        <label class="label--radio">
             <input type="radio" class="radio" name="years_teaching" value="3-5 years">
             3-5 years
         </label>
        </li>
        <li class="list__item">
        <label class="label--radio">
             <input type="radio" class="radio" name="years_teaching" value="5-10 years">
             5-10 years
         </label>
        </li>
        <li class="list__item">
        <label class="label--radio">
             <input type="radio" class="radio" name="years_teaching" value="10+ years">
             10+ years
         </label>
        </li>
         </ul>
        </section><br>
            </div>

        <label>Average working hours a week provided for the platform: </label> 
        <div class="form-row">

<ul class="list radio_buttons2">
    <li class="list__item">
      <label class="label--radio">
        <input type="radio" class="radio" checked  name="weekly_teaching_hours" value="2-5 hours per week">
        2-5 hours per week
      </label>
    </li>
    <li class="list__item">
      <label class="label--radio">
        <input type="radio" class="radio" name="weekly_teaching_hours" value="5-8 hours per week">
        5-8 hours per week
      </label>
    </li>
    <li class="list__item">
      <label class="label--radio">
        <input type="radio" class="radio" name="weekly_teaching_hours" value="8-15 hours per week">
        8-15 hours per week
      </label>
    </li>
    <li class="list__item">
      <label class="label--radio">
        <input type="radio" class="radio" name="weekly_teaching_hours" value="15+ hours per week">
        15+ hours per week
      </label>
    </li>
  </ul>
</section><br>
            </div>  

      <label>Upload your cv:</label>
            <div class="form-row">    
         
        <input type="file" id="cv" class="file-upload-wrapper" name="cv" accept="application/pdf" onchange="checkFileSize(this)" required><br>
        <span class="cv-note">Accepted file types: .pdf</span>
        </div><br>

        <label for="teacher-photo">Upload a photo of your id:</label>
          <div class="form-row">
        
        <input type="file" id="legal_id" class="file-upload-wrapper" name="legal_id" accept="image/*" onchange="checkFileSize(this)" required><br>
        <span class="cv-note">This will be used to make sure all our teachers are true users</span>
        
        </div><br>
        <label>First Name:</label>
          <div class="form-row">   
        
        <input type="text" id="fullN" name="fname" placeholder="first Name" require><br>
        </div><br>
        <label>Last Name:</label>
          <div class="form-row">   
        
        <input type="text" id="fullN" name="lname" placeholder="last Name" required ><br>
        </div><br>

        <label>Gender:</label>
          <div class="form-row">   
         
        <ul class="list">
        <li class="list__item">
        <label class="label--radio">
            <input type="radio" class="radio" checked  name="gender" value="male">
            Male
        </label>
        </li>
        <li class="list__item">
        <label class="label--radio">
             <input type="radio" class="radio" name="gender" value="female">
             Female
         </label>
        </li>
         </ul>
        </section><br>
            </div>
            <label>Birthday:</label>
            <div class="form-row">
             
            <input type="date" id="birthdate" name="birthdate" required>
            </div><br>
          <label>Email:</label>
          <div class="form-row">
            
            <input type="email" id="email" name="email" placeholder="email" required>
          </div><br>
          <label>Password:</label>
          <div class="form-row">
            
            <input type="password" id="password" name="passcode" placeholder="Password" required><br> 
            </div><br>
             <label>Enter Password Again:</label>
          <div class="form-row">
           
            <input type="password" id="password1" name="confirmpassword" placeholder="Password" required><br> 
            </div><br>
            
           <div class="form-row submit-btn">
          <div class="input-data">
            <div class="inner"></div>
            <input onclick="return val();" name="create_tut" type="submit" value="submit">
          </div>
        </div>
        
        </form>
        </div>
 
       
        <!-- <span id='addUser_error-msg' class='hide_error err-msg'>Please Fill All Fields</span> -->
        
    </div> 
   
 </div>

   <?php
    if (isset($_SESSION['alert'])) {
  echo "<script>alert('" . $_SESSION['alert'] . "');</script>";
  // set($_SESSION['alert']);
}
?>

    <script type="text/javascript">

// password verification function
function val(){
if(frm.password.value == "")
{
	alert("Enter the Password.");
	frm.password.focus(); 
	return false;
}
if((frm.password.value).length < 8)
{
	alert("Password should be minimum 8 characters.");
	frm.password.focus();
	return false;
}

if((frm.password.value).length > 20)
{
	alert("Password should be maximum 20 characters.");
	frm.password.focus();
	return false;
}

if(frm.confirmpassword.value == "")
{
	alert("Enter the Confirmation Password.");
	return false;
}
if(frm.confirmpassword.value != frm.password.value)
{
	alert("Password confirmation does not match.");
	return false;
}

return true;
}

// file size handling function

function checkFileSize(fileInput) {
  const files = fileInput.files;
  const maxSize = 1024 * 1024; // 1 MB
  
  if (files.length === 0) {
    alert('No file selected!');
    return;
  }
  
  const file = files[0];
  if (file.size > maxSize) {
    alert('File size exceeds the limit of 1 MB!');
    fileInput.value= '';
    return;
  }

}

</script>

</body>
</html>