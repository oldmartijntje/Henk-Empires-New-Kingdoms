<?php 
require "shared/config.php";
require "shared/functions.php";

$definedActionCards = [
    ["name" => "Player-Reverse", "description" => "Force a player to walk backwards the next round.", "type" => "Once", "where" => "board", "amount" => 5, "powerfull" => 2],
    ["name" => "Double-Trouble", "description" => "Roll 2 dice instead of one (of your active type).", "type" => "Once", "where" => "board", "amount" => 5, "powerfull" => 3],
    ["name" => "Coin-Thief", "description" => "Roll a Dice and see what number is on it, and steal that number of coins from a person of your choice, if the other player doesn't have that many coins then you only take what he has.", "type" => "Once", "where" => "board", "amount" => 3, "powerfull" => 3],
    ["name" => "Player-Swap", "description" => "Swap positions with a person of your choice.", "type" => "Once", "where" => "board", "amount" => 3, "powerfull" => 3],
    ["name" => "Dice-Ditcher", "description" => "Choose how many steps you take (choice between 1 and 6).", "type" => "Once", "where" => "board", "amount" => 4, "powerfull" => 2],
    ["name" => "Card-Snitcher", "description" => "Steal a random action card from a person of your choice.", "type" => "Once", "where" => "board", "amount" => 3, "powerfull" => 3],
    ["name" => "Card-Swapper", "description" => "Swap a battle card of your choice with another player's battle card without looking. (you can choose the player).", "type" => "Once", "where" => "board", "amount" => 1, "powerfull" => 6],
    ["name" => "Shop-Mover", "description" => "(if there is a shop tile) move the shop to a spot of your choice (cannot be on the same position as a player).", "type" => "Once", "where" => "board", "amount" => 4, "powerfull" => 3],
    ["name" => "Use-D20", "description" => "Use a D20.", "type" => "Once", "where" => "board", "amount" => 4, "powerfull" => 3],
    ["name" => "Use-D4", "description" => "Use a D4.", "type" => "Active", "where" => "board", "amount" => 5, "powerfull" => 1],
    ["name" => "Use-D10", "description" => "Use a D10.", "type" => "Active", "where" => "board", "amount" => 5, "powerfull" => 3],
    ["name" => "Use-D12", "description" => "Use a D12.", "type" => "Active", "where" => "board", "amount" => 4, "powerfull" => 4],
    ["name" => "Joink", "description" => "Choose a player, the player gives you a battle or playing card of choice.", "type" => "Once", "where" => "board", "amount" => 2, "powerfull" => 7],
    ["name" => "Henk", "description" => "Skip next player.", "type" => "Once", "where" => "board", "amount" => 4, "powerfull" => 4],
    ["name" => "Nope", "description" => "Cancel someone's action card, (you have 5 seconds to nope someone after they played their action card), they are forced to discard the cad they played", "type" => "Once", "where" => "anywhere", "amount" => 6, "powerfull" => 3],
    ["name" => "Mine", "description" => "When someone plays a battlecard, place this card on top of it (when it's not revealed yet), This will become your card when it reveals", "type" => "Once", "where" => "Battle", "amount" => 1, "powerfull" => 7],
    ["name" => "Fortune III", "description" => "Gain 1 extra recourse.", "type" => "Active", "where" => "board", "amount" => 4, "powerfull" => 4],
    ["name" => "Milk", "description" => "Get rid of an active effect.", "type" => "Once", "where" => "board", "amount" => 8, "powerfull" => 3],
    ["name" => "Immune", "description" => "Be immune to 1 HEX, it won't effect you, afterwards discard this card.", "type" => "Active", "where" => "board", "amount" => 2, "powerfull" => 3],
    ["name" => "Battle", "description" => "Throw a dice, every player you pass joins batle, you choose how many coins to bet, the winner gets this number from the other players. (cannot be above own number of coins)", "type" => "Once", "where" => "board", "amount" => 6, "powerfull" => 7],
    ["name" => "HEX hacker", "description" => "Turn someone elses HEX into yours (if you aleady have that HEX on the board, move it here.)", "type" => "Once", "where" => "board", "amount" => 1, "powerfull" => 6],
    ["name" => "Inflation", "description" => "Every player (you too) loses 50% of their coins (rounded down, so 3 becomes 2)", "type" => "Once", "where" => "board", "amount" => 2, "powerfull" => 3],
    ["name" => "Thievery", "description" => "Roll dice, every player you pass gives 1 recourse of their choice", "type" => "Once", "where" => "board", "amount" => 4, "powerfull" => 4],
    ["name" => "Pickpocket", "description" => "Roll dice, every player you pass gives 10% of their coins (rounded up)", "type" => "Once", "where" => "board", "amount" => 2, "powerfull" => 3],
    ["name" => "Coin Magnet XL", "description" => "Every player you pass gives you 5 coins.", "type" => "Active", "where" => "board", "amount" => 2, "powerfull" => 6],
    ["name" => "Coin Magnet", "description" => "Every player you pass gives you 2 coins.", "type" => "Active", "where" => "board", "amount" => 4, "powerfull" => 4],
    ["name" => "Energy potion", "description" => "Give yourself +1 energy.", "type" => "Once", "where" => "Battle", "amount" => 5, "powerfull" => 3],
    ["name" => "Energy explosion", "description" => "Give everyone +10 energy", "type" => "Once", "where" => "Battle", "amount" => 2, "powerfull" => 3],
    ["name" => "Achievement hunter", "description" => "Replace 1 of the goals with a random one, public or your own.", "type" => "Once", "where" => "Anywhere", "amount" => 3, "powerfull" => 5]
];

