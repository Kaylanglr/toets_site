<?php
session_start();


if(isset($_SESSION['user_id'])) {
    session_unset();
    session_destroy();
    
    header("location: ../../index.php");
    exit();
}
else {
    header("Location: ../../index.php");
    exit;
}