<?php 
    // Dieses Skript gibt die Anzahl der News in der Datenbank als ganze Zehner zurück.
    // INCLUDE
    include "include/config.php";
    include "include/functions.php";

    // Datenbankabfrage
    $data = database("SELECT COUNT(*) AS num_entries FROM news;");
    // $data auf den nächsten 10-er aufrunden
    $data = floor($data / 10) + 1;
    
    if (empty($data)) {
        echo "false";
    } else {
        echo json_encode($data);
    }
?> 