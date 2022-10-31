<?php
date_default_timezone_set("Europe/Berlin");

$file = fopen('accesslog.txt', 'a') or die("Fehler");
fwrite($file, date("D, M, Y, H:i:s") . ' ' . $_SERVER['REMOTE_ADDR'] . ' ' . ' ' . $_SERVER['HTTP_USER_AGENT'] . "\n");
fclose($file);