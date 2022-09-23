<?php

require 'config.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM toets_vragen WHERE toets_id = {$id}";
    $result = $conn->query($query);
    if ($result->num_rows > 0 ) {
        while($data = $result->fetch_array()){
            if ($data[2] == 'meerkeuze') {
                $query2 = "SELECT * FROM vraag_keuzes WHERE toets_id = {$id} AND vraag_id = {$data[0]}";
                $result2 = $conn->query($query2);
                $keuzes = $result2->fetch_array();
                
                $toets[] = array(
                    "type" => $data[2],
                    "vraag" => $data[3],
                    "opties" => [
                        "optieA" => $keuzes[3],
                        "optieB" => $keuzes[4],
                        "optieC" => $keuzes[5],
                        "optieD" => $keuzes[6]
                    ]
                );
            }
            else if ($data[2] == 'open') {
                $toets[] = array(
                    "type" => $data[2],
                    "vraag" => $data[3]
                );
            }
    
        }
        $jsonarray = json_encode($toets);
        echo $jsonarray;
    }
}
