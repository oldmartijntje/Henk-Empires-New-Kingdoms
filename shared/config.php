<?php 

$BattleCardConfig = [
    "CostBalanceMultiplier" => 7,
    "CostAddition" => 5,
    "DeckMaxBalanceLevel" => 2,
    "DeckMaxPowerLevel" => 5,
    "id" => "B%s",
    "defaultImage" => "assets/images/404nf.png",
    "defaultName" => "Dead Link",
    "randomization" => [
        "chooseBetween" => ["onReveal", "onGoing", "special", ""],
        "amount" => 2
    ],
    "defaultAmount" => 1,
];

$GenerationSettings = [
    "defaultCardsAmount" => "all",
    "randomCardsAmount" => 18,
];

$imagesDictionary = [
    "Electric" => "assets/icons/electric.png",
    "Fire" => "assets/icons/fire.png",
    "Water" => "assets/icons/water.png",
    "Wind" => "assets/icons/wind.png",
    "Earth" => "assets/icons/stone.png",
    "404nf" => "assets/icons/404nf.png",
    "Power" => "assets/icons/power.png",
    "Energy" => "assets/icons/energy.png",
    "Henk" => "assets/icons/henk.png",
    "error" => "assets/images/error.png",
    "Green" => "assets/icons/green.png",
    "Mushroom" => "assets/icons/mushroom.png",
    "revolution" => "assets/icons/revolution.png",
    "???" => "assets/icons/questionmarks.png",
];

?>