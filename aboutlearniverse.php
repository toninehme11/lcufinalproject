<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="aboutus.css">
    <link rel="shortcut icon" href="./img/learniverselogo.ico" type="image/x-icon">
    <title>About Learniverse</title>
</head>
<body>
    
<?php include './header.php'; ?>

<div class="image">
    <div class="bg-color"></div>
    <p>About <span><b>Us</b></span></p>
    <h5>Driven by our shared mission of making education accessible to all, we are committed
         to improving and transforming the way we teach and learn.</h5>
</div>
<div class="aboutus pb-5">
  <br>
  <h2>We are on a mission to develop well-rounded students and prepare the next generations for a better future.
</h2>
  <span class='bar' style='background:#8a35e5;
    height: 1px;
    width: 90px;
    margin: 20px auto;'></span>
  <h4>We believe that everyone has the opportunity to excel if they receive the appropriate academic support.</h4>
</div>
<br>
<div class="offer d-flex justify-content-center align-items-center flex-column" style="color:#03144f;">

<h1><span class='offer-title' style="font-weight:100;">Our</span> <b>Story</b></h1>
<span class='bar' style='background:#8a35e5;
height: 1px;
width: 90px;
margin: 20px auto;'></span>
</div>

<div class="container">
  <section class="ourstory">
    <div class="story-image">
      <img src="img/ourstory.jpg">
    </div>
    <div class="about-content">
      <h1>Learniverse</h1>
    <p>We are an online tutorial that provides expert-led courses and workshops on a variety of subjects. Our mission is to make high-quality education accessible to anyone, anywhere in the world.</p>
  <p>We started out as a small team of passionate educators who wanted to create a more effective way for people to learn online. We began by offering free courses and webinars to a small group of students, and quickly grew our community of learners through word-of-mouth recommendations and social media outreach.</p>
  <p>We are proud to have helped thousands of students achieve their learning goals and advance their careers. Our commitment to providing high-quality education at an affordable price remains as strong as ever, and we look forward to continuing to grow and serve our community of learners.</p>
  <a href="" class="learn-more">Learn More</a>

</div> 
  </section>
  </div>

  
  <div class="offer d-flex justify-content-center align-items-center flex-column" style="color:#03144f;">

<h1><span class='offer-title' style="font-weight:100;">Our</span> <b> Goals</b></h1>
<span class='bar' style='background:#8a35e5  ;
height: 1px;
width: 90px;
margin: 20px auto;'></span>
</div>

<section id="our-goal">
    <div class="goals">
      <div class="goal">
      <i class="fa-solid fa-circle-check" style="color: #0099a8;"></i>
        <h3>Accessibility</h3>
        <p>Make education <br><b style="color:#031140; font-size:18px;">accessible to all</b></p>
      </div>
      <div class="goal">
      <i class="fa-solid fa-circle-check" style="color: #0099a8;"></i>
        <h3>Excellence</h3>
        <p>Become the <br><b style="color:#031140; font-size:18px;">#1 online tutoring platform</b></p>
      </div>
      <div class="goal">
      <i class="fa-solid fa-circle-check" style="color: #0099a8;"></i>
        <h3>Opportunities</h3>
        <p>Create <br><b style="color:#031140; font-size:18px;">job opportunities for qualified teachers</b></p>
      </div>
    </div>
  </div>
</section>
<br>
<div class="offer d-flex justify-content-center align-items-center flex-column" style="color:#03144f;">

<h1><span class='offer-title' style="font-weight:100;">Our</span> <b> Values</b></h1>
<span class='bar' style='background:#8a35e5;
height: 1px;
width: 90px;
margin: 20px auto;'></span>
</div>





<section id="our-value">
  <br>
    <div class="values">
      <div class="value">
      <i class="fa-solid fa-lightbulb" style="color: #0099a8;"></i>
        <p>INNOVATION</p>
      </div>
      <div class="value">
      <i class="fa-solid fa-people-group" style="color: #0099a8;"></i>
        <p>TEAMWORK</p>
      </div>
      <div class="value">
      <i class="fa-solid fa-hand-holding-heart" style="color: #0099a8;"></i>
        <p>OWNERSHIP</p>
      </div>
      <div class="value">
      <i class="fa-solid fa-scale-balanced" style="color: #0099a8;"></i>
        <p>INTEGRITY</p>
      </div>
    </div>
  </div>
</section>
<br>
<div class="online-trial">
  <h1>Ready to start your learning journey?</h1>
  <br>
  <a href="./select_teacher.php" class="request-btn">REQUEST YOUR ONLINE TRIAL</a>
</div>

  <?php include './footer.php'; ?>

</body>
</html>