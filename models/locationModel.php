<?php
$amountOfCards = 0;
require "shared/config.php";
require "raw/locations.php";

function logArrayy($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

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
        $randomCard = generateRandom($possibleLocationOptions, $emptyLocationModel, $LocationConfig['randomization']['chooseBetween'], $LocationConfig['randomization']['amount']);
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
    <div class="statistics header">
        <p class="headerItem margin">Amount of cards: <span title="without duplicate cards"><?php echo count($definedLocations) ?></span></p>
        <?php foreach ($possibleLocationOptions["icons"] as $key => $value) { ?>
        <p class="headerItem margin headerText" onclick="console.log('\'<?php echo $value ?>\'')"><?php echo "amount of '" . returnTextWithImages($value, "Icon", "", true, true) . "' icons cards" ?>: <span title="without duplicate cards"><?php echo array_count_values(array_column($definedLocations, 'icons'))[$value]; ?></span></p>
        <?php } ?>
        <p class="headerItem margin headerText" onclick="console.log('\'<?php echo 'onGoingL' ?>\'')"><?php echo "amount of '" . returnTextWithImages('|onGoingL|', "Icon", "|", true, true) . "' ability cards" ?>: <span title="without duplicate cards"><?php echo count(array_column($definedLocations, 'onGoingL')); ?></span></p>
        <p class="headerItem margin headerText" onclick="console.log('\'<?php echo 'specialL' ?>\'')"><?php echo "amount of '" . returnTextWithImages('|specialL|', "Icon", "|", true, true) . "' ability cards" ?>: <span title="without duplicate cards"><?php echo count(array_count_values(array_column($definedLocations, 'specialL'))); ?></span></p>
        <p class="headerItem margin headerText" onclick="console.log('\'<?php echo 'onRevealL' ?>\'')"><?php echo "amount of '" . returnTextWithImages('|onRevealL|', "Icon", "|", true, true) . "' ability cards" ?>: <span title="without duplicate cards"><?php echo count(array_count_values(array_column($definedLocations, 'onRevealL'))); ?></span></p>
        <p class="headerItem margin headerText" onclick="console.log('\'<?php echo 'onReveal' ?>\'')"><?php echo "amount of '" . returnTextWithImages('onReveal', "Icon", "", true, true) . "' ability cards" ?>: <span title="without duplicate cards"><?php echo count(array_count_values(array_column($definedLocations, 'onReveal'))); ?></span></p>

        
    </div>
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