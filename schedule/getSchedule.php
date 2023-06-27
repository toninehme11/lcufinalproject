<?php
include '../constants/db_conn.php';

$teacherId = isset($_GET['teacher_id']) ? intval($_GET['teacher_id']) : 0;
$day = isset($_GET['day']) ? $_GET['day'] : '';

$validDays = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");

if (!in_array($day, $validDays)) {
    http_response_code(400); // Bad request
    echo json_encode(array('error' => 'Invalid day parameter'));
    exit();
}

// Prepare statement - Note: this assumes $day is a valid column in your table
$query = 'SELECT ' . $day . ' FROM teachers_schedule WHERE userId = ?';
$stmt = $conn->prepare($query);

if(!$stmt) {
    http_response_code(500);
    echo json_encode(array('error' => 'Prepare failed: (' . $mysqli->errno . ') ' . $mysqli->error));
    exit();
}

// Bind parameter
if (!$stmt->bind_param('i', $teacherId)) {
    http_response_code(500);
    echo json_encode(array('error' => 'Binding parameters failed: (' . $stmt->errno . ') ' . $stmt->error));
    exit();
}

// Execute
if (!$stmt->execute()) {
    http_response_code(500);
    echo json_encode(array('error' => 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error));
    exit();
}

// Get the result
$result = $stmt->get_result();

// Fetch data
$data = $result->fetch_assoc();

// Close statement
$stmt->close();

// Close connection
$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);

?>
