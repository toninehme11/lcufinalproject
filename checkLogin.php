<?php
session_start(); 
include "constants/db_conn.php";
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $pass = validate(md5($_POST['pass']));
        $sql = "SELECT * FROM students WHERE email='".$email."'";
        $stmt = $conn->prepare($sql); 
        $stmt->execute();
        $results = $stmt->get_result();
        if($row = $results->fetch_assoc()) {
            if ($row['password'] === $pass ) {
                echo "Logged in!";
                $_SESSION['fname'] = $row['name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['loggedIn'] = 'YES!';
                $_SESSION['super'] = "no";
                $_SESSION['teacher'] = "no";
                
            }else{
                echo "wrong pass";
            }
        }else{
            $sql1 = "SELECT * FROM super_admin WHERE email='".$email."'";
            $stmt1 = $conn->prepare($sql1); 
            $stmt1->execute();
            $results1 = $stmt1->get_result();
            if($row1 = $results1->fetch_assoc()) {
                if ($row1['password'] === $pass ) {
                    echo "Logged in!";
                    $_SESSION['fname'] = $row1['name'];
                    $_SESSION['email'] = $row1['email'];
                    $_SESSION['id'] = $row1['id'];
                    $_SESSION['loggedIn'] = 'YES!';
                    $_SESSION['super'] = "yes";
                    $_SESSION['teacher'] = "yes";  
                }else{
                    echo "wrong pass";
                }
            }else{
                $sql2 = "SELECT * FROM teachers WHERE email='".$email."'";
                $stmt2 = $conn->prepare($sql2); 
                $stmt2->execute();
                $results2 = $stmt2->get_result();
                if($row2 = $results2->fetch_assoc()) {
                    if ($row2['passcode'] === $pass ) {
                        echo "Logged in!";
                        $_SESSION['fname'] = $row2['fname'];
                        $_SESSION['email'] = $row2['email'];
                        $_SESSION['id'] = $row2['user_id'];
                        $_SESSION['loggedIn'] = 'YES!';
                        $_SESSION['super'] = "no";
                        $_SESSION['teacher'] = "yes";
                        
                    }else{
                        echo "wrong pass";
                    }
                }else{
                    echo "Account does not exist";
                }
            }
        }
?>