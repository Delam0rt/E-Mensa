<?php
const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';
const GET_PARAM_SHOW_DESCRIPTION = 1;
const GET_PARAM_LANG = "de";

$txtsen = [
    'Gericht' => 'Meal',
    'Allergens' => 'Allergic Ingridients',
    'Bewertungen' => 'Ratings',
    'Insgesamt' => 'Average',
    'Filter' => 'Filter',
    'Suchen' => 'Search',
    'Text' => 'Text',
    'Sterne' => 'Stars',
    'Author' => 'Author',
    'Preis' => 'Price'
    ];
$txtsde = [
    'Gericht' => 'Gericht',
    'Allergens' => 'Allergens',
    'Bewertungen' => 'Bewertungen',
    'Insgesamt' => 'Insgesamt',
    'Filter' => 'Filter',
    'Suchen' => 'Suchen',
    'Text' => 'Text',
    'Sterne' => 'Sterne',
    'Author' => 'Author',
    'Preis' => 'Preis'
];


/**
 * List of all allergens.
 */
$allergens = [
    11 => 'Gluten',
    12 => 'Krebstiere',
    13 => 'Eier',
    14 => 'Fisch',
    17 => 'Milch'
];

$meal = [
    'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'price_intern' => 2.90,
    'price_extern' => 3.90,
    'allergens' => [11, 13],
    'amount' => 42             // Number of available meals
];

$ratings = [
    [   'text' => 'Die Kartoffel ist einfach klasse. Nur die Fischstäbchen schmecken nach Käse. ',
        'author' => 'Ute U.',
        'stars' => 2 ],
    [   'text' => 'Sehr gut. Immer wieder gerne',
        'author' => 'Gustav G.',
        'stars' => 4 ],
    [   'text' => 'Der Klassiker für den Wochenstart. Frisch wie immer',
        'author' => 'Renate R.',
        'stars' => 4 ],
    [   'text' => 'Kartoffel ist gut. Das Grüne ist mir suspekt.',
        'author' => 'Marta M.',
        'stars' => 3 ]
];

$showRatings = [];
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
    foreach ($ratings as $rating) {
        if (stripos($rating['text'], $searchTerm) !== false) {
            $showRatings[] = $rating;
        }
    }
} else if (!empty($_GET[GET_PARAM_MIN_STARS])) {
    $minStars = $_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
} else {
    $showRatings = $ratings;
}

function calcMeanStars(array $ratings) : float {
    $sum = 0;
    foreach ($ratings as $rating) {
        $sum += $rating['stars'] / count($ratings);
    }
    return $sum;
}

$search_text = "";
if(isset($_GET) && isset($_GET['search_text'])) {
    $search_text = $_GET['search_text'];
}

$_GET[GET_PARAM_LANG]

?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8"/>
        <title>Gericht: <?php echo $meal['name']; ?></title>
        <style>
            * {
                font-family: Arial, serif;
            }
            .rating {
                color: darkgray;
            }
        </style>
    </head>
    <body>

    <label>Sprache:</label> <a href="meal.php" hreflang="en">Englisch</a> <a href="meal.php" hreflang="de">Deutsch</a>

        <h1><?php
            if(GET_PARAM_LANG =="de") echo $txtsde['Gericht'];
            elseif(GET_PARAM_LANG =="en") echo $txtsen['Gericht']; ?>: <?php echo $meal['name']; ?></h1>
        <p><?php if(GET_PARAM_SHOW_DESCRIPTION==1){ echo $meal['description'];}
            elseif(GET_PARAM_SHOW_DESCRIPTION==0){echo "";}?></p>

        <h1><?php
            if(GET_PARAM_LANG =="de") echo $txtsde['Preis'];
            elseif(GET_PARAM_LANG =="en") echo $txtsen['Preis']; ?>:</h1>
            <label>Intern:</label> <?php echo  $meal['price_intern'] ?>€
            <br>
            <label>Extern:</label> <?php echo $meal['price_extern'] ?>€

        <h1><?php
            if(GET_PARAM_LANG =="de") echo $txtsde['Allergens'];
            elseif(GET_PARAM_LANG =="en") echo $txtsen['Allergens']; ?>:</h1>
        <?php foreach ( $meal['allergens'] as $allergen){
            echo "<ul> 
                        <li>$allergens[$allergen]</li>
                  </ul>";
        }?>
        <h1><fieldset>  <?php
                if(GET_PARAM_LANG =="de") echo $txtsde['Bewertungen'];
                elseif(GET_PARAM_LANG =="en") echo $txtsen['Bewertungen']; ?>
                ( <?php
                if(GET_PARAM_LANG =="de") echo $txtsde['Insgesamt'];
                elseif(GET_PARAM_LANG =="en") echo $txtsen['Insgesamt']; ?>: <?php echo calcMeanStars($ratings); ?>)</h1>
        <form method="get">
            <label for="search_text">Filter:</label>
            <input id="search_text" type="text" name="search_text" value="<?php echo $search_text;?>" />
            <input type="submit" value=<?php
            if(GET_PARAM_LANG =="de") echo $txtsde['Suchen'];
            elseif(GET_PARAM_LANG =="en") echo $txtsen['Suchen']; ?>>
        </form>
        <table class="rating">
            <thead>
            <tr>
                <td><?php
                    if(GET_PARAM_LANG =="de") echo $txtsde['Text'];
                    elseif(GET_PARAM_LANG =="en") echo $txtsen['Text']; ?></td>
                <td><?php
                    if(GET_PARAM_LANG =="de") echo $txtsde['Sterne'];
                    elseif(GET_PARAM_LANG =="en") echo $txtsen['Sterne']; ?></td>
                <td><?php
                    if(GET_PARAM_LANG =="de") echo $txtsde['Author'];
                    elseif(GET_PARAM_LANG =="en") echo $txtsen['Author']; ?></td>
            </tr>
            </thead>
            <tbody>
            <?php
        foreach ($showRatings as $rating) {
            echo "<tr><td class='rating_text'>{$rating['text']}</td>
                      <td class='rating_stars'>{$rating['stars']}</td>
                      <td class='author_name'>{$rating['author']}</td>
                  </tr>";
        }
        ?>
            </tbody>
    </body>
</html>