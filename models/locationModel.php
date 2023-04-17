<?php
$amountOfCards = 0;
require "shared/config.php";
require "raw/locations.php";

if ((isset($_GET['amount']) && (is_numeric($_GET['amount'])) || $_GET['amount'] == "all")) {
    $amountOfCards = $_GET['amount'];
} else if (isset($_GET['type']) && $_GET['type'] == "default") {
    $amountOfCards = $GenerationSettings["defaultCardsAmount"];
} else {
    $amountOfCards = $GenerationSettings["randomCardsAmount"];;   
}
if ($amountOfCards == "all") {
    $amountOfCards = count($definedLocations);
}

if (isset($_GET['type']) && $_GET['type'] == "random") {
    $cards = array();
    for ($j=0; $j < $amountOfCards ; $j++) { 
        $randomCard = generateRandom($possibleLocationOptions, $emptyModel, $LocationConfig['randomization']['chooseBetween'], $LocationConfig['randomization']['amount']);
        $randomCard['balance'] = $randomCard['power'] - $randomCard['energy'];
        $randomCard = createCard($randomCard, $j, $LocationConfig);
        $randomCard['name'] = "Randomized Card";
        $randomCard['image'] = getCorrectImage("error");
        $randomCard['id'] = "B???";
        $randomCard['shopCost'] = "???";
        $randomCard['deck'] = "???";
        array_push($cards, $randomCard);
    }
} else {
    if ($amountOfCards > count($definedLocations)) {
        $amountOfCards = count($definedLocations);
    }
    $cards = $definedLocations;
}

// statistics
if (isset($_GET['stats']) && strtolower($_GET['stats']) == "true") {
    ?>
    
    <?php
}



for ($i=0; $i < $amountOfCards; $i++) { 
    ?>
<link rel="stylesheet" href="styling/style.css">
<div class="card location" onclick="console.log(<?php echo printCard($cards[$i]) ?>)">
    <div class="card-header location-header">
        <div class="name"><?php echo $cards[$i]['name'] ?></div>
        <div class="id"><?php echo $cards[$i]['id'] ?></div>
    </div>
    <div class="card-image">
        <img src="<?php echo $cards[$i]['image'] ?>" alt="<?php echo $cards[$i]['name'] ?>">
        <?php if (isset($cards[$i]['icons']) && $cards[$i]['icons'] != "") { ?>
        <div class="type-icon">
            <?php echo returnTextWithImages($cards[$i]['icons'], "", "", true, true) ?>
        </div>
        <?php } ?>
    </div>
    <div class="card-info">
        <?php if (isset($cards[$i]['description']) && $cards[$i]['description'] != "") { ?>
            <div title="Description" class="description <?php getTextSizeClass($cards[$i])?>">
                <span class="flexSpan">"<?php echo returnTextWithImages($cards[$i]['description'], "inTextImages") ?>"</span>
            </div>
        <?php } if (isset($cards[$i]['onRevealL']) && $cards[$i]['onRevealL'] != "") { ?>
        <div title="On Reveal abillity" class="ability <?php getTextSizeClass($cards[$i])?>">
            <span class="flexSpan">
                <?php echo returnTextWithImages("|onRevealL|", "displayBlock Icon") ?>
                <span><?php echo returnTextWithImages($cards[$i]['onRevealL'], "inTextImages") ?></span>
            </span>
        </div>
        <?php } if (isset($cards[$i]['onGoingL']) && $cards[$i]['onGoingL'] != "") { ?>
        <div title="onGoingL abillity" class="ability <?php getTextSizeClass($cards[$i])?>">
            <span class="flexSpan">
                <?php echo returnTextWithImages("|onGoingL|", "displayBlock Icon") ?>
                <span><?php echo returnTextWithImages($cards[$i]['onGoingL'], "inTextImages") ?></span>
            </span>
        </div>
        <?php } if (isset($cards[$i]['specialL']) && $cards[$i]['specialL'] != "") { ?>
        <div title="specialL abillity" class="ability <?php getTextSizeClass($cards[$i])?>">
            <span class="flexSpan">
                <?php echo returnTextWithImages("|specialL|", "displayBlock Icon") ?>
                <span><?php echo returnTextWithImages($cards[$i]['specialL'], "inTextImages") ?></span>
            </span>
        </div>
        <?php } if (isset($cards[$i]['special']) && $cards[$i]['special'] != "") { ?>
        <div title="special abillity" class="ability <?php getTextSizeClass($cards[$i])?>">
            <span class="flexSpan">
                <?php echo returnTextWithImages("|special|", "displayBlock Icon") ?>
                <span><?php echo returnTextWithImages($cards[$i]['special'], "inTextImages") ?></span>
            </span>
        </div>
        <?php } if (isset($cards[$i]['onReveal']) && $cards[$i]['onReveal'] != "") { ?>
        <div title="onReveal abillity" class="ability <?php getTextSizeClass($cards[$i])?>">
            <span class="flexSpan">
                <?php echo returnTextWithImages("|onReveal|", "displayBlock Icon") ?>
                <span><?php echo returnTextWithImages($cards[$i]['onReveal'], "inTextImages") ?></span>
            </span>
        </div>
        <?php } ?>
    </div>
</div> 




<?php
}
?>