<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="./header.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="shortcut icon" href="../img/learniverselogo.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

	</head>
	<body>



    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php"><span style="color: darkblue;"><b>Learn</span>iverse</b></a>
    <button type="button" class='nav_but btn' id='show_menu'>
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse hide_menu" id="navbarResponsive">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../services.php">Pricing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../aboutlearniverse.php">About Learniverse</a>
          </li>
          <li class="nav-item">
            <a class="nav-link contact" href="../contact_us.php">Contact Us</a>
          </li>
          <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 'YES!') {
                  if (isset($_SESSION['teacher']) && $_SESSION['teacher'] == 'yes'){ ?>
                    <li class="nav-item">
                      <a class="nav-link" href="">Schedule</a>
                    </li>
                    <?php }}
            ?>
          <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 'YES!') {
                  if (isset($_SESSION['super']) && $_SESSION['super'] == 'yes'){ ?>
                    <li class="nav-item">
                      <a class="nav-link" href="./admin">Dashboard Mr(s).<?php echo $_SESSION['fname']; ?></a>
                    </li>
                    <li>
                      <a class="nav-link" href="./admin/employees.php">Teachers</a>
                    </li>
                 <?php }
            ?>
              <li class="nav-item">
                <a class="nav-link" id="logout_btn">Logout Mr(s). <?php echo $_SESSION['fname']; ?></a>
              </li>
            <?php } else {
            ?>
              <li class="nav-item">
                <a class="nav-link" href="../login.php">Login</a>
              </li>
            <?php }?>
        </ul>
        </form>
      </div>
    </div>
  </nav>
   
</body>
<script>
  
  $(logout_btn).on('click', function(){
      window.location.href="logout.php";
    });
  
  $('#show_menu').on('click', function(){
      $('#navbarResponsive').toggleClass('hide_menu');
      $('#navbarResponsive').toggleClass('show_menu');
    });

</script>
<style>
  
@media (min-width: 992px){
  #show_menu{
    display: none!important;
  }
}
@media (max-width: 992px){
  .hide_menu{
  display: none!important;
  height: 0;
  transition: all 0.3s ease-out;
}

.show_menu{
  display:block!important;
  height: 100%;
  transition: all 0.3s ease-in;
}
}
</style>

</html>