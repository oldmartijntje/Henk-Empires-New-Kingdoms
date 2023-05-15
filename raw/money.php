<?php 
require "shared/config.php";
require "shared/functions.php";

$definedMoney = [
    ["amountToShowOfMoney" => "1", "amountToShow" => "20"],
    ["amountToShowOfMoney" => "2", "amountToShow" => "45"],
    ["amountToShowOfMoney" => "4", "amountToShow" => "20"],
    ["amountToShowOfMoney" => "8", "amountToShow" => "15"],
    ["amountToShowOfMoney" => "16", "amountToShow" => "10"],
    ["amountToShowOfMoney" => "32", "amountToShow" => "10"],
    ["amountToShowOfMoney" => "64", "amountToShow" => "10"],
    ["amountToShowOfMoney" => "128", "amountToShow" => "7"],
    ["amountToShowOfMoney" => "256", "amountToShow" => "7"],
    ["amountToShowOfMoney" => "5", "amountToShow" => "35"],
    ["amountToShowOfMoney" => "10", "amountToShow" => "30"],
    ["amountToShowOfMoney" => "20", "amountToShow" => "20"],
    ["amountToShowOfMoney" => "100", "amountToShow" => "10"],
    ["amountToShowOfMoney" => "500", "amountToShow" => "1"]
];

function createCard($card, $index, $FicheConfig) {
    $card = calculateId($card, $index + 1, $FicheConfig["id"]);
    if (!isset($card["amountToShow"]) || $card["amountToShow"] == "") {
        $card["amountToShow"] = $FicheConfig["defaultAmount"];
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
            for ($i=0; $i < (int)$singleCard["amountToShow"]; $i++) { 
                array_push($correctList, $singleCard);
            }
        }
        return $correctList;
    }
    
}

for ($x = 0; $x < count($definedMoney); $x++) {
    $definedMoney[$x] = createCard($definedMoney[$x], $x, $MoneyConfig);
}

?>