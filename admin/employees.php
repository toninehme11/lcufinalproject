<?php
session_start();
if(!isset($_SESSION['super']) || $_SESSION['super'] != 'yes')
{
?>
<script>
window.location.href = '../index.php'
</script>
<?php
}else{
	?>
<!DOCTYPE html>
<html lang="en" style="padding: 5rem 0rem 0rem 0rem;">
<head>
  <title>Learniverse</title>
  <!-- <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
  <link rel="stylesheet" type="text/css" href="./employees.css">
  <link rel="shortcut icon" href="../img/learniverselogo.ico" type="image/x-icon">

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>	
  <body style="zoom:90%">
	<?php include './Header.php'?>
<table id='teachers' class="table is-striped" style="width:100%;">
	<thead>
		<th>ID</th>
		<th>Full Name</th>
		<th>Gender</th>
		<th>Birth Date</th>
		<th>Email</th>
		<th>Approval</th>
		<th>Topic</th>
		<th>Teaching Experience</th>
		<th>Teaching Years</th>
		<th>Hours/Week</th>
		<th>Legal ID</th>
		<th>CV</th>
		<th>Accept</th>
		<th>Deny</th>
	</thead>
	<tbody>
	<?php include '../constants/db_conn.php'; ?>
	<?php 
	$query= mysqli_query($conn, "SELECT * FROM teachers order by approval; ");
	while($result= mysqli_fetch_array($query)){
		echo '<tr>
		<td>'.$result['user_id'].'</td>
		<td>'.$result['fname'] .' '. $result['lname'].'</td>
		<td>'.$result['gender'].'</td>
		<td>'.$result['birthdate'].'</td>
		<td>'.$result['email'].'</td>
		<td>'.$result['approval'].'</td>
		<td>'.$result['topic_name'].'</td>
		<td>'.$result['teaching_xp'].'</td>
		<td>'.$result['teaching_years'].'</td>
		<td>'.$result['hours_per_week'].'</td>

		<td><a href="#" class="overlay-trigger"  data-image=" '.base64_encode($result['legal_id']) .'" >Show ID</a></td>

		<div id="overlay-img"></div>
		<td><a href="view_pdf.php?id='.$result['user_id'].'" target="blank"> view cv</object>'."</td>
		<td><button type='button' class='AcceptBtn' onclick='setUpdateId(". $result['user_id'].")'>Accept</button></td>
		<td><button type='button' class='DenyBtn' onclick='setUpdateId(". $result['user_id'].")'>Deny</button></td>
		</tr>";
	 
	}
	?>
	<!-- echo '<img alt="image" title="'.$row['global_topic_name'].' class="card-img-top" src="data:image/jpeg;base64, '.base64_encode($row['pic']) .' "/>';	 -->
	</tbody>
</table>
<script>
var updateId;

// Your setUpdateId function can now set the global variable instead of the hidden input field
function setUpdateId(id) {
  updateId = id;
}

// I changed the selector from '#AcceptBtn' to '.AcceptBtn', because you're using class, not id
$('.AcceptBtn').click(function() {
  $.ajax({
    type: 'POST',
    url: 'accept_teacher.php',
    data: {
      id: updateId, // send the id in the POST request
    },
    success: function(response) {
      console.log(response);
	  location.reload();
    }
  });
});
$('.DenyBtn').click(function() {
  $.ajax({
    type: 'POST',
    url: 'deny_teacher.php',
    data: {
      id: updateId, // send the id in the POST request
    },
    success: function(response) {
      console.log(response);
	  location.reload();
    }
  });
});
  </script>
 	<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
	<script>let table = new DataTable('#teachers');</script>
<script>
// Get the overlay container and overlay trigger elements
const overlayimg = document.getElementById('overlay-img');
const overlayTrigger = document.querySelectorAll('.overlay-trigger');

// Add a click event listener to each overlay trigger element
overlayTrigger.forEach(function (trigger) {
  trigger.addEventListener('click', function (event) {
    event.preventDefault();

    // Get the image URL from the data-image attribute
    const imageBase64 = trigger.getAttribute('data-image');

    // Display the overlay container and set the image as its content
    overlayimg.style.display = 'block';
    overlayimg.innerHTML = `<img src="data:image/jpeg;base64, ${imageBase64}" alt="Overlay Image">`;
  });
});

// Close the overlay when clicking outside the image
overlayimg.addEventListener('click', function (event) {
  if (event.target === this) {
    overlayimg.style.display = 'none';
    overlayimg.innerHTML = '';
  }
});

// Close the overlay when clicking a close button
// Add a close button inside the overlay container
const closeButton = document.createElement('button');
closeButton.innerText = 'X';
overlayimg.appendChild(closeButton);

// Add a click event listener to the close button
closeButton.addEventListener('click', function () {
  overlayimg.style.display = 'none';
  overlayimg.innerHTML = '';
});

</script>
</body>
</html>
	<?php
}
?>