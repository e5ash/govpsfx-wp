<?php

class FileLogger 
{       
    public static function log($type, $error, $function)
    {
        $time = date("d-m-Y G:i:s");
        $error = "$time error $type, $error in function \"$function\"\r\n";
        $fp = fopen("log.txt", "a+");   
        fwrite($fp, $error);
        fclose($fp);
    }
}
