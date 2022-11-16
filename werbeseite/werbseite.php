<?php

/**
 *Praktikum DBWT. Autoren:
 *Ivan, Volkov, 3519680
 *Max, Gerdes, 3516014
 */

// Datei mit den gerichten in einem Array gespeichert
include 'gerichte.php';

// MySql verbindung herstellen
$link = mysqli_connect(
        "127.0.0.1",
             "root",
             "root",
    "emensawerbeseite",
            "3306"
);

// überprüfung auf erfolgreiche Verbindung
// link == false wenn Verbindung fehlgeschlagen.
if(!$link)
{
    echo "Vebindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

$sql_query_5_1 = "SELECT name, preis_intern, preis_extern FROM gericht GROUP BY name ASC LIMIT 5;";
$result_5_1 = mysqli_query($link, $sql_query_5_1);

$sql_query_5_2 = "SELECT name, preis_intern, preis_extern, gha.code FROM gericht
JOIN gericht_hat_allergen gha on gericht.id = gha.gericht_id
GROUP BY RAND() ASC LIMIT 5;";

$sql_query_5_2_2 = "SELECT DISTINCT gericht.name,gericht.preis_intern, gericht.preis_extern, GROUP_CONCAT(gericht_hat_allergen.code) as code FROM gericht
JOIN gericht_hat_allergen on gericht.id = gericht_hat_allergen.gericht_id
GROUP BY id
ORDER BY RAND() LIMIT 5;";
$result_5_2 = mysqli_query($link, $sql_query_5_2_2);

$sql_query_allergen = "SELECT unique(code),name as allergen FROM allergen;";
$result_allergen = mysqli_query($link, $sql_query_allergen);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ihre E-Mensa</title>

    <!-- Einbindung des externen Stylesheets-->
    <link href="index.css" rel="stylesheet">
</head>

<body>

    <header>
        <nav>
            <!-- Darstellung der Links oben auf der Webseite.
                  Dienen der Navigation auf die einzelnen Elemente.-->
            <img src="logo.png" alt="There was supposed to be a logo">
            <ul id="navigation">
                <a href="#ankundigung"> <li> Ankündigung </li></a>
                <a href="#speisen"> <li> Speisen </li></a>
                <a href="#zahlen"> <li>Zahlen </li></a>
                <a href="#kontakt"> <li>Kontakt</li></a>
                <a href="#wichtig"> <li>Wichtig für Uns </li></a>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Platzhalter für kommende Elemente-->
        <section id="ankundigung">
            <h1>Bald gibt es Essen auch Online ;)</h1>
            <img id="soon" src="coming_soon.gif" alt="This is an animated gif image, but it does not move" width="800"
                 height="600">
        </section>

        <!-- Tabellen Darstellung der Gerichte aus der Datenbank
        -->
        <section id="speisen">
            <h1>Köstlichkeiten, die Sie erwarten</h1>
            <table id="speisekarte">
                <thead>
                <tr>
                    <th>Gericht</th>
                    <th>Preis intern</th>
                    <th>Preis extern</th>
                    <th>Allergen</th>
                    <th>Bild</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    while($row = mysqli_fetch_assoc($result_5_2))
                    {
                     echo      " <tr>".
                            "<td>".$row['name']."</td>".
                           " <td>".$row['preis_intern']."</td>".
                           " <td>".$row['preis_extern']."</td>".
                            "<td>".$row['code']."</td>".
                            //"<td>".$key['bild']</td>
                           "</tr>";

                    }

                    mysqli_free_result($result_5_2);
                    ?>

                </tbody>
            </table>

            <!-- Darstellung der in allen Gerichten enthalten Allergene.
             Daten stammen aus MySql Datenbank-->
            <ul id="allergen">
                <p>verw. Allergene:</p>
                <?php
                while($row = mysqli_fetch_assoc($result_allergen)){

                    echo "<li>".$row['code']."</li>".""."<li>".$row['allergen']."</li>";
                }
                ?>
            </ul>
        </section>

        <!-- Dynamische Anzeige der Anzahl der Besucherinnen, Gerichte
            und Newsletter blabla-->
        <section id="zahlen">
            <h1>E-Mensa in Zahlen</h1>

            <label class="zahlen"> <?php
                $sql="SELECT name FROM gericht";
                if ($result=mysqli_query($link,$sql))
                {
                    // Return the number of rows in result set
                    $rowcount=mysqli_num_rows($result);
                    printf($rowcount);
                    // Free result set
                    mysqli_free_result($result);
                }?> </label> <label> Gerichte </label>

            <label class="zahlen">  <?php
                $sql="SELECT email FROM anmeldungen";
                if ($result=mysqli_query($link,$sql))
                {
                    // Return the number of rows in result set
                    $rowcount=mysqli_num_rows($result);
                    printf($rowcount);
                    // Free result set
                    mysqli_free_result($result);
                }?> </label> <label> Anmeldungen </label>

            <label class="zahlen"> <?php
                date_default_timezone_set("Europe/Berlin");
                $date = date("Y-m-d H:i:s");
                $remote_adr = $_SERVER['REMOTE_ADDR'];
                $http_user_agent = $_SERVER['HTTP_USER_AGENT'];
                $result_var = $remote_adr." ".$http_user_agent;
                $sql_query_9_3 = mysqli_query($link,"INSERT INTO anzahl_besucher VALUES(b_id,'$result_var', '$date')");

                $count_visitor_result = mysqli_query($link,"SELECT b_id FROM anzahl_besucher");
                $count_besuche = mysqli_num_rows($count_visitor_result);
                echo $count_besuche;
                ?> </label> <label> Besucher </label>

        </section>

        <section id="kontakt">
            <h1>Interesse geweckt? Wir informieren Sie!</h1>
            <form method="post" id="newsletter" name="newsletter">

                <!-- Alle Eingaben sind Pflicht und werden Serverseitig
                    nochmals auf gültigkeit gecheckt -->
                <label class="oberschrifft" for="name">Ihr Name:</label>
                <input class="oberschrifftbox" type="text" id="name" name="name" required>

                <label class="oberschrifft" for="email">Ihre E-Mail:</label>
                <input class="oberschrifftbox" type="text" id="email" name="email" required>

                <label class="oberschrifft" for="sprache">Newsletter bitte in:</label>
                <select class="oberschrifftbox" name="sprache" id="sprache">
                    <option value="de">Deutsch</option>
                    <option value="eng">Englisch</option>
                </select>
                <br><br><br>
                <input type="checkbox" id="dtschutz" name="dtschutz" required>
                <label for="dtschutz">Den Datenschutzbestimmungen stimme ich zu</label>
                <button id="btn_anmd" type="submit" form="newsletter" value="test" >Zum Newsletter anmelden</button>
            </form>
        </section>

        <!-- Eingabe der Daten für die Anmeldung der Newsletter
            -> Filterung der Emails die auf der Blacklist stehen.
            -> Überprüfung ob jedes Feld eine gültige Eingabe enthält.
            -> Speicherung der Daten nach erfolgreicher Überprüfung in
                "newsletter.txt". -->
        <p id="feedback_newsletter">
            <?php
            if(isset($_POST) && isset($_POST["name"])) {
                $blacklist = ["rcpt.at", "damnthespam.at", "wegwerfmail.de", "trashmail.de", "trahsmail.com"];
                $back_array = $_POST;

                $email_extension_check = explode("@", $_POST["email"]);
                $email_extension_check = $email_extension_check[1];

                $email_check = true;
                $name_check = true;
                $dtn_check = true;

                foreach ($blacklist as $value) {
                    if ($value === $email_extension_check) {
                        echo "ungültiger Email-Provider";
                        $email_check = false;
                    }
                }

                $email = $_POST["email"];
                $name = $_POST["name"];
                $dtnschutz = $_POST["dtschutz"];

                if (trim($_POST["name"], " \n\r\t\v\x00") === "") {

                    echo "Der Name: $name darf nicht leer sein.";
                    $name_check = false;
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "Die Email: $email ist nicht valide.";
                    $email_check = false;
                }
                if (!($_POST["dtschutz"] === "on")) {
                    echo "Den Datenschutzbestimmungen wurde nicht zugestimmt.";
                    $dtn_check = false;
                }

            if ($email_check && $name_check && $dtn_check) {
                $insertquery = "INSERT INTO anmeldungen VALUES ('$name', '$email')";
                mysqli_query($link, $insertquery);
            }

            }
            ?>

        </p>
        <!-- Das ist uns Wichtig section-->
        <section id="wichtig">
            <h1>Das ist uns wichtig</h1>
            <ul>
                <li>Regionale frische Zutaten</li>
                <li>Ausgewogene Mahlzeiten</li>
                <li>Hohes Serviceniveau</li>
            </ul>
        </section>

    </main>

    <footer>
        <!-- Author,Impressum, Firmenname -->
        <ul class="horizontal-list">
            <li>(c) E-Mensa GmbH</li>
            <li>Ivan Volkov</li>
            <li>Max Gerdes</li>
            <li>Impressum</li>
        </ul>

    </footer>

</body>

</html>