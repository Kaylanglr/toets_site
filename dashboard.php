<?php

session_start();

if(isset($_SESSION['docent_id'])) {
    header('Location: docent/toetsen.php');
    exit;
}

else if (isset($_SESSION['student_id'])) {
    header('Location: student/toetsen.php');
    exit;
}

else {
    header('index.php');
    exit;
}