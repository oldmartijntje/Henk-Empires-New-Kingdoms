<?php
$amountOfCards = 0;
require "shared/config.php";
require "raw/goals.php";

function logArrayy($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

$amountOfCards = count($goalsList);

if (isset($_GET['type']) && $_GET['type'] == "random") {
    $cards = array();
    for ($j=0; $j < $amountOfCards ; $j++) { 
        $randomCard = generateRandom($possiblegoalOptions, $emptygoalModel, $goalConfig['randomization']['chooseBetween'], $goalConfig['randomization']['amount']);
        $randomCard = createCard($randomCard, $j, $goalConfig);
        $randomCard['name'] = "Randomized Card";
        $randomCard['image'] = getCorrectImage("error");
        $randomCard['id'] = "B???";
        $randomCard['shopCost'] = "???";
        $randomCard['deck'] = "???";
        array_push($cards, $randomCard);
    }
} else {
    if ($amountOfCards > count($goalsList)) {
        $amountOfCards = count($goalsList);
    }
    $cards = $goalsList;
}

// statistics
if (isset($_GET['stats']) && strtolower($_GET['stats']) == "true") {
    ?>
    <div class="statistics header">
        <p class="headerItem margin">Amount of goals: <span title="without duplicate cards"><?php echo count($goalsList) ?></span></p>
    </div>
    <?php
}



for ($i=0; $i < $amountOfCards; $i++) { 
    ?>
<link rel="stylesheet" href="styling/goals.css">
<div class="card goal" onclick="console.log(<?php echo printCard($cards[$i]) ?>)">
    <div class="card-header goal-header">
        <div class="name"><?php echo $cards[$i]['value'] ?> Points</div>
        <div class="id"><?php echo $cards[$i]['id'] ?></div>
    </div>
    <div class="card-info">

        <div title="Description" class="description" >
            <span>"<?php echo returnTextWithImages($cards[$i]['type'], "inTextImages") ?>"</span>
        </div>

    </div>
</div> 




<?php
}
?>