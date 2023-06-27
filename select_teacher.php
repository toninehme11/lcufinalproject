<?php   session_start();
include './constants/db_conn.php';
if (isset($_GET['topicname']) ) {
$topic_name = $_GET["topicname"];
}else{}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href='./index.css'>
  <link rel="stylesheet" type="text/css" href='./css/select_tutor.css'>
  <link rel="shortcut icon" href="./img/learniverselogo.ico" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href='./css/select_topic.css'>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <!-- <script src="./css/hawa.js"></script> -->
  <title>Learniverse</title>
  <?php include './header.php' ?> 
</head>
<body>


<div class="spacetotop">

<div class="sreachbar">
<div class="search-container">
	    <form class="d-flex justify-content-center" action="./select_teacher.php" method="get">
	      <input type="text" placeholder="search for teacher" name="teacher_search">
        <button type="submit" name="searchbar" value="submit"><i class="fa fa-search"></i></button>
	    </form>
  	</div>
</div>


<?php include './app/display_teacher.php' ?>

<div class="container">
  <div class="row d-flex justify-content-center align-center">    
  <?php
    while ($row = $results->fetch_assoc()) { ?>

    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="our-team">
        <div class="picture">
        <?php 
        if ($row['avatar'] == null) {
					echo '<img class="img-fluid" title="'.$row['fname'].' " src="./img/defaultbanner.png"/>';
					}else{
          echo '<img class="img-fluid" title="'.$row['fname'].' " src="data:image/jpeg;base64, '.base64_encode($row['avatar']) .' "/>';	
          }
          ?>
        </div>
        <div class="team-content">
          <?php
          echo'<h3 class="name">'.$row['fname'].' '.$row['lname'].'</h3>'
          .'<h4 class="title">'.$row['topic_name'].'</h4>'
          ?>
        </div>
        <ul class="social">
          <?php
        echo '<li><a href="./schedule/calendar.php?teacher_id='. $row['user_id'].'" class="book-session" aria-hidden="true">book your session </a></li>';
        
        ?>
         </ul>
      </div>
    </div>
<?php
}
?>



  </div>
</div>
<?php include './footer.php'; ?>
</body>

</html>