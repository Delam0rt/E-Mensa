<?php
include 'gerichte.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ihre E-Mensa</title>
    <link href="index.css" rel="stylesheet">
</head>

<body>

    <header>
        <nav>
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

        <section id="ankundigung">
            <h1>Bald gibt es Essen auch Online ;)</h1>
            <img id="soon" src="coming_soon.gif" alt="This is an animated gif image, but it does not move" width="800"
                 height="600">
        </section>

        <section id="speisen">
            <h1>Köstlichkeiten, die Sie erwarten</h1>
            <table id="speisekarte">
                <thead>
                <tr>
                    <th>Gericht</th>
                    <th>Preis intern</th>
                    <th>Preis extern</th>
                    <th>Bild</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($gerichte as $key): ?>
                <tr>
                    <td> <?php echo ($key['g_name']); ?></td>
                    <td><?php echo ($key['i_preis']); ?></td>
                    <td><?php echo ($key['e_preis']); ?></td>
                    <td><?php echo ($key['bild']); ?></td>
                </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section id="zahlen">
            <h1>E-Mensa in Zahlen</h1>
            <label> x Besuche</label>
            <label> y Anmeldungen zum Newsletter</label>
            <label> z Speisen</label>
        </section>

        <section id="kontakt">
            <h1>Interesse geweckt? Wir informieren Sie!</h1>
            <form method="post" id="newsletter">

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
                <button id="btn_anmd" type="submit" form="newsletter" value="test" disabled="disabled">Zum Newsletter anmelden</button>
            </form>
        </section>
        <p id="feedback_newsletter">
            <?php
            if(isset($_POST) && isset($_POST["name"]))
            {
                $blacklist = ["rcpt.at", "damnthespam.at", "wegwerfmail.de", "trashmail.de", "trahsmail.com"];
                $back_array = $_POST;

                $email_extension_check = explode("@",$_POST["email"]);
                $email_extension_check = $email_extension_check[1];


                $email_check = true;
                $name_check = true;
                $dtn_check = true;

                foreach($blacklist as $value)
                {
                    if($value === $email_extension_check) {
                        echo "ungültiger Email-Provider";
                        $email_check = false;

                    }
                }

                $email = $_POST["email"];
                $name = $_POST["name"];
                $dtnschutz = $_POST["dtschutz"];

                if(trim($_POST["name"], " \n\r\t\v\x00") === "")
                {

                    echo "Der Name: $name darf nicht leer sein.";
                    $name_check = false;
                }
                if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    echo "Die Email: $email ist nicht valide.";
                    $email_check = false;
                }
                if(!($_POST["dtschutz"] === "on"))
                {
                    echo "Den Datenschutzbestimmungen wurde nicht zugestimmt.";
                    $dtn_check  = false;
                }


                $file = fopen("./newsletteranmeldung.txt", "a");

                if(!$file){
                    die("Öffnen der Datei 'newsletteranmeldung.txt' war nicht erfolgreich");
                }
                if($email_check && $name_check && $dtn_check)
                {
                    foreach($back_array as $key => $value)
                    {
                        $line = "$key;$value\n";
                        fwrite($file,$line);

                    }
                    echo "Speicherung der Daten erfolgreich.";
                }

                fclose($file);




            }
            ?>

        </p>

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

        <ul class="horizontal-list">
            <li>(c) E-Mensa GmbH</li>
            <li>Ivan Volkov</li>
            <li>Max Gerdes</li>
            <li>Impressum</li>
        </ul>

    </footer>

</body>

</html>