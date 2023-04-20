<?php 
require "shared/config.php";
require "shared/functions.php";

$definedLocations = [
    // L001 - L010
    ["name" => "", "onGoingL" => "Double the |onGoing| onGoing effects", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onGoingL" => "Double the |onReveal| on reveal effects", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onGoingL" => "When this reaches a total |Power| power of 10+, switch the location", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onRevealL" => "Add a random card to everyones deck.", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onGoingL" => "all cards cost 1 |Energy| less", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onGoingL" => "all cards cost 1 |Energy| more", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "specialL" => "everyone teams up with their neighbour, you now gotta win together (total |Energy| energy is 22)", "icons" => "teams", "description" => "", "image" => ""],
    ["name" => "Hollywood", "onRevealL" => "everyone has 10 extra |Energy| energy", "icons" => "", "description" => "What on earth is he doing?", "image" => ""],
    ["name" => "", "onGoingL" => "|Energy| energy cost becomes the |Power| power of the card", "icons" => "", "description" => "", "image" => ""],
    ["name" => "404-NOTFOUND", "icons" => "", "description" => "nothing happens", "image" => ""],
    // L011 - L020
    ["name" => "Catnip factory", "onGoingL" => "when you play a card you have to meow for a 1 |Energy| cost discount (1 per card)", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onGoingL" => "only 2 cards can be played per person", "icons" => "", "description" => "", "image" => ""],
    ["name" => "Black hole", "onGoingL" => "cards have no effects", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onGoingL" => "|onGoing| onGoing effects are disabled", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onGoingL" => "|onReveal| on reveal effects are disabled", "icons" => "", "description" => "", "image" => ""],
    ["name" => "Nuclear launch", "onRevealL" => "turns into Nuked world (L017) next turn", "icons" => "", "description" => "", "image" => ""],
    ["name" => "Nuked world", "onGoingL" => "cards can't be played", "icons" => "notDrawable", "description" => "", "image" => ""],
    ["name" => "", "onGoingL" => "you can only play 1 card per turn", "icons" => "", "description" => "", "image" => ""],
    ["name" => "Flooding", "onRevealL" => "turns into flooded (L020) next turn", "icons" => "", "description" => "", "image" => ""],
    ["name" => "Flooded", "onGoingL" => "only water type cards can be played here", "icons" => "notDrawable", "description" => "", "image" => ""],
    // L021 - L030
    ["name" => "", "onGoingL" => "you can only play cards here that have effects", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onGoingL" => "all cards cost 2 |Energy|", "icons" => "", "description" => "", "image" => ""],
    ["name" => "Mushroom kingdom", "onGoingL" => "all |Mushroom| mushroom series cards get +1 |Power| power", "icons" => "", "description" => "", "image" => ""],
    ["name" => "Aperture", "onGoingL" => "all cards lose 3 |Power| power once played (2 will turn into -1)", "icons" => "", "description" => "neurotoxins go brrrr", "image" => ""],
    ["name" => "Stockmarket", "onRevealL" => "all cards in your hand lose 3 |Power| power (2 will turn into -1)", "icons" => "", "description" => "Deflation", "image" => ""],
    ["name" => "Kingdom of the Ducks", "onReveal" => "Add 1 |Power| power to all played cards", "icons" => "", "description" => "No ducks were BBQ'd", "image" => ""],
    ["name" => "", "onGoingL" => "3 and 4 |Energy| cost cards cost 5 |Energy|", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onGoingL" => "1 and 2 |Energy| cost cards cost 0 |Energy|", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onRevealL" => "Everyone rolls dice, they get this much extra |Energy| energy", "icons" => "", "description" => "", "image" => ""],
    ["name" => "Hide and seek", "onGoingL" => "Cards get revealed at the end of the battle.", "icons" => "", "description" => "", "image" => ""],
    // L031 - L040
    ["name" => "Wildfire", "onReveal" => "If your card is a |Fire| fire type, throw a |D6| 6 sided dice and add it to it's power |Power|", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onReveal" => "If your card is a |Water| water type, throw a |D6| 6 sided dice and add it to it's power |Power|", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "specialL" => "If someone can correctly guess what card you played when it's not yet revealed, it will have 2 less |Power| power", "icons" => "Fun", "description" => "", "image" => ""],
    ["name" => "", "specialL" => "It's not turn based. Set a 5 minute timer, everyone can play cards whenever they want. Battle is over when timer finishes.", "icons" => "Fun", "description" => "", "image" => ""],
    ["name" => "", "specialL" => "All cards change type to |???| type", "icons" => "???", "description" => "", "image" => ""],
    ["name" => "", "onReveal" => "turn all your cards 90 degrees in the same direction.", "onGoingL" => "Remove all cards that face it's player.", "icons" => "", "description" => "", "image" => ""],
    ["name" => "", "onReveal" => "Replace it with a random card.", "icons" => "", "description" => "", "image" => ""],
];

$emptyLocationModel = [
    "onRevealL" => "",
    "onReveal" => "",
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