<?php
session_start();
if(!isset($_SESSION['teacher']) || $_SESSION['teacher'] != 'yes')
{
  // Redirect if not teacher user
  echo "<script>window.location.href = '../index.php'</script>";
}else{
        include "../Header.php";
        include "../constants/db_conn.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST['schedule'])) {
        $userId = $_SESSION['id']; // assuming you have the user's ID stored in a session

        // Initialize an array to hold the selected times for each day
        $schedule = [
            'Monday' => [],
            'Tuesday' => [],
            'Wednesday' => [],
            'Thursday' => [],
            'Friday' => [],
            'Saturday' => [],
            'Sunday' => []
        ];

        // Separate the day and hour for each selected checkbox and add to the schedule
        foreach ($_POST['schedule'] as $selected) {
            list($day, $hour) = explode(' ', $selected);
            $schedule[$day][] = $hour;
        }

        // Prepare the SQL statement
        $stmt = $conn->prepare(
            "INSERT INTO teachers_schedule (userId, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, Sunday) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE 
            Monday = VALUES(Monday), 
            Tuesday = VALUES(Tuesday), 
            Wednesday = VALUES(Wednesday), 
            Thursday = VALUES(Thursday), 
            Friday = VALUES(Friday), 
            Saturday = VALUES(Saturday), 
            Sunday = VALUES(Sunday)"
        );


        // Convert the selected times for each day to a comma-separated string
        $schedule = array_map(function($day) {
            return implode(',', $day);
        }, $schedule);

        // Bind the parameters and execute the statement
        $stmt->bind_param(
            "isssssss", 
            $userId, 
            $schedule['Monday'], 
            $schedule['Tuesday'], 
            $schedule['Wednesday'], 
            $schedule['Thursday'], 
            $schedule['Friday'], 
            $schedule['Saturday'], 
            $schedule['Sunday']
        );

        $stmt->execute();
        $stmt->close();
    }
}

$conn->close();
}       
?>
<script>window.location.href = './'</script>