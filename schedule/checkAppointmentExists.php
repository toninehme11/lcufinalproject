<?php
// checkAppointmentExists.php
include '../constants/db_conn.php';

$date = isset($_GET['date']) ? $_GET['date'] : null;
$hour = isset($_GET['hour']) ? $_GET['hour'] : null;
$teacherId = isset($_GET['teacherId']) ? $_GET['teacherId'] : null;

if (!$date || !$hour || !$teacherId) {
    http_response_code(400); // Bad request
    echo json_encode(array('error' => 'Invalid parameters'));
    exit();
}

$stmt = $conn->prepare('SELECT * FROM appointments WHERE teacher_id = ? AND date = ? AND hour = ?');
$stmt->bind_param('iss', $teacherId, $date, $hour);
$stmt->execute();
$result = $stmt->get_result();
$appointment = $result->fetch_assoc();
$exists = $appointment !== null;

echo json_encode(array('exists' => $exists));
?>
