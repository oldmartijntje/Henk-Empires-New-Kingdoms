<?php 
require "shared/config.php";

$definedBattleCards = [
    ["name" => "","power" => 0,"energy" => 0,"balance" => 1,"onReveal" => "","onGoing" => "This card has as much power as unspent energy","description" => "","special" => "","image" => "","type" => "Fire","series" => ""],
    ["name" => "Henk the Stone","power" => 1,"energy" => 0,"balance" => 1,"onReveal" => "","onGoing" => "","description" => "You are my rock","special" => "","image" => "assets/images/B002.png","type" => "Earth","series" => "Henk"],
    ["name" => "GLaDOS","power" => 2,"energy" => 0,"balance" => 3,"onReveal" => "Afflict all other cards with -1 power","onGoing" => "","description" => "Neurotoxins go brrrr","special" => "","image" => "","type" => "Electric","series" => ""],
    ["name" => "","power" => 1,"energy" => 1,"balance" => 0,"onReveal" => "","onGoing" => "","description" => "","special" => "","image" => "","type" => "Water","series" => ""],
    ["name" => "","power" => 2,"energy" => 1,"balance" => 1,"onReveal" => "","onGoing" => "","description" => "","special" => "","image" => "","type" => "Fire","series" => ""],
    ["name" => "","power" => 3,"energy" => 1,"balance" => 4,"onReveal" => "pick someones card (blindly) they have to play it (if they have 3 energy left), the cost of that card is now 3","onGoing" => "","description" => "","special" => "","image" => "","type" => "Earth","series" => ""],
    ["name" => "","power" => 2,"energy" => 2,"balance" => 0,"onReveal" => "","onGoing" => "","description" => "","special" => "","image" => "","type" => "Wind","series" => ""],
    ["name" => "","power" => 3,"energy" => 2,"balance" => 1,"onReveal" => "","onGoing" => "","description" => "","special" => "","image" => "","type" => "Water","series" => ""],
    ["name" => "","power" => 4,"energy" => 2,"balance" => 0,"onReveal" => "Play a rock (B070) at someone else","onGoing" => "","description" => "","special" => "","image" => "","type" => "Fire","series" => ""],
    ["name" => "","power" => 3,"energy" => 3,"balance" => 0,"onReveal" => "","onGoing" => "","description" => "","special" => "","image" => "","type" => "Earth","series" => ""],
    ["name" => "","power" => 4,"energy" => 3,"balance" => 1,"onReveal" => "","onGoing" => "","description" => "","special" => "","image" => "","type" => "Wind","series" => ""],
    ["name" => "","power" => 5,"energy" => 3,"balance" => 3,"onReveal" => "","onGoing" => "Players can only play 1 card per turn","description" => "","special" => "","image" => "","type" => "Water","series" => ""],
    ["name" => "", "power" => "4", "energy" => "4", "balance" => "0", "onReveal" => "", "onGoing" => "", "special" => "", "description" => "", "type" => "Fire"],
    ["name" => "", "power" => "5", "energy" => "4", "balance" => "1", "onReveal" => "", "onGoing" => "", "special" => "", "description" => "", "type" => "Earth"],
    ["name" => "", "power" => "6", "energy" => "4", "balance" => "3", "onReveal" => "", "onGoing" => "This card has 6 extra power if it's the only card you have played", "special" => "", "description" => "", "type" => "Wind"]
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
        $card["shopCost"] = ((int)$card["balance"] * (int)$BattleCardConfig["CostBalanceMultiplier"]) + (int)$BattleCardConfig["CostAddition"];
        return $card;
    } else {
        return $card;
    }
}

function calculateDeck($card, $index, $BattleCardConfig) {
    if (!isset($card["deck"])) {
        if ((int)$card["balance"] < (int)$BattleCardConfig["DeckMaxBalanceLevel"] && (int)$card["power"] < (int)$BattleCardConfig["DeckMaxPowerLevel"]) {
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