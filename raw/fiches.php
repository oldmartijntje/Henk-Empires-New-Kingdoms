<?php 
require "shared/config.php";
require "shared/functions.php";

$definedFiches = [
    // power
    ["type" => "Power", "text" => "0", "amount" => "8", "class" => ""],
    ["type" => "Power", "text" => "-1x", "amount" => "32", "class" => ""],
    ["type" => "Power", "text" => "2x", "amount" => "16", "class" => ""],
    ["type" => "Power", "text" => "4x", "amount" => "8", "class" => ""],
    ["type" => "Power", "text" => "5x", "amount" => "8", "class" => ""],
    ["type" => "Power", "text" => "10x", "amount" => "8", "class" => ""],
    ["type" => "Power", "text" => "-1", "amount" => "16", "class" => ""],
    ["type" => "Power", "text" => "+1", "amount" => "32", "class" => ""],
    ["type" => "Power", "text" => "+2", "amount" => "32", "class" => ""],
    ["type" => "Power", "text" => "+3", "amount" => "16", "class" => ""],
    ["type" => "Power", "text" => "+5", "amount" => "16", "class" => ""],
    ["type" => "Power", "text" => "+7", "amount" => "8", "class" => ""],
    ["type" => "Power", "text" => "+10", "amount" => "8", "class" => ""],
    ["type" => "Power", "text" => "+13", "amount" => "8", "class" => ""],
    ["type" => "Power", "text" => "+15", "amount" => "8", "class" => ""],
    ["type" => "Power", "text" => "+25", "amount" => "8", "class" => ""],
    // energy
    ["type" => "Energy", "text" => "0", "amount" => "4", "class" => ""],
    ["type" => "Energy", "text" => "-1x", "amount" => "4", "class" => ""],
    ["type" => "Energy", "text" => "2x", "amount" => "4", "class" => ""],
    ["type" => "Energy", "text" => "4x", "amount" => "4", "class" => ""],
    ["type" => "Energy", "text" => "5x", "amount" => "4", "class" => ""],
    ["type" => "Energy", "text" => "10x", "amount" => "4", "class" => ""],
    ["type" => "Energy", "text" => "-1", "amount" => "4", "class" => ""],
    ["type" => "Energy", "text" => "+1", "amount" => "4", "class" => ""],
    ["type" => "Energy", "text" => "+2", "amount" => "4", "class" => ""],
    ["type" => "Energy", "text" => "+3", "amount" => "4", "class" => ""],
    ["type" => "Energy", "text" => "+5", "amount" => "4", "class" => ""],
    ["type" => "Energy", "text" => "+7", "amount" => "4", "class" => ""],
    ["type" => "Energy", "text" => "+10", "amount" => "4", "class" => ""],
    ["type" => "Energy", "text" => "+13", "amount" => "4", "class" => ""],
    ["type" => "Energy", "text" => "+15", "amount" => "4", "class" => ""],
    ["type" => "Energy", "text" => "+25", "amount" => "4", "class" => ""],
    // effects
    ["type" => "onGoing", "text" => "x2", "amount" => "8", "class" => ""],
    ["type" => "onReveal", "text" => "x2", "amount" => "8", "class" => ""],
    ["type" => "special", "text" => "x2", "amount" => "4", "class" => ""],
    ["type" => "onGoingL", "text" => "x2", "amount" => "8", "class" => ""],
    ["type" => "onRevealL", "text" => "x2", "amount" => "8", "class" => ""],
];

function createCard($card, $index, $FicheConfig) {
    $card = calculateId($card, $index + 1, $FicheConfig["id"]);
    if (!isset($card["amount"]) || $card["amount"] == "") {
        $card["amount"] = $FicheConfig["defaultAmount"];
    }
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

for ($x = 0; $x < count($definedFiches); $x++) {
    $definedFiches[$x] = createCard($definedFiches[$x], $x, $FicheConfig);
}

?>