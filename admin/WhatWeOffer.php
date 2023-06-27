<?php include './Header.php'; ?>

<?php
session_start();
if(!isset($_SESSION['super']) || $_SESSION['super'] != 'yes')
{
  echo "<script>window.location.href = '../index.php'</script>";
}else{
  include '../constants/db_conn.php';
?>
<!DOCTYPE html>
<html lang="en"  style="padding: 5rem 2rem;">
<head>
  <!-- <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link rel="shortcut icon" href="../img/learniverselogo.ico" type="image/x-icon">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
 
  <!-- The Update Modal -->
  <div class="modal" id="updateModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Update Carousel</h4>
          <button type="button" class="close" onclick="closeModal()">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <form id="updateForm">
			<label for="updateId">ID:</label><br>
            <input disabled type="text" id="updateId"><br>
            <label for="updateImages">Images:</label><br>
            <input type="text" id="updateImages" name="updateImages"><br>
            <label for="updateTitle">Title:</label><br>
            <input type="text" id="updateTitle" name="updateTitle"><br>
            <label for="updateCaption">Caption:</label><br>
            <input type="text" id="updateCaption" name="updateCaption"><br>
          </form>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="confirmUpdate">Update</button>
          <button type="button" class="btn btn-danger" onclick="closeModal()">Close</button>
        </div>
      </div>
    </div>
  </div>

    <!-- The Delete Confirmation Modal -->
  <div class="modal" id="deleteModal">
      <div class="modal-dialog">
          <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                  <h4 class="modal-title">Confirm Deletion</h4>
                  <button type="button" class="close" onclick="closeModal()">&times;</button>
              </div>
              <!-- Modal body -->
              <div class="modal-body">
                  Are you sure you want to delete this carousel?
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                  <button type="button" class="btn btn-primary" id="confirmDelete">Yes</button>
                  <button type="button" class="btn btn-danger" onclick="closeModal()">No</button>
              </div>
          </div>
      </div>
  </div>

  <!-- carousel Table -->
  <table id='carousel' class="table is-striped" style="width:100%;">
    <thead>
      <tr>
        <th>ID</th>
        <th>Images</th>
        <th>Title</th>
        <th>Caption</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
	<?php
	$query = mysqli_query($conn, "SELECT * FROM carousel");
	while($result = mysqli_fetch_array($query)){
	echo "<tr>
		<td>".$result['id']."</td>
		<td>".$result['images'] ."</td>
		<td>".$result['Title']."</td>
		<td>".$result['caption']."</td>
		<td><button type='button' class='updateBtn' onclick='getcarouselId(". $result['id'].")'>Update</button></td>
		<td><button type='button' class='deleteBtn' data-id='".$result['id']."'>Delete</button></td>
	</tr>";
	}
	?>
    </tbody>
  </table>

  <script>
function closeModal() {
  $('#updateModal').modal('hide');
  $('#deleteModal').modal('hide');
}
</script>

<script>

  var carId = '';
	function getcarouselId(carouselID){
		carId = carouselID;
		$.ajax({
			type: "POST",
			url: "./get_carousel.php",
			data: { 
				carouselID: carId,
			},
			success: function(result) {	
				console.log(carId);
				var content = JSON.parse(result);
				$('#updateId').val(content.id);
				$('#updateImages').val(content.images);
				$('#updateTitle').val(content.Title);
				$('#updateCaption').val(content.caption);
				$('#updateModal').modal('show');
			},
			error: function(result) {
			}
		});
	}

  // Confirm update button click event
  $('#confirmUpdate').click(function() {
	var id = $('#updateId').val();
	var image = $('#updateImages').val();
	var title = $('#updateTitle').val();
	var caption = $('#updateCaption').val();
    $.ajax({
      type: 'POST',
      url: 'update_carousel.php',
      data: {
		id : id,
		image : image,
		title : title,
		caption : caption,
	  },
      success: function(response) {
		console.log(response);
        $('#updateModal').modal('hide');
        location.reload();
      }
    });
  });

  var deleteId = '';
  // Delete button click event
  $('.deleteBtn').click(function() {
    deleteId = $(this).attr("data-id");
    $('#deleteModal').modal('show');
  });

  // Confirm delete button click event
  $('#confirmDelete').click(function() {
    $.ajax({
      type: 'POST',
      url: 'delete_carousel.php',
      data: {
        id: deleteId
      },
      success: function(response) {
        $('#deleteModal').modal('hide');
        location.reload();
      }
    });
  });
</script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>let table = new DataTable('#carousel');</script>
</body>
</html>
<?php
}
?>
