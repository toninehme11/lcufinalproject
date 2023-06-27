<?php

session_start();
 $_SESSION['alert'] = 'This email is already in use!';

if (isset($_POST['create_tut'])) {
checkemail();	
}else{
header("location:../");		
}


function checkemail() {
	
    include '../constants/db_conn.php';
        
    $email = $_POST['email'];

    $sql = "SELECT * FROM teachers WHERE email ='".$email."'";
    $stmt = $conn->prepare($sql); 
    $stmt->execute();
    $results = $stmt->get_result();
    $result = $results->fetch_all();
    $records = count($result);
	if ($records > 0) {
 
        echo "<script>alert('This email is already in use!'); window.location.href='../create_tutor.php';</script>";
   
	}else{
	register();
   
	}
					
}

function register() {
  
$topic_name=trim($_POST['topic']);
$teaching_xp= $_POST['teaching_xp'];
$years_teaching= $_POST['years_teaching'];
$weekly_teaching_hours= $_POST['weekly_teaching_hours'];

$cv= file_get_contents($_FILES['cv']['tmp_name']);
$legal_id =file_get_contents($_FILES['legal_id']['tmp_name']);


$fname= $_POST['fname'];
$lname= $_POST['lname'];
$gender= $_POST['gender'];
$birthdate= date($_POST['birthdate']);
$email = $_POST['email'];
$passcode= md5($_POST['passcode']);
$approval = false;


try {
	require '../constants/db_conn.php';
    $conn = new PDO("mysql:host=$sname;dbname=$db_name", $uname, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("INSERT INTO teachers (teaching_xp, teaching_years, hours_per_week, cv, legal_id, fname, lname, gender, birthdate, email, passcode, approval, topic_name) 
	VALUES (:teaching_xp, :teaching_years, :hours_per_week, :cv, :legal_id, :fname, :lname, :gender, :birthdate, :email, :pass, :approval, :topic_name)");
    $stmt->bindParam(':teaching_xp', $teaching_xp);
    $stmt->bindParam(':teaching_years', $years_teaching);
    $stmt->bindParam(':hours_per_week', $weekly_teaching_hours);
    $stmt->bindParam(':cv', $cv,PDO::PARAM_LOB);
    $stmt->bindParam(':legal_id', $legal_id,PDO::PARAM_LOB);
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':birthdate', $birthdate);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pass', $passcode);
    $stmt->bindParam(':approval', $approval);
    $stmt->bindParam(':topic_name', $topic_name);

    $stmt->execute();
	header("location:../login.php");	
    			  
	}catch(PDOException $e)
    {
    header("location:../index.php");
    }	
	
    }
?>