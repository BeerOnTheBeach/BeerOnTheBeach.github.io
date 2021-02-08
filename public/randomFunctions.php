<?php

class PokeRandomizer
{
    // Pokemon Data
    public $pokemonData;

    //Current Random values
    public $randomType = "Alle";
    public $randomHeight = "Alle";
    public $randomWeight = "Alle";
    public $randomChar = "Alle";
    public $isBaby = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/172.png";
    public $randomColor = "Alle";

    //Types
    public $types = ["Normal", "Feuer", "Wasser", "Elektro", "Pflanze", "Flug",
        "Käfer", "Gift", "Stein", "Boden", "Kampf", "Eis", "Psycho", "Geist",
        "Drache", "Stahl", "Unlicht", "Fee"];

    public $colors = ["black", "blue", "brown", "gray", "green", "pink",
        "purple", "red", "white", "yellow"];

    //Height Interval
    public $segHeight = [0, 11, 22, 10000];

    //Weight Interval
    public $segWeight = [0, 62, 130, 10000];

    public function __construct()
    {
        $this->pokemonData = json_decode(file_get_contents("data.json"));
    }

    // Returns a list of pokemon with a random type
    public function randomType($data = null) : array {
        if ($data == null) {
            $data = $this->pokemonData;
            //$this->resetFields();
        }
        $randType = "Alle";
        while (empty($pkmWithType)) {
            $pkmWithType = [];
            $randType = $this->types[array_rand($this->types)];
            foreach ($data as $key => $pokemon) {
                foreach ($pokemon->types as $pokeType) {
                    if ($pokeType == $randType) {
                        $pkmWithType[] = $pokemon;
                    }
                }
            }
        }
        $this->randomType = $randType;
        return $pkmWithType;
    }

    public function randomHeight($data = null) : array {
        if ($data == null) {
            $data = $this->pokemonData;
            //$this->resetFields();
        }
        $pkmWithHeight = [];
        $interval = "Alle";
        while (empty($pkmWithHeight)) {
            $randHeight = array_rand(array_flip($this->segHeight), 2);
            $interval = $randHeight[0]/10 . " - " . $randHeight[1]/10 . "m";
            foreach ($data as $key => $pokemon) {
                if($pokemon->height >= $randHeight[0] && $pokemon->height <= $randHeight[1]) {
                    $pkmWithHeight[] = $pokemon;
                }
            }
        }
        $this->randomHeight = $interval;
        return $pkmWithHeight;
    }

    public function randomWeight($data = null) : array {
        if ($data == null) {
            $data = $this->pokemonData;
            //$this->resetFields();
        }
        $pkmWithWeight = [];
        $interval = "Alle";
        while (empty($pkmWithWeight)) {
            $randWeight = array_rand(array_flip($this->segWeight), 2);
            $interval = $randWeight[0] / 10 . " - " . $randWeight[1] / 10 . "kg";
            foreach ($data as $key => $pokemon) {
                if ($pokemon->weight >= $randWeight[0] && $pokemon->weight <= $randWeight[1]) {
                    $pkmWithWeight[] = $pokemon;
                }
            }
        }
        $this->randomWeight = $interval;
        return $pkmWithWeight;
    }

    public function randomChar($data = null) : array {
        if ($data == null) {
            $data = $this->pokemonData;
            //$this->resetFields();
        }
        $pkmWithChar = [];
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomChar = "Alle";
        while (empty($pkmWithChar)) {
            $randomChar = $chars[rand(0, 25)];
            foreach ($data as $key => $pokemon) {
                if ($pokemon->name[0] == $randomChar) {
                    $pkmWithChar[] = $pokemon;
                }
            }
        }
        $this->randomChar = $randomChar;
        return $pkmWithChar;
    }

    public function isBaby($data = null) : array {
        if ($data == null) {
            $data = $this->pokemonData;
            //$this->resetFields();
        }
        $babyPokemon = [];
        $randomBaby = rand(0,9);
        $i = 0;
            foreach ($data as $key => $pokemon) {
                if ($pokemon->baby == true) {
                    if($randomBaby == $i) $this->isBaby = $pokemon->imageUrl;
                    $i++;
                    $babyPokemon[] = $pokemon;
                }
            }
        return $babyPokemon;
    }

    public function randomColor($data = null) : array {
        if ($data == null) {
            $data = $this->pokemonData;
            //$this->resetFields();
        }
        $randColor = "Alle";
        $pkmWithColor = [];
        while (empty($pkmWithColor)) {
            $randColor = $this->colors[array_rand($this->colors)];
            foreach ($data as $key => $pokemon) {
                if ($pokemon->color == $randColor) {
                    $pkmWithColor[] = $pokemon;
                }
            }
        }
        $this->randomColor = $randColor;
        return $pkmWithColor;
    }
    public function resetFields()  {
        $this->randomType = "Alle";
        $this->randomHeight = "Alle";
        $this->randomWeight = "Alle";
        $this->randomChar = "Alle";
    }
    public function totalRandom($data = null){
        if ($data == null) {
        $data = $this->pokemonData;
        $this->resetFields();
    }
        $random = [];
        while (count($random) <= 1) {
            $random = $data;
            $random = $this->randomHeight($random);
            $random = $this->randomType($random);
            $random = $this->randomWeight($random);
            $random = $this->randomChar($random);
            $random = $this->randomColor($random);
            //$random = $this->isBaby($random);
        }
        return $random;
    }
}