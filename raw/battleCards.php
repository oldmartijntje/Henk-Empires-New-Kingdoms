<?php 
require "shared/config.php";

$definedBattleCards = [
    // B001- B010
    ["name" => "","power" => 0,"energy" => 0,"balance" => 1,"onReveal" => "","onGoing" => "This card has as much power as unspent energy","description" => "","special" => "","image" => "","type" => "Fire","series" => ""],
    ["name" => "Henk the Stone","power" => 1,"energy" => 0,"balance" => 1,"onReveal" => "","onGoing" => "","description" => "You are my rock","special" => "","image" => "assets/images/B002.png","type" => "Earth","series" => "Henk"],
    ["name" => "GLaDOS","power" => 2,"energy" => 0,"balance" => 3,"onReveal" => "Afflict all other cards with -1 power","onGoing" => "","description" => "Neurotoxins go brrrr","special" => "","image" => "assets/images/B003.png","type" => "Electric","series" => ""],
    ["name" => "","power" => 1,"energy" => 1,"balance" => 0,"onReveal" => "","onGoing" => "","description" => "","special" => "","image" => "","type" => "Water","series" => ""],
    ["name" => "","power" => 2,"energy" => 1,"balance" => 1,"onReveal" => "","onGoing" => "","description" => "","special" => "","image" => "","type" => "Fire","series" => ""],
    ["name" => "","power" => 3,"energy" => 1,"balance" => 4,"onReveal" => "pick someones card (blindly) they have to play it (if they have 3 energy left), the cost of that card is now 3","onGoing" => "","description" => "","special" => "","image" => "","type" => "Earth","series" => ""],
    ["name" => "","power" => 2,"energy" => 2,"balance" => 0,"onReveal" => "","onGoing" => "","description" => "","special" => "","image" => "","type" => "Wind","series" => ""],
    ["name" => "","power" => 3,"energy" => 2,"balance" => 1,"onReveal" => "","onGoing" => "","description" => "","special" => "","image" => "","type" => "Water","series" => ""],
    ["name" => "Meteorite","power" => 4,"energy" => 2,"balance" => 0,"onReveal" => "Play a rock (B070) at someone else","onGoing" => "","description" => "","special" => "","image" => "","type" => "Fire","series" => ""],
    ["name" => "","power" => 3,"energy" => 3,"balance" => 0,"onReveal" => "","onGoing" => "","description" => "","special" => "","image" => "","type" => "Earth","series" => ""],
    // B011 - B020
    ["name" => "","power" => 4,"energy" => 3,"balance" => 1,"onReveal" => "","onGoing" => "","description" => "","special" => "","image" => "","type" => "Wind","series" => ""],
    ["name" => "","power" => 5,"energy" => 3,"balance" => 3,"onReveal" => "","onGoing" => "Players can only play 1 card per turn","description" => "","special" => "","image" => "","type" => "Water","series" => ""],
    ["name" => "", "power" => "4", "energy" => "4", "balance" => "0", "onReveal" => "", "onGoing" => "", "special" => "", "description" => "", "type" => "Fire"],
    ["name" => "", "power" => "5", "energy" => "4", "balance" => "1", "onReveal" => "", "onGoing" => "", "special" => "", "description" => "", "type" => "Earth"],
    ["name" => "", "power" => "6", "energy" => "4", "balance" => "3", "onReveal" => "", "onGoing" => "This card has 6 extra power if it's the only card you have played", "special" => "", "description" => "", "type" => "Wind"],
    ["name" => "", "power" => "5", "energy" => "5", "balance" => "0", "onReveal" => "", "onGoing" => "", "special" => "", "description" => "", "type" => "Water"],  
    ["name" => "", "power" => "6", "energy" => "5", "balance" => "1", "onReveal" => "", "onGoing" => "", "special" => "", "description" => "", "type" => "Fire"],
    ["name" => "", "power" => "7", "energy" => "5", "balance" => "3", "onReveal" => "", "onGoing" => "Disable all on reveal effects for everyone", "special" => "", "description" => "", "type" => "Earth", "series" => ""],
    ["name" => "", "power" => "6", "energy" => "6", "balance" => "0", "onReveal" => "", "onGoing" => "", "special" => "", "description" => "", "type" => "Wind", "series" => ""],
    ["name" => "", "power" => "7", "energy" => "6", "balance" => "1", "onReveal" => "", "onGoing" => "", "special" => "", "description" => "", "type" => "Water", "series" => ""],
    // B021 - B030
    ["name" => "", "power" => "8", "energy" => "6", "balance" => "2", "onReveal" => "Remove all ongoing effects from all cards in everyone's hands", "onGoing" => "", "special" => "", "description" => "", "type" => "Fire", "series" => ""],
    ["name" => "", "power" => "7", "energy" => "7", "balance" => "0", "onReveal" => "", "onGoing" => "", "special" => "", "description" => "", "type" => "Earth", "series" => ""],
    ["name" => "", "power" => "8", "energy" => "7", "balance" => "1", "onReveal" => "", "onGoing" => "", "special" => "", "description" => "", "type" => "Wind", "series" => ""],
    ["name" => "", "power" => "10", "energy" => "7", "balance" => "3", "onReveal" => "", "onGoing" => "", "special" => "", "description" => "", "type" => "Water", "series" => ""],
    ["name" => "Giftcard", "power" => "7", "energy" => "3", "balance" => "0", "onReveal" => "", "onGoing" => "", "special" => "when played, after battle is over give this card to the player in last place", "description" => "", "type" => "Fire", "series" => "", "deck" => "A"],
    ["name" => "", "power" => "8", "energy" => "3", "balance" => "3", "onReveal" => "", "onGoing" => "", "special" => "you can only have a total of 2 cards", "description" => "", "type" => "Earth", "series" => ""],
    ["name" => "", "power" => "4", "energy" => "2", "balance" => "3", "onReveal" => "", "onGoing" => "Your cards don't have abilities anymore (except this one)", "special" => "", "description" => "", "type" => "Wind", "series" => ""],
    ["name" => "", "power" => "5", "energy" => "3", "balance" => "4", "onReveal" => "", "onGoing" => "all cards lost their abilities (except this one)", "special" => "", "description" => "", "type" => "Water", "series" => ""],   
    ["name" => "", "power" => "5", "energy" => "4", "balance" => "2", "onReveal" => "", "onGoing" => "all cards cost 2", "special" => "", "description" => "", "type" => "Fire", "series" => ""],
    ["name" => "", "power" => "10", "energy" => "4", "balance" => "3", "onReveal" => "choose 1 battlecard from every player's hand (blindly) they will play that card for free", "onGoing" => "", "special" => "", "description" => "", "type" => "Earth", "series" => ""],
    // B031 - B040
    ["name" => "", "power" => "3", "energy" => "3", "balance" => "1", "onReveal" => "let an opponent choose a card from your hand (blindly) you will play that card for free", "onGoing" => "", "special" => "", "description" => "", "type" => "Wind", "series" => ""],
    ["name" => "", "power" => "2", "energy" => "3", "balance" => "1", "onReveal" => "next card you play will get it's power doubled", "onGoing" => "", "special" => "", "description" => "", "type" => "Water", "series" => ""],     
    ["name" => "", "power" => "4", "energy" => "3", "balance" => "1", "onReveal" => "next card you play will get it's power and energy doubled", "onGoing" => "", "special" => "", "description" => "", "type" => "Fire", "series" => ""],
    ["name" => "Fire Flower", "power" => "3", "energy" => "3", "balance" => "1", "onReveal" => "give all fire type cards 1 extra power", "onGoing" => "", "special" => "", "description" => "", "type" => "Fire", "series" => "mushroom"],
    ["name" => "", "power" => "3", "energy" => "3", "balance" => "1", "onReveal" => "give all your water type cards 1 extra power", "onGoing" => "", "special" => "", "description" => "", "type" => "Electric", "series" => ""],
    ["name" => "", "power" => "3", "energy" => "3", "balance" => "1", "onReveal" => "give all your earth type cards 1 extra power", "onGoing" => "", "special" => "", "description" => "", "type" => "Earth", "series" => ""],
    ["name" => "", "power" => "3", "energy" => "3", "balance" => "1", "onReveal" => "give all your wind type cards 1 extra power", "onGoing" => "", "special" => "", "description" => "", "type" => "Wind", "series" => ""],
    ["name" => "Fire Magic", "power" => "2", "energy" => "2", "balance" => "1", "onReveal" => "", "onGoing" => "all your fire type cards cost 1 less energy", "special" => "", "description" => "", "type" => "Fire", "series" => ""],
    ["name" => "", "power" => "2", "energy" => "2", "balance" => "1", "onReveal" => "", "onGoing" => "all your water type cards cost 1 less energy", "special" => "", "description" => "", "type" => "Electric", "series" => ""],     
    ["name" => "", "power" => "2", "energy" => "2", "balance" => "1", "onReveal" => "", "onGoing" => "all your earth type cards cost 1 less energy", "special" => "", "description" => "", "type" => "Earth", "series" => ""],
    // B041 - B050
    ["name" => "", "power" => "2", "energy" => "2", "balance" => "1", "onReveal" => "", "onGoing" => "all your wind type cards cost 1 less energy", "special" => "", "description" => "", "type" => "Wind", "series" => ""],
    ["name" => "Lava Monster", "power" => "7", "energy" => "5", "balance" => "4", "onReveal" => "give all your fire type cards 1 extra power", "onGoing" => "", "special" => "", "description" => "Blaaarg", "type" => "Fire", "series" => "mushroom"],
    ["name" => "Electric Ball", "power" => "7", "energy" => "5", "balance" => "4", "onReveal" => "give all your water type cards 1 extra power", "onGoing" => "", "special" => "", "description" => "bzzt", "type" => "Electric", "series" => "mushroom"],
    ["name" => "", "power" => "7", "energy" => "5", "balance" => "4", "onReveal" => "give all your earth type cards 1 extra power", "onGoing" => "", "special" => "", "description" => "", "type" => "Earth", "series" => ""],       
    ["name" => "", "power" => "7", "energy" => "5", "balance" => "4", "onReveal" => "give all your wind type cards 1 extra power", "onGoing" => "", "special" => "", "description" => "", "type" => "Wind", "series" => ""],
    ["name" => "DIY Forge", "power" => "7", "energy" => "5", "balance" => "4", "onReveal" => "", "onGoing" => "all your fire type cards cost 1 less energy", "special" => "", "description" => "", "type" => "Fire", "series" => ""],
    ["name" => "", "power" => "7", "energy" => "5", "balance" => "4", "onReveal" => "", "onGoing" => "all your water type cards cost 1 less energy", "special" => "", "description" => "", "type" => "Electric", "series" => ""],     
    ["name" => "Boulder Mushroom", "power" => "7", "energy" => "5", "balance" => "4", "onReveal" => "", "onGoing" => "all your earth type cards cost 1 less energy", "special" => "", "description" => "", "type" => "Earth", "series" => "mushroom"],
    ["name" => "", "power" => "7", "energy" => "5", "balance" => "4", "onReveal" => "", "onGoing" => "all your wind type cards cost 1 less energy", "special" => "", "description" => "", "type" => "Wind", "series" => ""],
    ["name" => "", "power" => "-1", "energy" => "0", "balance" => "1", "onReveal" => "steal 1 energy from all other players (if they have any left)", "onGoing" => "", "special" => "", "description" => "", "type" => "Earth", "series" => ""],
    // B051 - B060
    ["name" => "Volcano", "power" => "4", "energy" => "0", "balance" => "3", "onReveal" => "For every fire type card in game (played by any player), give this card +1 power", "onGoing" => "", "special" => "This costs the amount of cards you have in your hand", "description" => "", "type" => "Fire", "series" => ""],
    ["name" => "", "power" => "2", "energy" => "0", "balance" => "1", "onReveal" => "For every water type card in the game (played by any player), give this card +1 power", "onGoing" => "", "special" => "This costs the amount of cards you have in your hand", "description" => "", "type" => "Electric", "series" => ""],
    ["name" => "", "power" => "3", "energy" => "0", "balance" => "2", "onReveal" => "For every earth type card in the game (played by any player), give this card +1 power", "onGoing" => "", "special" => "This costs the amount of cards you have in your hand", "description" => "", "type" => "Earth", "series" => ""],
    ["name" => "", "power" => "1", "energy" => "0", "balance" => "1", "onReveal" => "For every wind type card in the game (played by any player), give this card +1 power", "onGoing" => "", "special" => "This costs the amount of cards you have in your hand", "description" => "", "type" => "Wind", "series" => ""],
    ["name" => "Lloyd", "power" => "-15", "energy" => "3", "balance" => "4", "onReveal" => "", "onGoing" => "Has +10 power for every card of the Type Green played (anywhere in the game)", "special" => "", "description" => "", "type" => "Green", "series" => "ninja"],
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

$blacklistedKeys = ["id", "shopCost", "deck", "image", "name","description"];

$possibleOptions = [
    "power" => [],
    "energy" => [],
    "balance" => [],
    "onReveal" => [],
    "onGoing" => [],
    "special" => [],
    "type" => [],
    "series" => [],
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
    if (!isset($card["name"]) || $card["name"] == "") {
        $card["name"] = $BattleCardConfig["defaultName"];
    }
    if ((!isset($card["image"]) || $card["image"] == "") && file_exists("assets/images/" . $card["id"] . ".png")) {
        $card["image"] = "assets/images/" . $card["id"] . ".png";
    }
    $card = getImage($card, $index, $BattleCardConfig);
    return $card;
}

require "shared/functions.php";

for ($x = 0; $x < count($definedBattleCards); $x++) {
    $definedBattleCards[$x] = createCard($definedBattleCards[$x], $x, $BattleCardConfig);
}

foreach ($definedBattleCards as $card) {
    foreach($card as $key=>$value) {
        if (in_array((string)$key, $blacklistedKeys)) {
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