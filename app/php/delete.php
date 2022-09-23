<?php
session_start();
require 'config.php';
if(isset($_SESSION['docent_id']) && isset($_GET['toets'])) {
    $toets = $_GET['toets'];
    $query = "DELETE FROM `toetsen` WHERE toets_id = {$toets}";
    $result = $conn->query($query);
    if($result) {
        header("Location: ../../docent/toetsen.php");
        exit;
    }
    else {
        header("Location: ../../docent/toetsen.php");
        exit; 
    }
}
else {
    header("Location: ../../docent/toetsen.php");
    exit; 
}