<?php
namespace PokePHP;

require "../vendor/danrovito/pokephp/src/PokeApi.php";

$poke = new PokeApi();
$pokemonData = [];
$pokemonNamenDe = json_decode(file_get_contents("namen.json"));
for ($i = 1; $i <= 386; $i++) {
    $result = json_decode($poke->pokemon($i));
    $result_species = json_decode($poke->pokemonspecies($i));
    $description = "";
    foreach ($result_species->flavor_text_entries as $flavorTextEntry) {
        if($flavorTextEntry->language->name == "de") {
            $description = $flavorTextEntry->flavor_text;
        }
    }
    $pokemon[$i]['name'] = $pokemonNamenDe->namen[$i-1];
    $pokemon[$i]['description'] = $description;
    $pokemon[$i]['height'] = $result->height;
    $pokemon[$i]['weight'] = $result->weight;
    $pokemon[$i]['color'] = $result_species->color->name;
    $pokemon[$i]['baby'] = $result_species->is_baby;
    $pokemon[$i]['shape'] = $result_species->shape->name;
    $pokemon[$i]['imageUrl'] = $result->sprites->front_default;
    foreach ($result->types as $key => $element) {
        $type = "";
        switch ($element->type->name) {
            case("normal"): $type = "Normal"; break;
            case("fire"): $type = "Feuer"; break;
            case("water"): $type = "Wasser"; break;
            case("electric"): $type = "Elektro"; break;
            case("grass"): $type = "Pflanze"; break;
            case("flying"): $type = "Flug"; break;
            case("bug"): $type = "Käfer"; break;
            case("poison"): $type = "Gift"; break;
            case("rock"): $type = "Stein"; break;
            case("ground"): $type = "Boden"; break;
            case("fighting"): $type = "Kampf"; break;
            case("ice"): $type = "Eis"; break;
            case("psychic"): $type = "Psycho"; break;
            case("ghost"): $type = "Geist"; break;
            case("dragon"): $type = "Drache"; break;
            case("steel"): $type = "Stahl"; break;
            case("dark"): $type = "Unlicht"; break;
            case("fairy"): $type = "Fee"; break;
        }
        $pokemon[$i]['types'][] = $type;
    }
    $pokemonData = json_encode($pokemon);
}

file_put_contents("data.json", $pokemonData);
