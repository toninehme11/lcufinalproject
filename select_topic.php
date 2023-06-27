<?php   session_start();
if (isset($_GET['globid']) ) {
$globaltopic = $_GET["globid"];
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
  <link rel="stylesheet" type="text/css" href='./css/select_topic.css'>
  <link rel="shortcut icon" href="./img/learniverselogo.ico" type="image/x-icon">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <title>Learniverse</title>
</head>
<body>
<?php include './header.php' ?> 


<div class="spacetotop">

<div class="sreachbar">
<div class="search-container">
	    <form class="d-flex justify-content-center"action="./select_topic.php" method="get">
	      <input type="text" placeholder="search for topics" name="topicsearch">
        <button type="submit" name="searchbar" value="submit"><i class="fa fa-search"></i></button>
	    </form>
  	</div>
</div>
<?php include './app/display_topics.php' ?>


<section>
<div class="container">
      <div class="row gy-5 d-flex justify-content-center">
      <?php
              while ($row = $results->fetch_assoc()) { ?>
					    <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card" style="background-color: #E6E7EC;height: 100%;">
          <?php 
							echo '<img alt="image" title="'.$row['topic_name'].' class="card-img-top" src="data:image/jpeg;base64, '.base64_encode($row['pic']) .' "/>';	
							?>
            <div class="card-body">
              <h4 class="card-title" style="color: #031140; display: flex; justify-content:center;font-size:30px;"><?php echo $row['topic_name'] ?></h4>
              <a href="select_teacher.php?topicname=<?php echo $row['topic_name']; ?>" class="butt"><b>SELECT SUBJECT</b></a>
            </div>
          </div>
        </div>

        <?php
    
 }
 ?> 
      </div>
    </div>
    </div>
  </section>
  <br><br>


<?php include './footer.php' ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js "></script>

<script>
  function logout() {

    Swal.fire({
      icon: 'success',
      title: 'You have logged out successfully',
      showConfirmButton: false,
      timer: 1500
    });
  }
</script>

</body>

</html>