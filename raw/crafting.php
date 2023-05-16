<?php 
require "shared/config.php";
require "shared/functions.php";

$definedCraftings = [
    // B001- B010
    ["costs" => "|woolRecourse||woolRecourse||woodRecourse|", "reward" => "10 x |money|", "amount"=> 5],
    ["costs" => "|wheatRecourse||wheatRecourse||oreRecourse||oreRecourse||oreRecourse|", "reward" => "1 x |battleCard|", "amount"=> 3],
    ["costs" => "|wheatRecourse||oreRecourse||woodRecourse||stoneRecourse||woolRecourse|", "reward" => "1 x |battleCard|", "amount"=> 3],
    ["costs" => "|gem5||woodRecourse||stoneRecourse|", "reward" => "1 x |battleCard|", "amount"=> 3],
    ["costs" => "|wheatRecourse||wheatRecourse||oreRecourse|", "reward" => "11 x |money|", "amount"=> 4],
    ["costs" => "|gem1||wheatRecourse||oreRecourse|", "reward" => "19 x |money|", "amount"=> 4],
    ["costs" => "|gem2||woodRecourse||stoneRecourse|", "reward" => "18 x |money|", "amount"=> 4],
    ["costs" => "|woodRecourse| 10 x |money|", "reward" => "2 x |VP|", "amount"=> 3],
    ["costs" => "|gem3||oreRecourse||stoneRecourse|", "reward" => "12 x |money| <br>3 x |VP|", "amount"=> 4],
    ["costs" => "|woolRecourse||gem4||wheatRecourse||woolRecourse|", "reward" => "1 x |battleCard| <br>3 x |VP|", "amount"=> 5],
    ["costs" => "|wheatRecourse||wheatRecourse||wheatRecourse||stoneRecourse||woolRecourse|", "reward" => "3 x |VP|", "amount"=> 6],
    ["costs" => "|wheatRecourse||wheatRecourse||wheatRecourse|", "reward" => "2 x |VP|", "amount"=> 4],
    ["costs" => "|wheatRecourse||oreRecourse||oreRecourse||oreRecourse||woolRecourse|", "reward" => "3 x |VP|", "amount"=> 5],
    ["costs" => "|wheatRecourse||oreRecourse||oreRecourse||oreRecourse||gemR|", "reward" => "6 x |VP|", "amount"=> 4],
    ["costs" => "|wheatRecourse||oreRecourse||oreRecourse||gem6||gemR|", "reward" => "9 x |VP|", "amount"=> 4],
    ["costs" => "|oreRecourse||wheatRecourse||wheatRecourse||stoneRecourse||woolRecourse|", "reward" => "3 x |VP|", "amount"=> 5],
    ["costs" => "|woodRecourse||wheatRecourse||oreRecourse||oreRecourse||oreRecourse||stoneRecourse|", "reward" => "4 x |VP|", "amount"=> 3],
    ["costs" => "|woodRecourse||woodRecourse||wheatRecourse||oreRecourse||oreRecourse||oreRecourse||woolRecourse|", "reward" => "5 x |VP|", "amount"=> 4],
    ["costs" => "|woodRecourse||oreRecourse||wheatRecourse||wheatRecourse||stoneRecourse||woolRecourse|", "reward" => "3 x |VP|", "amount"=> 3],
    ["costs" => "|wheatRecourse||oreRecourse||oreRecourse||oreRecourse||woodRecourse||stoneRecourse|", "reward" => "3 x |VP|", "amount"=> 3],
    ["costs" => "|wheatRecourse||oreRecourse||oreRecourse||oreRecourse||woodRecourse||woodRecourse||stoneRecourse||woolRecourse||woolRecourse|", "reward" => "6 x |VP|", "amount"=> 4],
    ["costs" => "|gem1||gem2||gem3||gem4||gem5||gem6|", "reward" => "|infGlove|", "amount"=> 1, 'bonusText' => "Trading gives +1 extra of everything (keep this card)"],
    
];

$emptyCraftingModel = [
    "costs" => 0,
    "reward" => 0
];

$blacklistedCraftingKeys = ["id", "amount"];

$possibleCraftingOptions = [
    "costs" => [],
    "reward" => []
];

function getImage($card, $index, $CraftingConfig) {
    if (!isset($card["image"]) || $card["image"] == "") {
        $card["image"] = $CraftingConfig["defaultImage"];
        return $card;
    } else {
        return $card;
    }
}

function createCard($card, $index, $CraftingConfig) {
    $card = calculateId($card, $index + 1, $CraftingConfig["id"]);
    if (!isset($card["amount"]) || $card["amount"] == "") {
        $card["amount"] = $CraftingConfig["defaultAmount"];
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

for ($x = 0; $x < count($definedCraftings); $x++) {
    $definedCraftings[$x] = createCard($definedCraftings[$x], $x, $CraftingConfig);
}

$possibleCraftingOptions = getAllOptions($definedCraftings, $blacklistedCraftingKeys, $possibleCraftingOptions);

?>