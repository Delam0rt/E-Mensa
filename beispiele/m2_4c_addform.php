<?php
/**
 * Praktikum DBWT. Autoren:
 * Vorname1, Nachname1, Matrikelnummer1
 * Vorname2, Nachname2, Matrikelnummer2
 */


include 'm2_4a_standardparameter.php';
if(!empty($_GET["parameter_a"]) &&(!empty($_GET["parameter_b"])))
{
    $parameter_a = (int)$_GET["parameter_a"];
    $parameter_b = (int)$_GET["parameter_b"];
    if(isset($_GET['add'])) {
        $result = addieren($parameter_a, $parameter_b);
    }
    elseif(isset($_GET['mult'])){
        $result = $parameter_a * $parameter_b;
    }
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title>Addform</title>
</head>
<body>
    <form action="m2_4c_addform.php" method="get">
        <label for="parameter_a">a</label> <input name="parameter_a" id="parameter_a" type="text"> <br>
        <label for="parameter_b">b</label> <input name="parameter_b" id="parameter_b" type="text"> <br>
        <input type="submit" name="add" value="Addieren"> <input type="submit" name="mult" value="Multiplizieren">
    </form>
<label>Ergebnis:<?php echo $result ?></label>
</body>
</html>
