<?php 
session_start();
require 'config.php';

if (isset($_POST['toets'])) {
    $toets = $_POST['toets'];
    $type = $_POST['type'];

    if($type == "open") {
        $vraag = $conn->real_escape_string($_POST['vraag']);
        $antwoord = $conn->real_escape_string($_POST['antwoord']);

        $query = "INSERT INTO toets_vragen(toets_id, `type`, vraag) VALUES ({$toets}, 'open', '{$vraag}')";
        $result = $conn->query($query);
        if ($result) {
            $vraag_id = $conn->insert_id;
            $query = "INSERT INTO toets_antwoorden(toets_id, vraag_id, antwoord) VALUES ({$toets}, {$vraag_id}, '{$antwoord}')";
            $result = $conn->query($query);
            if ($result) {
                echo 'Vraag is toegevoegd!';
            }else {
                echo 'Er is iets fout gegaan!';
            }
        }else {
            echo 'Er is iets fout gegaan!';
        }


    }
    else if ($type == "meerkeuze") {
        $vraag = $conn->real_escape_string($_POST['vraag']);
        $antwoord = $conn->real_escape_string($_POST['antwoord']);

        $optieA = $conn->real_escape_string($_POST['optieA']);
        $optieB = $conn->real_escape_string($_POST['optieB']);
        $optieC = $conn->real_escape_string($_POST['optieC']);
        $optieD = $conn->real_escape_string($_POST['optieD']);

        $query = "INSERT INTO toets_vragen(toets_id, `type`, vraag) VALUES ({$toets}, 'meerkeuze', '{$vraag}')";
        $result = $conn->query($query);
        if ($result) {
            $vraag_id = $conn->insert_id;
            $query = "INSERT INTO vraag_keuzes(toets_id, vraag_id, keuze1, keuze2, keuze3, keuze4) VALUES ({$toets}, {$vraag_id}, '{$optieA}', '{$optieB}', '{$optieC}', '{$optieD}')"; 
            $result = $conn->query($query);
            if ($result) {
                $query = "INSERT INTO toets_antwoorden(toets_id, vraag_id, antwoord) VALUES ({$toets}, {$vraag_id}, '{$antwoord}')";
                $result = $conn->query($query);
                if ($result) {
                    echo 'Vraag is toegevoegd!';
                }else {
                    echo 'Er is iets fout gegaan!';
                }
            }else {
                echo 'Er is iets fout gegaan!';
            }
        }else {
            echo 'Er is iets fout gegaan!';
        }
    }
}
else {
    header("Location: ../../inlog.php");
    exit;
}