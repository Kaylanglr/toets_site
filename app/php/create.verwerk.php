<?php 
session_start();
require "config.php";

if (isset($_SESSION['docent_id'])) {


    $docent_id = $_SESSION['docent_id'];
    $toets_naam = $_POST['naam'];
    $toets_onderwerp = $_POST['onderwerp'];
    
    $query = "INSERT INTO toetsen(toets_naam, toets_onderwerp, docent_id) VALUES ('{$toets_naam}', '{$toets_onderwerp}', {$docent_id})";
    $result = $conn->query($query);
    
    if($result) {
        $toets = $conn->insert_id;
    
        header("Location: ../../docent/vraag.create.php?toets={$toets}");
        exit;
    }
    else {
        echo "Er is iets fout gegaan!";
    }
}
