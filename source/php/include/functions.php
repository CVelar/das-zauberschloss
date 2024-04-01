<?php
    function debug($debug_config, $debug_level, $string){
        if($debug_level <= $debug_config){
            echo $string;
        }
    }

    function database(...$args){
        $string = $args[0];
        global $dbhost;
        global $dbname;
        global $dbuser;
        global $dbpw;
        global $debug_config;
        debug ($debug_config, "3", "dbhost: $dbhost<br>");
        debug ($debug_config, "3", "dbname: $dbname<br>");
        debug ($debug_config, "3", "dbuser: $dbuser<br>");
        debug ($debug_config, "3", "dbpw: $dbpw<br>");
        $dbconn = pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpw")
        or die('Could not connect: ' . pg_last_error());
        if (!$dbconn) {
            echo "Verbindung zur Datenbank fehlgeschlagen: " . pg_last_error();
        }
        debug ($debug_config, "3", "dbconn: $dbconn<br>");
        if (isset($args[1])){
            $params = $args[1];
            $string = pg_prepare($dbconn, "query", $string);
            $result = pg_execute($dbconn, "query", $params) or die('Error message: ' . pg_last_error());
        }else{
            $result = pg_query($dbconn, $string);
            }

        $row = pg_fetch_row($result);
        if($row != ""){
            if(count($row) == 1){
                $row = $row[0];
            }
        }

        pg_free_result($result);
        pg_close($dbconn);
        return $row;
    }

    function database_array(...$args){
        $string = $args[0];
        global $dbhost;
        global $dbname;
        global $dbuser;
        global $dbpw;
        $dbconn = pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpw")
        or die('Could not connect: ' . pg_last_error());
        if (isset($args[1])){
            $params = $args[1];
            $string = pg_prepare($dbconn, "query", $string);
            $result = pg_execute($dbconn, "query", $params) or die('Error message: ' . pg_last_error());
        }else{
            $result = pg_query($dbconn, $string);
        }
    
        $rows = array();
        while ($row = pg_fetch_assoc($result)) {
            $rows[] = $row;
        }
    
        pg_free_result($result);
        pg_close($dbconn);
        return $rows;
    }

    //Liest die Datenbank und gibt das Ergebnis als 2D-Array aus.
    function database_2d_array(...$args){
        $string = $args[0];
        global $dbhost;
        global $dbname;
        global $dbuser;
        global $dbpw;
        $dbconn = pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpw")
        or die('Could not connect: ' . pg_last_error());
        if (isset($args[1])){
            $params = $args[1];
            $string = pg_prepare($dbconn, "query", $string);
            $result = pg_execute($dbconn, "query", $params) or die('Error message: ' . pg_last_error());
        }else{
            $result = pg_query($dbconn, $string);
        }
        //jede Zeile als Array hinzufügen
        $rows = array();
        while ($row = pg_fetch_row($result)) {
            $rows[] = $row;
        }
        pg_free_result($result);
        pg_close($dbconn);
        return $rows;
    }
?>