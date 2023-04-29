<?php 
require "shared/config.php";
require "shared/functions.php";

$definedFiches = [
    // power
    ["type" => "Power", "text" => "0", "amount" => "8", "color" => ""],
    ["type" => "Power", "text" => "-1x", "amount" => "32", "color" => ""],
    ["type" => "Power", "text" => "2x", "amount" => "16", "color" => ""],
    ["type" => "Power", "text" => "4x", "amount" => "8", "color" => ""],
    ["type" => "Power", "text" => "5x", "amount" => "8", "color" => ""],
    ["type" => "Power", "text" => "10x", "amount" => "8", "color" => ""],
    ["type" => "Power", "text" => "-1", "amount" => "16", "color" => ""],
    ["type" => "Power", "text" => "+1", "amount" => "32", "color" => ""],
    ["type" => "Power", "text" => "+2", "amount" => "32", "color" => ""],
    ["type" => "Power", "text" => "+3", "amount" => "16", "color" => ""],
    ["type" => "Power", "text" => "+5", "amount" => "16", "color" => ""],
    ["type" => "Power", "text" => "+7", "amount" => "8", "color" => ""],
    ["type" => "Power", "text" => "+10", "amount" => "8", "color" => ""],
    ["type" => "Power", "text" => "+13", "amount" => "8", "color" => ""],
    ["type" => "Power", "text" => "+15", "amount" => "8", "color" => ""],
    ["type" => "Power", "text" => "+25", "amount" => "8", "color" => ""],
    // energy
    ["type" => "Energy", "text" => "0", "amount" => "4", "color" => ""],
    ["type" => "Energy", "text" => "-1x", "amount" => "4", "color" => ""],
    ["type" => "Energy", "text" => "2x", "amount" => "4", "color" => ""],
    ["type" => "Energy", "text" => "4x", "amount" => "4", "color" => ""],
    ["type" => "Energy", "text" => "5x", "amount" => "4", "color" => ""],
    ["type" => "Energy", "text" => "10x", "amount" => "4", "color" => ""],
    ["type" => "Energy", "text" => "-1", "amount" => "4", "color" => ""],
    ["type" => "Energy", "text" => "+1", "amount" => "4", "color" => ""],
    ["type" => "Energy", "text" => "+2", "amount" => "4", "color" => ""],
    ["type" => "Energy", "text" => "+3", "amount" => "4", "color" => ""],
    ["type" => "Energy", "text" => "+5", "amount" => "4", "color" => ""],
    ["type" => "Energy", "text" => "+7", "amount" => "4", "color" => ""],
    ["type" => "Energy", "text" => "+10", "amount" => "4", "color" => ""],
    ["type" => "Energy", "text" => "+13", "amount" => "4", "color" => ""],
    ["type" => "Energy", "text" => "+15", "amount" => "4", "color" => ""],
    ["type" => "Energy", "text" => "+25", "amount" => "4", "color" => ""],
    // effects
    ["type" => "onGoing", "text" => "x2", "amount" => "8", "color" => ""],
    ["type" => "onReveal", "text" => "x2", "amount" => "8", "color" => ""],
    ["type" => "special", "text" => "x2", "amount" => "4", "color" => ""],
    ["type" => "onGoingL", "text" => "x2", "amount" => "4", "color" => ""],
    // pointer
    ["type" => "aim", "text" => "", "amount" => "32", "color" => "YES"],
    ["type" => "bow", "text" => "", "amount" => "32", "color" => "YES"],
];

$colorArray = ["#ff7d7d", "#ffa67d", "#ffcf7d", "#fff47d", "#cfff7d", "#a4ff7d", "#7dff9d", "#7dffcb", "#7dfff8", "#7dd1ff", "#7dafff", "#7d86ff", "#977dff", "#be7dff", "#e57dff", "#ff7dee", "#ff7dc7", "#ff7d97"];

function createCard($card, $index, $FicheConfig) {
    $card = calculateId($card, $index + 1, $FicheConfig["id"]);
    if (!isset($card["amount"]) || $card["amount"] == "") {
        $card["amount"] = $FicheConfig["defaultAmount"];
    }
    return $card;
}

function getCorrectNumber($cards) {
    global $colorArray;
    if (isset($_GET['doubles']) && strtolower($_GET['doubles']) == "false") {
        return $cards;
    } else {
        $correctList = [];
        foreach($cards as $singleCard) {
            for ($i=0; $i < (int)$singleCard["amount"]; $i++) { 
                array_push($correctList, $singleCard);
                if ($singleCard["text"] == "") {
                    $id = (string)$i + 1;
                    $correctList[count($correctList) - 1]["text"] = "Nr " . $id;
                    $correctList[count($correctList) - 1]["id"] = $correctList[count($correctList) - 1]["id"] . "." . $id;
                }
                if ($singleCard["color"] == "YES") {
                    $correctList[count($correctList) - 1]["color"] = $colorArray[fmod($i, count($colorArray))];
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