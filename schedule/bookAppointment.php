<?php 
session_start(); 
?>
<?php
include '../constants/db_conn.php';

// Get the selected hour, day, and teacher ID from the POST data
$hour = isset($_POST['hour']) ? $_POST['hour'] : null;
$date = isset($_POST['date']) ? $_POST['date'] : null;
$teacherId = isset($_POST['teacher_id']) ? $_POST['teacher_id'] : null;

// Validate the input data
if (!$hour || !$teacherId) {
    http_response_code(400); // Bad request
    echo json_encode(array('error' => 'Invalid parameters'));
    exit();
}

// Insert the appointment into the appointments table

$stmt = $conn->prepare('INSERT INTO appointments (teacher_id, date, hour, student_id) VALUES (?, ?, ?, ?)');
$stmt->bind_param('issi', $teacherId, $date, $hour, $_SESSION['id']);

if (!$stmt->execute()) {
    http_response_code(500); // Internal server error
    echo json_encode(array('error' => 'Error creating appointment'));
    exit();
}



// Return a success response
echo json_encode(array('success' => 'Appointment booked successfully'));


    require '../vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];


        // Using prepared statements to prevent SQL injection attacks
        $stmt = $conn->prepare("SELECT email FROM teachers WHERE user_id = ?");
        $stmt->bind_param("i", $teacherId); // "i" means the variable is an integer
    
        $stmt->execute();
    
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Fetch result row as an associative array
            $row = $result->fetch_assoc();
            $teacherEmail = $row['email'];
        } else {
            echo "No results found";
        }

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = 'learniverseonline@gmail.com';
        $mail->Password = 'stsfzvjjtyctdvln';
        $mail->setFrom($email, $name);
        $mail->IsHTML(true);
        $mail->addReplyTo($email, $name);
        $mail->addAddress($teacherEmail);
        $mail->Subject = 'New Appointment';
        $mail->Body = "
        New appointment booked.
        <br>
        Name: $name
        <br>
        Email: $email
        <br>
        Phone: $phone
        <br/>
        <br/>
        Day: $date
        <br/>
        Time: $hour
        <br/>
        <br/>
        We have a session scheduled soon with one of our students and in order to streamline the process, we kindly ask you to establish contact with the student using the preferred communication methods - either via WhatsApp or email.
        <br/>
        <br/>
        It would be greatly appreciated if you could provide the student with a temporary Zoom link for the session. This would facilitate a seamless interaction and ensure that both you and the student can engage in the session without any technical disruptions.
        <br/>
        <br/>
        Please note that the session is of utmost importance for the student and providing a high-quality learning experience is our primary objective. We trust in your dedication and professionalism in creating a conducive learning environment.
        <br/>
        <br/>
        Feel free to reach out if you require further assistance or have any questions. Your understanding and cooperation are greatly appreciated.
        <br/>
        <br/>
        Thank you for your commitment to providing quality education. 
        <br/>
        <br/>
        Best Regards,
        <br/>
        <br/>
        Learniverse Team";

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
    }
?>
