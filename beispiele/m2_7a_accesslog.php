<?php
$file = fopen('.accesslog.txt', 'a');
if(!$file){
    die('Fehler');
}

date_default_timezone_set("Europe/Berlin");
$datum = date("d.m.Y");
$uhrzeit = date("H:i");
echo $datum, " - ", $uhrzeit, " Uhr";

echo $_SERVER['HTTP_USER_AGENT'];
echo $_SERVER['SERVER_ADDR'];


fclose($file);