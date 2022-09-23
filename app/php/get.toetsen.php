<?php 

require "config.php";

$query = "SELECT * FROM toetsen";
$result = $conn->query($query);
if($result->num_rows > 0) {
    echo "<table>";
    echo "<thead>";
        echo "<th>Naam</th>";
        echo "<th>Onderwerp</th>";
        echo "<th>Vragen</th>";
        echo "<th></th>";
    echo "</thead>";
    while($toets = $result->fetch_array()) {
        $query2 = "SELECT COUNT(*) as aantal FROM `toets_vragen` WHERE toets_id = {$toets[0]}";
        $result2 = $conn->query($query2);
        $aantalVragen = $result2->fetch_assoc();
        if ($aantalVragen['aantal'] > 0) {
            echo "<tr>";
                echo "<td>{$toets[1]}</td>";
                echo "<td>{$toets[2]}</td>";
                echo "<td>{$aantalVragen['aantal']}</td>";
                echo "<td><a href='toets.maak.php?toets={$toets[0]}'>Maak toets</a></td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}else {
    echo "<h2>Er zijn nog geen toetsen beschikbaar</h2>";
}
