<?php 
session_start(); 
?>
<?php 
include "constants/db_conn.php";

if($_POST){
    $type = $_POST['type'];
    switch($type){
        case 'student':
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = md5($_POST['pass']);

            $sql = "SELECT * FROM students";
            $stmt = $conn->prepare($sql); 
            $stmt->execute();
            $results = $stmt->get_result();

            $present = 0;
            while ($row = $results->fetch_assoc()) {
                if($email == $row['email']){
                    echo "email already registered";
                    $present = 1;
                }
            }
            if ($present == 0){
            $query = "INSERT INTO students (name , email , password)
            VALUES ('$name' , '$email' , '$pass')";
            if ($conn->query($query) === TRUE) {}
            echo("done");
        }
        break;
    }

}
