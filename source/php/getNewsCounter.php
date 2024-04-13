<?php 
    // Dieses Skript gibt die Anzahl der News in der Datenbank als ganze Zehner zurück.
    // INCLUDE
    include "include/config.php";
    include "include/functions.php";

    // Datenbankabfrage
    $data = db_query("SELECT COUNT(*) AS num_entries FROM news");
        
    if (empty($data)) {
        echo "false";
    } else {
        $num_entries = ceil($data[0]->num_entries / 10);
        echo json_encode($num_entries);
    }
?> 