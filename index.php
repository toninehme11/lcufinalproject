<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="icon" type="image/png"  href="img/learniverselogo.ico">
  <title>Learniverse</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href='./index.css'>
  <?php include './Header.php' ?>
  
</head>

<body>
  <?php
  if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 'YES!' && !isset($_SESSION['alertDisplayed'])) {
    $_SESSION['alertDisplayed'] = true;
  ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'You have logged in successfully',
        showConfirmButton: false,
        timer: 1500
      })
    </script>
  <?php
  }
  ?>
  <?php include './app/display_global_topics.php' ?>
  
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" >
    <div class="carousel-indicators">
    <?php
    include "./admin/get_carousel.php";
    $i = 0; 
    while($result = mysqli_fetch_array($query1)) {
        echo "<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='{$i}' ";
        if($i === 0){
            echo "class='active' aria-current='true' ";
        }
        echo "aria-label='Slide " . ($i + 1) . "'></button>";
        $i++;
    }
    ?>
    </div>
    <div class="carousel-inner">
    <?php
    mysqli_data_seek($query1, 0); // Reset the data pointer
    $i = 0; 
    while($result = mysqli_fetch_array($query1)){
        echo $i === 0 ? "<div class='carousel-item active'>" : "<div class='carousel-item'>";
        ?>
        <img src="<?php echo str_replace('../', './', $result['images']);?>" class='d-block w-100' alt='...'>
        <div class='carousel-caption'>
            <h1><?php echo $result['Title'] ?></h1>
            <h5><?php echo $result['caption'] ?></h5>
        </div>
        </div>
        <?php 
        $i++;
    }
    ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

    <br>
    <div class="offer py-3 d-flex justify-content-center align-items-center flex-column" style="color:#03144f;">

      <h1><span class='offer-title' style="font-weight:100;">What</span> <b>we offer</b></h1>
      <span class='bar' style='background:#8a35e5; height: 1px; width: 90px; margin: 20px auto;'></span>
    </div>


    <div class="container">
      <div class="row gy-5 d-flex justify-content-center">
      <?php
              while ($row = $results->fetch_assoc()) { ?>
					    <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card" style="background-color: #E6E7EC;height: 100%;border:none">
          <?php 
							echo '<img alt="image" title="'.$row['global_topic_name'].' class="card-img-top" src="data:image/jpeg;base64, '.base64_encode($row['pic']) .' "/>';	
							?>
            <div class="card-body">
              <h4 class="card-title" style="display: flex; justify-content:center; color:#031140;font-size:30px;"><?php echo $row['global_topic_name'] ?></h4>
              <p class="card-text" style="display: flex; justify-content:center;color:#031140;"><?php echo $row['description'] ?></p>
              <a href="select_topic.php?globid=<?php echo $row["global_id"];?>" class="butt"><b>FIND YOUR SUBJECT</b></a>
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
  <div class='counter-wrapper'>
    <div class="counter-learn">
      <div class="row">
        <div class="col">
          <div class="counter-box">
            <div>
              <h1 class='counter' style="display:inline-block;">10000</h1><span
                style="font-weight: bolder;font-size:2em;">+</span>
            </div>
            <h2>SATISFIED STUDENTS</h2>
          </div>
        </div>
        <div class="col">
          <div class="counter-box">
            <div>
            <h1 class='counter' style="display:inline-block;">500</h1><span
              style="font-weight: bolder;font-size:2em;">+</span>
            </div>
            <h2>VETTED TUTORS</h2>
          </div>
        </div>
        <div class="col">
          <div class="counter-box">
            <div>
            <h1 class='counter' style="display:inline-block;">100</h1><span
              style="font-weight: bolder;font-size:2em;">%</span>
            </div>
            <h2>SUCCESS RATE</h2>
          </div>
        </div>
      </div>
    </div>
  </div> 
<br>
  <div class="offer py-3 d-flex justify-content-center align-items-center flex-column text-center"
    style="color:#03144f;">

    <h1><span class='offer-title' style="font-weight:100;">Personalized learning plans</span> <b>based on your needs</b></h1>
    <span class='bar' style='background:#8a35e5; height: 1px; width: 90px; margin: 20px auto;'></span>
  </div>
<br>
  <div class="container" style="text-align: center; height:20rem">
    <div class="step-container row gy-3 d-flex justify-content-center">
      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card h-100">
          <h1>1.</h1>
          <p class="card-text">At Learniverse, we start by talking to you to understand your learning needs and what you
            or your child would like to achieve.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card h-100">
          <h1>2.</h1>
          <p class="card-text">Based on your preferences, we send you a list of recommended teachers. Once you pick your
            preferred tutor, we schedule your trial lesson.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card h-100">
          <h1>3.</h1>
          <p class="card-text">Using the tutor's feedback and everything you shared with us; we develop a learning plan
            catered to your needs or those of your child.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="pricing"> 
    <div class="pricing-title py-3 d-flex justify-content-center align-items-center flex-column text-center" style="color:#03144f;">
    <h1><span class='offer-title' style="font-weight:100;">Our</span> <b> Prices</b></h1>
    <span class='bar' style='background:#8a35e5; height: 1px; width: 90px; margin: 20px auto;'></span>


    <div class="content-pricing" style="color:#03144f;">
      <div class="promo-pricing d-flex align-items-center justify-content-center flex-column mb-5">
        <h4 style="text-align: center;">The price of tutoring depends on the 
          <strong>subject, the teacher, and the package</strong> 
          you choose.
        </h4>
        <a class="btn-pricing btn" href="./services.php"> LEARN MORE </a>
      </div>
    </div>

  </div>
  <?php include './footer.php' ?>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js "></script>
  <script>

    var size = '';
var counterAnimated = false;

function loadCounter() {
  $('.counter').each(function () {
    size = $(this).text().split(".")[1] ? $(this).text().split(".")[1].length : 0;
    var originalValue = parseInt($(this).text());
    $(this).prop('Counter', 0).animate({
      Counter: originalValue
    }, {
      duration: 3000,
      step: function (func) {
        $(this).text(Math.round(func).toFixed(size));
      }
    });
  });
  counterAnimated = true;
}

function handleIntersect(entries, observer) {
  entries.forEach(function (entry) {
    if (entry.isIntersecting && !counterAnimated) {
      loadCounter();
      observer.unobserve(entry.target);
    }
  });
}

var observer = new IntersectionObserver(handleIntersect, { threshold: 0 });

$(window).on('load', function () {
  $('.counter').each(function () {
    observer.observe(this);
  });
});

  </script>
  
</body>

</html>