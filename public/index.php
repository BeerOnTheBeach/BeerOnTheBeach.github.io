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
    <form method="post">
        <div class="navbar btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group me-2 col-1" style="margin-left: 8px;" role="group">
                <button type="submit" name="randomType" class="btn btn-info">Typ</button>
            </div>
            <div class="btn-group me-2 col-3" role="group">
                <button type="submit" name="randomHeight" class="btn btn-secondary">Höhe</button>
                <button type="submit" name="randomWeight" class="btn btn-secondary">Gewicht</button>
                <button type="submit" name="randomColor" class="btn btn-secondary">Farbe</button>
            </div>
            <div class="btn-group me-2 col-2" role="group">
                <button type="submit" name="randomChar" class="btn btn-secondary">Anfangsbuchstabe</button>
            </div>
            <div class="btn-group me-2 col" role="group">
                <button style="background-color: #F85888" type="submit" name="isBaby" class="btn">Nur Baby-Pokemon!</button>
            </div>
            <div class="btn-group me-2 col" role="group">
                <button type="submit" name="totalRandom" class="btn btn-danger">Random!</button>
            </div>
            <table class="table table-hover text-center">
                <tr class="d-flex">
                    <th class="col-1">Typ</th>
                    <th class="col-1">Höhe</th>
                    <th class="col-1">Gewicht</th>
                    <th class="col-1">Farbe</th>
                    <th class="col-2">Anfangsbuchstabe</th>
                    <th class="col-3">Babys</th>
                    <th class="col-3">Random</th>
                </tr>
                <tr class="d-flex">
                    <?php
                    echo "<td class='col-1 pe-2'>" . $randomizer->randomType . "</td>";
                    echo "<td class='col-1 pe-2'>" . $randomizer->randomHeight . "</td>";
                    echo "<td class='col-1 pe-2'>" . $randomizer->randomWeight . "</td>";
                    echo "<td class='col-1 pe-2'>" . $randomizer->randomColor . "</td>";
                    echo "<td class='col-2 pe-2'>" . $randomizer->randomChar . "</td>";
                    echo "<td height='50px' class='col-3 pe-2'><img style='top: -25px; position: relative;' src=" . $randomizer->isBaby . " alt='Front'></td>";
                    echo "<td class='col-3'></td>";
                    ?>
                </tr>
            </table>
        </div>
    </form>

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