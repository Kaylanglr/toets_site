<?php
require 'config.php';

if(isset($_POST['submit'])) {
   $email = $_POST['email'];
   $wachtwoord = $_POST['wachtwoord'];  

   if ($email == "" || $wachtwoord == "") {
        header("Location: ../../index.php?msg=empty");
        exit;
   }
   else {
    	$query = "SELECT * FROM users WHERE email = '{$email}'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $user = $result->fetch_array();
            if ($wachtwoord == $user[2]){
                $query = "SELECT * FROM studenten WHERE `user_id` = {$user[0]}";
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                    $student = $result->fetch_array();

                    session_start();
                    $_SESSION['user_id'] = $user[0];
                    $_SESSION['student_id'] = $student[0];
                    $_SESSION['naam'] = $student[2]." ".$student[3];
                    header("Location: ../../student/toetsen.php");
                    exit;
                }
                else {
                    $query = "SELECT * FROM docenten WHERE `user_id` = {$user[0]}";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        $docent = $result->fetch_array();

                        session_start();
                        $_SESSION['user_id'] = $user[0];
                        $_SESSION['docent_id'] = $docent[0];
                        $_SESSION['naam'] = $docent[1]." ".$docent[2];

                        header("Location: ../../docent/toetsen.php");
                        exit;
                    }
                }


            }
            else {
                header("Location: ../../index.php?msg=invalid");
                exit;
            }
        }
        else {
            header("Location: ../../index.php?msg=invalid");
            exit;
        }
   }

}