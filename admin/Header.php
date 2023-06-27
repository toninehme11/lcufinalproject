<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="./header.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="shortcut icon" href="../img/learniverselogo.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	</head>
	<body  >

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>


    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="./index.php"><span style="color: darkblue;"><b>Learn</span>iverse</b></a>
      <button type="button" class='nav_but btn' id='show_menu'>
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse hide_menu" id="navbarResponsive">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="./index.php">Home Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Home User</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./employees.php">Tutor Access</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="./WhatWeOffer.php">WhatWeOffer</a>
          </li> -->
        </ul>
        </form>
      </div>
    </div>
  </nav>
   
</body>
<script>
  
  $('#show_menu').on('click', function(){
      $('#navbarResponsive').toggleClass('hide_menu');
      $('#navbarResponsive').toggleClass('show_menu');
    });

</script>
<style>
  
@media (min-width: 992px){
  #show_menu{
    display: none;
  }
}
@media (max-width: 992px){
  .hide_menu{
  display: none;
  height: 0;
  transition: all 0.3s ease-out;
}

.show_menu{
  display:block;
  height: 100%;
  transition: all 0.3s ease-in;
}
}
</style>
</html>