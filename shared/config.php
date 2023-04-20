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

$LocationConfig = [
    "id" => "L%s",
    "defaultImage" => "assets/images/404nfL.png",
    "defaultName" => "Weg gon loesoe",
    "randomization" => [
        "chooseBetween" => ["onRevealL", "onReveal", "onGoingL", "specialL", ""],
        "amount" => 2
    ],
];

$FicheConfig = [
    "id" => "F%s",
    "defaultAmount" => 8,
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
    "404nfL" => "assets/icons/404nfL.png",
    "Power" => "assets/icons/power.png",
    "Energy" => "assets/icons/energy.png",
    "Henk" => "assets/icons/henk.png",
    "error" => "assets/images/error.png",
    "Green" => "assets/icons/green.png",
    "Mushroom" => "assets/icons/mushroom.png",
    "revolution" => "assets/icons/revolution.png",
    "???" => "assets/icons/questionmarks.png",
    "blockgame" => "assets/icons/mijnkjweft.png",
    "onRevealL" => "assets/icons/onrevealLocation.png",
    "onReveal" => "assets/icons/onreveal.png",
    "specialL" => "assets/icons/specialLocation.png",
    "special" => "assets/icons/special.png",
    "onGoingL" => "assets/icons/ongoingLocation.png",
    "onGoing" => "assets/icons/ongoing.png",
    "brick" => "assets/icons/brick.png",
    "Fun" => "assets/icons/partypopper.png",
    "GGCU" => "assets/icons/duckbot.png",
    "D6" => "assets/icons/D6.png",
    "D20" => "assets/icons/D20.png",
];

?>