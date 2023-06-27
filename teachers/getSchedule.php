<?php
session_start();
// Database configuration
$dbhost = 'localhost'; // hostname
$dbuser = 'root'; // database username
$dbpass = ''; // database password
$dbname = 'learniverse_project'; // database name

// Create mysqli object
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check for connection error
if($mysqli->connect_error){
  die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
}

// Get teacherId from request
$teacherId = $_SESSION['id'];

// Prepare statement
$stmt = $mysqli->prepare('SELECT * FROM teachers_schedule WHERE userId = ?');

// Bind parameter
$stmt->bind_param('i', $teacherId);

// Execute
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetch data
$data = $result->fetch_assoc();

// Close statement
$stmt->close();

// Close connection
$mysqli->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
