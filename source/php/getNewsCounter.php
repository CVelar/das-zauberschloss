<?php 
    // Dieses Skript gibt die Anzahl der News in der Datenbank als ganze Zehner zurück.
    // INCLUDE
    include "include/config.php";
    include "include/functions.php";

    // Datenbankabfrage
    $data = db_query("SELECT COUNT(*) AS num_entries FROM news");
    // $data['num_entries'] auf den nächsten 10-er aufrunden
    $data = json_decode('[{"num_entries":"25"}]', true);
    $data = ceil($data[0]['num_entries'] / 10);
        
    if (empty($data)) {
        echo "false";
    } else {
        echo json_encode($data);
    }
?> 