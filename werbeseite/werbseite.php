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
            <img src="img/logo.png" alt="There was supposed to be a logo">
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
            <img id="soon" src="img/coming_soon.gif" alt="This is an animated gif image, but it does not move" width="900"
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
                </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($gerichte as $key): ?>
                <tr>
                    <td> <?php echo htmlspecialchars($key['g_name']); ?></td>
                    <td><?php echo htmlspecialchars($key['i_preis']); ?></td>
                    <td><?php echo htmlspecialchars($key['e_preis']); ?></td>
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