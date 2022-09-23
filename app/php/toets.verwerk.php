<?php
session_start();

if(isset($_POST['toets_id']) && isset($_SESSION['student_id'])) {
    $aantalGoed = 0;
    $aantalFout = 0;
    $cijfer = 0;

    require 'config.php';

    $toets = $_POST['toets_id'];
    $student = $_SESSION['student_id'];
    $userAntwoorden = $_POST['antwoorden'];
    $datum = date("Y-m-d");

    $query = "SELECT antwoord FROM toets_antwoorden WHERE toets_id = {$toets} ORDER BY vraag_id ASC";
    $result = $conn->query($query);
    while($data = $result->fetch_array() ) {
        $goedeAntwoorden[] = $data[0];
    }

    $userAntwoorden = array_map('strtolower', $userAntwoorden);
    $goedeAntwoorden = array_map('strtolower', $goedeAntwoorden);
    $aantal = count($goedeAntwoorden);

    for($i=0; $i < $aantal; $i++) {
        if ($goedeAntwoorden[$i] == $userAntwoorden[$i]) {
            $aantalGoed++;
        }else {
            $aantalFout++;
        }
    }

    $cijfer = $aantalGoed / $aantal * 10;


    $query = "INSERT INTO toets_resultaten (toets_id, student_id, resultaat, datum) VALUES ($toets, $student, $cijfer, '{$datum}')";
    $result = $conn->query($query);
    if($result) {
        echo "<h2>Je hebt de toets voltooid!</h2>";
        echo "<p>Je hebt {$aantalGoed} vragen goed</p>";
        echo "<p>Je hebt {$aantalFout} vragen fout</p>";
        if($cijfer >= 5.5){
            echo "<p class='voldoende'>Jouw cijfer: {$cijfer}</p>";
        }else {
            echo "<p class='onvoldoende'>Jouw cijfer: {$cijfer}</p>";
        }
        echo "<a href='toetsen.php'>sluit</a>";
    }
}else {
    header("Location: ../../dashboard.php");
    exit;
}
