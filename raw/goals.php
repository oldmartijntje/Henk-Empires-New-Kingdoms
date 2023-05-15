<?php 
require "shared/config.php";
require "shared/functions.php";

$typesOfGoals = [
    ["type" => "Have The Fewest |insert|", "value" => 5, "id" => "1"],
    ["type" => "Have The Most |insert|", "value" => 3, "id" => "2"],
    ["type" => "Have No |insert|", "value" => 4, "id" => "3"]
];

$typesOfInserts = [
    ["type" => "BattleCards", "value" => 4, "id" => "a"],
    ["type" => "|money| Money", "value" => 2, "id" => "b"],
    ["type" => "ActionCards", "value" => 3, "id" => "c"],
    ["type" => "Total |Energy| Energy", "value" => 5, "id" => "d"],
    ["type" => "Total |Power| Power", "value" => 5, "id" => "e"],
    ["type" => "|Earth| Type BattleCards", "value" => 3, "id" => "f"],
    ["type" => "|Fire| Type BattleCards", "value" => 3.3, "id" => "g"],
    ["type" => "|Wind| Type BattleCards", "value" => 3, "id" => "h"],
    ["type" => "|Water| Type BattleCards", "value" => 3, "id" => "i"],
    ["type" => "|Electric| Type BattleCards", "value" => 4, "id" => "i"],
    ["type" => "Points", "value" => 10, "id" => "j"],
    ["type" => "|oreRecourse| Recourses", "value" => 3.5, "id" => "k"],
    ["type" => "|wheatRecourse| Recourses", "value" => 3.5, "id" => "l"],
    ["type" => "|woodRecourse| Recourses", "value" => 3.5, "id" => "m"],
    ["type" => "|woolRecourse| Recourses", "value" => 3.5, "id" => "n"],
    ["type" => "|stoneRecourse| Recourses", "value" => 3.5, "id" => "o"],
    ["type" => "Total Recourses", "value" => 4, "id" => "p"],
];

$goalsList = array();

$blacklistedCombinations = [
    "3a", "3d", "3e", "2j", "3j"
];



function replaceInsert($card, $index, $GoalConfig) {
    $card["type"] = str_replace("|insert|", $card["insert"], $card["type"]);
    return $card;
}

function calculatePoints($card, $GoalConfig) {
    $card["value"] = round($card["value"] * $GoalConfig["values"]["goalTypeValueMultiplier"]);
    $card["value"] = $card["value"] + $GoalConfig["values"]["addition"];
    $card["value"] = round($card["value"] + $card["insertValue"] * $GoalConfig["values"]["insertTypeValueMultiplier"]);
    unset($card["insertValue"]);
    return $card;
}

function createCard($typeOfGoal, $index, $GoalConfig, $goalsList, $typesOfInserts) {
    global $blacklistedCombinations;
    for ($y = 0; $y < count($typesOfInserts); $y++) {
        $card = $typeOfGoal;
        $card["insertValue"] = $typesOfInserts[$y]["value"];
        $card = calculatePoints($card, $GoalConfig);
        $card["insert"] = $typesOfInserts[$y]["type"];
        $card["number"] = $card["id"] . $typesOfInserts[$y]["id"];
        if (in_array($card["number"], $blacklistedCombinations)) {
            continue;
        }
        $card = replaceInsert($card, $index, $GoalConfig);
        unset($card["insert"]);
        array_push($goalsList, $card);
    }
    return $goalsList;
}

for ($x = 0; $x < count($typesOfGoals); $x++) {
    $goalsList = createCard($typesOfGoals[$x], $x, $GoalConfig, $goalsList, $typesOfInserts);
}
for ($x = 0; $x < count($goalsList); $x++) {
    $goalsList[$x] = calculateId($goalsList[$x], $x + 1, $GoalConfig["id"]);
}


?>