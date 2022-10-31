<?php
$famousMeals = [
    1 => ['name' => 'Currywurst mit Pommes',
        'winner' => [2001, 2003, 2007, 2010, 2020]],
    2 => ['name' => 'Hähnchencrossies mit Paprikareis',
        'winner' => [2002, 2004, 2008]],
    3 => ['name' => 'Spaghetti Bolognese',
        'winner' => [2011, 2012, 2017]],
    4 => ['name' => 'Jägerschnitzel mit Pommes',
        'winner' => 2019]
    ];
?>

<!DOCTYPE html>
<html lang="de">
<head> <title>m2_4d_array</title> <meta charset="UTF-8"> </head>
<body>
<ol>
    <?php
    foreach ($famousMeals as $key) {
         {
            echo "<li>";
            echo $key['name'];
            echo "<br>";
            echo $key['winner'];
            echo "</li>";
        }
    }
    ?>
</ol>
</body>
</html>
