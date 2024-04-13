<?php
    function debug($debug_config, $debug_level, $string){
        if($debug_level <= $debug_config){
            echo $string;
        }
    }

    function db_query($query, $arguments = null) {
        global $DB, $DB_rows_affected;                                                                                      
        if (!is_null($arguments)) {                                                                                     
            asort($arguments);                                                                                              
            foreach ($arguments as $key => $value)                                                                          
                $query = str_replace($key, is_string($value) ? '\'' . @pg_escape_string($DB, $value) . '\'' : (is_array($value) ? (is_string($value[0]) ? ('\'' . join('\',\'', array_map(function($x) { global $DB; return @pg_escape_string($DB, $x); }, $value)) . '\'') : @pg_escape_string($DB, join(',', $value))) : @pg_escape_string($DB, $value)), $query);
        }                                                                                                                   
        $ret = [];                                                                                                          
        $result = @pg_query($DB, $query);                                                                                   
        if (!$result) {                                                                                                     
            echo 'DB: Fehler - ' . @pg_last_error($DB) . PHP_EOL;                                                       
            exit(10);
        } else {                                                                                                            
            $DB_rows_affected = @pg_affected_rows($result);                                                                 
            while ($obj = @pg_fetch_object($result)) {                                                                      
              $ret[] = $obj;
            }
        }
        return $ret;
    }
?>