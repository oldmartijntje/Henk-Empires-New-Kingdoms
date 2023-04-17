<?php 
require "shared/config.php";
require "shared/functions.php";

$definedLocations = [
    // L001 - L010
    ["name" => "", "onGoingL" => "Double the onGoing effects", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onGoingL" => "Double the on reveal effects", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onGoingL" => "When this reaches a total power of 10+, switch the location", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onRevealL" => "Add a random card to everyones deck.", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onGoingL" => "all cards cost 1 less", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onGoingL" => "all cards cost 1 more", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "specialL" => "everyone teams up with their neighbour, you now gotta win together (total energy is 22)", "icons" => "teams", "description" => "", "image" => ""],
    ["name" => "", "onRevealL" => "everyone has 10 extra energy", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onGoingL" => "energy cost becomes the power of the card", "icons" => "", "description" => "", "image" => ""],
    ["name" => "404-NOTFOUND", "icons" => "", "description" => "nothing happens", "image" => ""],
    // L011 - L020
    ["name" => "Catnip factory", "onGoingL" => "when you play a card you have to meow", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onGoingL" => "only 2 cards can be played per person", "icons" => "", "description" => "", "image" => ""],
    ["name" => "Black hole", "onGoingL" => "cards have no effects", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onGoingL" => "onGoing effects are disabled", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onGoingL" => "on reveal effects are disabled", "icons" => "", "description" => "", "image" => ""],
    ["name" => "Nuclear launch", "onRevealL" => "turns into Nuked world (L017) next turn", "icons" => "", "description" => "", "image" => ""],
    ["name" => "Nuked world", "onGoingL" => "cards can't be played", "icons" => "notDrawable", "description" => "", "image" => ""],
    ["name" => "", "onGoingL" => "you can only play 1 card per turn", "icons" => "", "description" => "", "image" => ""],
    ["name" => "Flooding", "onRevealL" => "turns into flooded (L020) next turn", "icons" => "", "description" => "", "image" => ""],
    ["name" => "Flooded", "onGoingL" => "only water type cards can be played here", "icons" => "notDrawable", "description" => "", "image" => ""],
    // L021 - L030
    ["name" => "", "onGoingL" => "you can only play cards here that have effects", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onGoingL" => "all cards cost 2", "icons" => "", "description" => "", "image" => ""],
    ["name" => "Mushroom kingdom", "onGoingL" => "all mushroom series cards get +1 power", "icons" => "", "description" => "", "image" => ""],
    ["name" => "Aperture", "onGoingL" => "all cards lose 3 power once played (2 will turn into -1)", "icons" => "", "description" => "neurotoxins go brrrr", "image" => ""],
    ["name" => "Texas", "onRevealL" => "all cards in your hand lose 3 power (2 will turn into -1)", "icons" => "", "description" => "Gotta pay your taxes", "image" => ""],
];

$emptyLocationModel = [
    "onRevealL" => "",
    "onGoingL" => "",
    "specialL" => "",
    "icons" => ""
];

$blacklistedLocationKeys = ["id", "image", "name", "description"];

$possibleLocationOptions = [
    "onRevealL" => [],
    "onGoingL" => [],
    "specialL" => [],
    "icons" => []
];

function getImage($card, $index, $LocationConfig) {
    if (!isset($card["image"]) || $card["image"] == "") {
        $card["image"] = $LocationConfig["defaultImage"];
        return $card;
    } else {
        return $card;
    }
}

function createCard($card, $index, $LocationConfig) {
    $card = calculateId($card, $index + 1, $LocationConfig["id"]);
    if (!isset($card["amount"]) || $card["amount"] == "") {
        $card["amount"] = $LocationConfig["defaultAmount"];
    }
    if (!isset($card["name"]) || $card["name"] == "") {
        $card["name"] = $LocationConfig["defaultName"];
    }
    if ((!isset($card["image"]) || $card["image"] == "") && file_exists("assets/images/" . $card["id"] . ".png")) {
        $card["image"] = "assets/images/" . $card["id"] . ".png";
    }
    $card = getImage($card, $index, $LocationConfig);
    return $card;
}

for ($x = 0; $x < count($definedLocations); $x++) {
    $definedLocations[$x] = createCard($definedLocations[$x], $x, $LocationConfig);
}

$possibleLocationOptions = getAllOptions($definedLocations, $blacklistedLocationKeys, $possibleLocationOptions);

?>