function getImage($card, $index, $ActionCardConfig) {
    if (!isset($card["image"]) || $card["image"] == "") {
        $card["image"] = $ActionCardConfig["defaultImage"];
        return $card;
    } else {
        return $card;
    }
}

function createCard($card, $index, $ActionCardConfig) {
    $card = calculateId($card, $index + 1, $ActionCardConfig["id"]);
    $card = calculateCost($card, $index, $ActionCardConfig);
    if (!isset($card["amount"]) || $card["amount"] == "") {
        $card["amount"] = $ActionCardConfig["defaultAmount"];
    }
    if (!isset($card["name"]) || $card["name"] == "") {
        $card["name"] = $ActionCardConfig["defaultName"];
    }
    if ((!isset($card["image"]) || $card["image"] == "") && file_exists("assets/images/" . $card["id"] . ".png")) {
        $card["image"] = "assets/images/" . $card["id"] . ".png";
    }
    $card = getImage($card, $index, $ActionCardConfig);
    return $card;
}

function calculateCost($card, $index, $ActionCardConfig) {
    
    $card["shopCost"] = ($ActionCardConfig["costCalculation"]["baseNumber"]-(($card["amount"] - $ActionCardConfig["costCalculation"]["ignoreAmount"])* $ActionCardConfig["costCalculation"]["multiplyCards"]) + ($card["powerfull"] * $ActionCardConfig["costCalculation"]["powerfullMultiplier"]));
    return $card;
    
}

function getCorrectNumber($cards) {
    if (isset($_GET['doubles']) && strtolower($_GET['doubles']) == "false") {
        return $cards;
    } else {
        $correctList = [];
        foreach($cards as $singleCard) {
            for ($i=0; $i < (int)$singleCard["amount"]; $i++) { 
                array_push($correctList, $singleCard);
            }
            if (isset($singleCard["supportExtraAmount"]) && $singleCard["supportExtraAmount"] != "") {
                for ($i=0; $i < (int)$singleCard["supportExtraAmount"]; $i++) { 
                    $tempCard = $singleCard;
                    $tempCard["deck"] = "S";
                    array_push($correctList, $tempCard);
                }
            }
        }
        return $correctList;
    }
    
}

for ($x = 0; $x < count($definedActionCards); $x++) {
    $definedActionCards[$x] = createCard($definedActionCards[$x], $x, $ActionCardConfig);
}

?>