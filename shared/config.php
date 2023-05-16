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

$ActionCardConfig = [
    "id" => "A%s",
    "defaultImage" => "assets/images/B002.png",
    "defaultAmount" => 1,
    "costCalculation" => [
        "baseNumber" => 10,
        "ignoreAmount" => 1,
        "multiplyCards" => 2,
        "powerfullMultiplier" => 5
    ]

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

$GoalConfig = [
    "id" => "G%s",
    "values" => [
        "goalTypeValueMultiplier" => 4,
        "insertTypeValueMultiplier" => 4,
        "addition" => 2,
    ]
];

$CraftingConfig = [
    "id" => "C%s",
    "defaultAmount" => 1,
    "randomization" => [
        "chooseBetween" => [],
        "amount" => 0
    ],
];

$FicheConfig = [
    "id" => "F%s",
    "defaultAmount" => 8,
];

$MoneyConfig = [
    "id" => "M%s",
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
    "GGCU" => "assets/icons/ggcu.png",
    "DUCKIFY" => "assets/icons/duckbot.png",
    "D6" => "assets/icons/D6.png",
    "D20" => "assets/icons/D20.png",
    "aim" => "assets/icons/aim.png",
    "bow" => "assets/icons/bow.png",
    "money" => "assets/icons/coins.png",
    "Active" => "assets/icons/Active.png",
    "Once" => "assets/icons/Once.png",
    "gem1" => "assets/icons/gem1.png",
    "gem2" => "assets/icons/gem2.png",
    "gem3" => "assets/icons/gem3.png",
    "gem4" => "assets/icons/gem4.png",
    "gem5" => "assets/icons/gem5.png",
    "gem6" => "assets/icons/gem6.png",
    "gemR" => "assets/icons/RandomGem.png",
    "infGlove" => "assets/icons/glove.png",
    "oreRecourse" => "assets/icons/oreRecourse.png",
    "wheatRecourse" => "assets/icons/wheatRecourse.png",
    "woodRecourse" => "assets/icons/woodRecourse.png",
    "woolRecourse" => "assets/icons/woolRecourse.png",
    "stoneRecourse" => "assets/icons/stoneRecourse.png",
    "shroobLang1" => "assets/icons/shroobLanguage1.png",
    "shroobLang2" => "assets/icons/shroobLanguage2.png",
    "shroobLang3" => "assets/icons/shroobLanguage3.png",
    "shroobLang4" => "assets/icons/shroobLanguage4.png",
    "shroobLang5" => "assets/icons/shroobLanguage5.png",
    "shroobLang6" => "assets/icons/shroobLanguage6.png",
    "shroobLang7" => "assets/icons/shroobLanguage7.png",
    "shroobLang8" => "assets/icons/shroobLanguage8.png",
    "shroobLang9" => "assets/icons/shroobLanguage9.png",
    "shroobLang10" => "assets/icons/shroobLanguage10.png",
    "shroobLang11" => "assets/icons/shroobLanguage11.png",
    "shroobLang12" => "assets/icons/shroobLanguage12.png",
    "shroobLang13" => "assets/icons/shroobLanguage13.png",
    "shroobLang14" => "assets/icons/shroobLanguage14.png",
    "shroobLang15" => "assets/icons/shroobLanguage15.png",
    "shroobLang16" => "assets/icons/shroobLanguage16.png",
    "shroobLang17" => "assets/icons/shroobLanguage17.png",
    "shroobLang18" => "assets/icons/shroobLanguage18.png",
    "shroobLang19" => "assets/icons/shroobLanguage19.png",
    "eyesEmoji" => "assets/icons/eyesEmoji.png",
    "emptySpace" => "assets/icons/emptyIcon.png",
    "battleCard" => "assets/icons/UnknownBattleCard.png",
    "VP" => "assets/icons/victoryPoint.png",
];

?>