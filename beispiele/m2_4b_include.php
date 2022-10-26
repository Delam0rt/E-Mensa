<?php
/**
 * Praktikum DBWT. Autoren:
 * Vorname1, Nachname1, Matrikelnummer1
 * Vorname2, Nachname2, Matrikelnummer2
 */
include 'm2_4a_standardparameter.php';
function multiplication($a,$b){
    for($i=1;  $i < $b-1; $i++){
        $result = $result + addieren($a,$a);
    }
    return $result;
}

echo multiplication(5, 5);