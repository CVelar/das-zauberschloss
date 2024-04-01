<?php 
    // INCLUDE
    include "include/config.php";
    include "include/functions.php";

    //prüfen, ob die erforderlichene Parameter angegeben sind
    if(empty($argv)){
        $new = $_GET['new'];                                                // Sollen nur aktuelle Nachrichten (1) angezeigt werden oder alle (0)
        $quantity = $_GET['quantity'];                                      // Anzahl der Nachrichten, die angezeigt werden sollen (0 = alle), (1 = 1-10), (2 = 11-20), etc.
        $timestamp = $_GET['timestamp'];                                    // Zeitpunkt der Nachrichten, bis wann Nachrichten angezeigt werden sollen
        debug ($debug_config, "3", "new: $new <br>");
        debug ($debug_config, "3", "quantity: $quantity <br>");
        debug ($debug_config, "3", "timestamp: $timestamp <br>");
    }else{
        parse_str($argv[0], $arguments);
        $new = $arguments["new"];
        parse_str($argv[1], $arguments);
        $quantity = $arguments["quantity"];
        parse_str($argv[2], $arguments);
        $timestamp = $arguments["timestamp"];
        debug ($debug_config, "3", "new: $new");
        debug ($debug_config, "3", "quantity: $quantity");
        debug ($debug_config, "3", "timestamp: $timestamp");
    }

    // Variablen vorbereiten
    // Erstelle die Variable "time" und setze den aktuallen Zeitpunkt in folgendem Format: YYYY-MM-DD HH:MM:SS
    //$time = date('Y-m-d H:i:s');
    if ($quantity == 0) {
        $news_min = 1;
    } else {
        $news_start = $quantity * 10 - 10;
    }
    debug ($debug_config, "3", "time: $timestamp <br>");
    debug ($debug_config, "3", "news_start: $news_start <br>");

    // Datenbankabfrage
    if ($new == 1) {
        $data = database_2d_array("SELECT titel, inhalt, gruppe, link, bild, erstellt_von, erstellt, link_name FROM news WHERE abgelaufen_ab > '$timestamp' ORDER BY erstellt DESC;");
    } elseif ($quantity == 0) {
        $data = database_2d_array("SELECT titel, inhalt, gruppe, link, bild, erstellt_von, erstellt, link_name FROM news ORDER BY erstellt DESC;");
    } else {
        $data = database_2d_array("SELECT titel, inhalt, gruppe, link, bild, erstellt_von, erstellt, link_name FROM news ORDER BY erstellt DESC OFFSET $news_start LIMIT 10;");
    } 
    if (empty($data)) {
        echo "false";
    } else {
        echo json_encode($data);
    }
?> 