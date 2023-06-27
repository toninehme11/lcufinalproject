<?php
session_start();
$id = $_GET["id"];
include "../constants/db_conn.php";
// Execute the SQL query to fetch the BLOB data
$sql = "SELECT * FROM teachers WHERE user_id = $id";
$stmt = $conn->prepare($sql); 
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$pdf = $row['cv'];

header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="myfile.pdf"');
echo $pdf;
exit;
?>