<!-- Include your Header -->
<?php include './Header.php'; ?>

<?php
session_start();
if(!isset($_SESSION['super']) || $_SESSION['super'] != 'yes')
{
  // Redirect if not super user
  echo "<script>window.location.href = '../index.php'</script>";
}else{
  // Include database connection
  include '../constants/db_conn.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
  <link rel="stylesheet" type="text/css" href="./index.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
 
  <!-- The Update Modal -->
  <div class="modal" id="updateModal" style="z-index:999999">
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
            <input type="file" id="updateImages" name="updateImages"><br>
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
  <div class="modal" id="deleteModal" style="z-index:999999">
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

<!-- The Insert Modal -->
  <div class="modal" id="insertModal" style="z-index:999999">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Insert Carousel</h4>
          <button type="button" class="close" onclick="closeModal()">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <form id="insertForm">
            <label for="insertImages">Images:</label><br>
            <input type="file" id="insertImages" name="insertImages"><br>
            <label for="insertTitle">Title:</label><br>
            <input type="text" id="insertTitle" name="insertTitle"><br>
            <label for="insertCaption">Caption:</label><br>
            <input type="text" id="insertCaption" name="insertCaption"><br>
          </form>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="confirmInsert">Insert</button>
          <button type="button" class="btn btn-danger" onclick="closeModal()">Close</button>
        </div>
      </div>
    </div>
  </div>


  <!-- carousel Table -->
  <table id='carousel' class="table is-striped" style="width:100%">
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
  <button type='button' class='insertBtn' onclick="$('#insertModal').modal('show')" style="margin: 0 1rem; border-radius: 50px;">Insert</button>

  <script>
function closeModal() {
  $('#updateModal').modal('hide');
  $('#deleteModal').modal('hide');
  $('#insertModal').modal('hide');
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
    var image = document.getElementById("updateImages").files[0];
    var title = $('#updateTitle').val();
    var caption = $('#updateCaption').val();

    if (image == null){
				var extension = "";
				var file_name = "";
			}else{
				var extension_split = image.name.split('.');
        var extension = extension_split[1];
        var file_name = extension_split[0];
			}

    var formData = new FormData();
    formData.append("id", id);
    formData.append("image", image);
    formData.append("extension", extension);
    formData.append("file_name", file_name);
    formData.append("title", title);
    formData.append("caption", caption);

    $.ajax({
      type: 'POST',
      url: 'update_carousel.php',
      data: formData,
      processData: false,
      contentType: false,
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

  // Confirm insert button click event
$('#confirmInsert').click(function() {
  var image = document.getElementById("insertImages").files[0];
  var extension_split = image.name.split('.');
  var extension = extension_split[1];
  var file_name = extension_split[0];
  var title = $('#insertTitle').val();
  var caption = $('#insertCaption').val();
  var formData = new FormData();
	formData.append("image", image);
	formData.append("extension", extension);
	formData.append("file_name", file_name);
	formData.append("title", title);
	formData.append("caption", caption);

  $.ajax({
    type: 'POST',
    url: 'insert_carousel.php',
    data: formData,
    processData: false,
    contentType: false,
    success: function(response) {
      $('#insertModal').modal('hide');
      location.reload();
    }
  });
});

</script>
<script>
    $(document).ready(function() {
      $('#carousel').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
          "url": "./get_carousel_data.php",
          "type": "POST"
        },
        "columns": [{
            "data": "id"
          },
          {
            "data": "Title"
          },
          {
            "data": "caption"
          },
          {
            "data": "image",
            "render": function(data, type, full, meta) {
              return '<img src="../img/carousel/' + data + '" class="img-fluid" alt="Carousel Image">';
            }
          },
          {
            "data": "id",
            "render": function(data, type, full, meta) {
              return '<button type="button" class="btn btn-primary" onclick="getcarouselId(' + data + ')">Edit</button>';
            }
          },
          {
            "data": "id",
            "render": function(data, type, full, meta) {
              return '<button type="button" class="btn btn-danger" onclick="$(\'#deleteModal\').modal(\'show\');carId=' + data + '">Delete</button>';
            }
          }
        ]
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
