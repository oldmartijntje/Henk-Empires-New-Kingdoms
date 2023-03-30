<?php 
require "shared/config.php";

$definedBattleCards = [
    ["name" => "",
    "power" => 0,
    "energy" => 0,
    "balance" => 1,
    "onReveal" => "",
    "onGoing" => "This card has as much power as unspent energy",
    "description" => "",
    "special" => "",
    "image" => "",
    "type" => "Fire",
    "series" => ""],
    ["name" => "Henk the Stone",
    "power" => 1,
    "energy" => 0,
    "balance" => 1,
    "onReveal" => "",
    "onGoing" => "",
    "description" => "You are my rock",
    "special" => "",
    "image" => "assets/images/B002.png",
    "type" => "Stone",
    "series" => "Henk"],
    ["name" => "GLaDOS",
    "power" => 2,
    "energy" => 0,
    "balance" => 3,
    "onReveal" => "Afflict all other cards with -1 power",
    "onGoing" => "",
    "description" => "Neurotoxins go brrrr",
    "special" => "",
    "image" => "",
    "type" => "Electric",
    "series" => ""]
];

$emptyModel = [
    "power" => 0,
    "energy" => 0,
    "balance" => 0,
    "onReveal" => "",
    "onGoing" => "",
    "special" => "",
    "type" => "",
    "series" => ""
];

$blacklistedKeys = ["id", "shopCost", "deck", "name", "image","description"];

$possibleOptions = [
    "power" => [],
    "energy" => [],
    "balance" => [],
    "onReveal" => [],
    "onGoing" => [],
    "special" => [],
    "type" => [],
    "series" => []
];


function calculateCost($card, $index, $BattleCardConfig) {
    if (isset($card["balance"])) {
        $card["shopCost"] = ($card["balance"] * $BattleCardConfig["CostBalanceMultiplier"]) + $BattleCardConfig["CostAddition"];
        return $card;
    } else {
        return $card;
    }
}

function calculateDeck($card, $index, $BattleCardConfig) {
    if (!isset($card["deck"])) {
        if ($card["balance"] < $BattleCardConfig["DeckMaxBalanceLevel"] && $card["power"] < $BattleCardConfig["DeckMaxPowerLevel"]) {
            $card["deck"] = "A";
        } else {
            $card["deck"] = "B";
        }
        return $card;
    } else {
        return $card;
    }
    return $card;
}

function getImage($card, $index, $BattleCardConfig) {
    if (!isset($card["image"]) || $card["image"] == "") {
        $card["image"] = $BattleCardConfig["defaultImage"];
        return $card;
    } else {
        return $card;
    }
}

function createCard($card, $index, $BattleCardConfig) {
    $card = calculateCost($card, $index, $BattleCardConfig);
    $card = calculateDeck($card, $index, $BattleCardConfig);
    $card = calculateId($card, $index + 1, $BattleCardConfig["id"]);
    $card = getImage($card, $index, $BattleCardConfig);
    return $card;
}

require "shared/functions.php";

for ($x = 0; $x < count($definedBattleCards); $x++) {
    $definedBattleCards[$x] = createCard($definedBattleCards[$x], $x, $BattleCardConfig);
}

foreach ($definedBattleCards as $card) {
    foreach($card as $key=>$value) {
        if (in_array($key, $blacklistedKeys)) {
            continue;
        } else {
            if (in_array($value, $possibleOptions[$key])) {
                continue;
            } else {
                array_push($possibleOptions[$key],$value);
            }
        }
    }
}
?>