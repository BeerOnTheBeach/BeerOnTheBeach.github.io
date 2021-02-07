<?php
namespace PokePHP;

use PokeRandomizer;

require "randomFunctions.php";

$randomizer = new PokeRandomizer();

$pokemonData = json_decode(file_get_contents("data.json"));
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pokemon Randomizer</title>
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">
    <?php
    if (array_key_exists('randomType', $_POST)) {
        $pokemonData = $randomizer->randomType();
    } else if (array_key_exists('randomHeight', $_POST)) {
        $pokemonData = $randomizer->randomHeight();
    } else if (array_key_exists('randomWeight', $_POST)) {
        $pokemonData = $randomizer->randomWeight();
    } else if (array_key_exists('randomChar', $_POST)) {
        $pokemonData = $randomizer->randomChar();
    } else if (array_key_exists('isBaby', $_POST)) {
        $pokemonData = $randomizer->isBaby();
    } else if (array_key_exists('randomColor', $_POST)) {
        $pokemonData = $randomizer->randomColor();
    } else if (array_key_exists('totalRandom', $_POST)) {
        $pokemonData = $randomizer->totalRandom();
    }
    ?>

    <form class="row" method="post">
        <div class="col">
            <input type="submit" name="randomType" class="btn btn-primary" value="Typ"/>
        </div>
        <div class="col">
            <input type="submit" name="randomHeight" class="btn btn-primary" value="Höhe"/>
        </div>
        <div class="col">
            <input type="submit" name="randomWeight" class="btn btn-primary" value="Gewicht"/>
        </div>
        <div class="col">
            <input type="submit" name="randomChar" class="btn btn-primary" value="Anfangsbuchstabe"/>
        </div>
        <div class="col">
            <input type="submit" name="isBaby" class="btn btn-primary" value="Nur Baby-Pokemon!"/>
        </div>
        <div class="col">
            <input type="submit" name="randomColor" class="btn btn-primary" value="Farbe"/>
        </div>
        <div class="col">
            <input type="submit" name="totalRandom" class="btn btn-primary" value="Random"/>
        </div>


    </form>
    <table class="table table-hover">
        <tr>
            <th>Typ</th>
            <th>Höhe</th>
            <th>Gewicht</th>
            <th>Anfangsbuchstabe</th>
            <th>Farbe</th>
        </tr>
        <tr>
            <?php
            echo "<td>" . $randomizer->randomType . "</td>";
            echo "<td>" . $randomizer->randomHeight . "</td>";
            echo "<td>" . $randomizer->randomWeight . "</td>";
            echo "<td>" . $randomizer->randomChar . "</td>";
            echo "<td>" . $randomizer->randomColor . "</td>";
            ?>
        </tr>
    </table>
    <table class="table table-hover table-pokemon">
        <thead>
        <tr>
            <th>Name</th>
            <th>Typen</th>
            <th>Höhe/Gewicht</th>
            <th>Beschreibung</th>
            <th>Bild</th>
        </tr>
        </thead>
        <tbody>
        <?php


        foreach ($pokemonData as $key => $pokemon) {
            echo "<tr>";
            echo "<td>" . $pokemon->name . "</td>";
            echo "<td><ul>";
            foreach ($pokemon->types as $type) {
                echo "<li>" . $type . "</li>";
            }
            echo "</ul></td>";
            echo "<td>" . $pokemon->height/10 . "m / " . $pokemon->weight/10 . "kg</td>";
            echo "<td>" . $pokemon->description . "</td>";
            echo "<td><a target='_blank' href=https://www.pokewiki.de/" . $pokemon->name . "><img src=" . $pokemon->imageUrl . " alt='Front'></a></td>";

            echo "</tr>";
        }
        echo "</tbody></table>";
        ?>
</div>
</body>
</html>