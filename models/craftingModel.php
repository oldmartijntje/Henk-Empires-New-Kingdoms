<link rel="stylesheet" href="styling/crafting.css">
<?php
$amountOfCards = 0;
require "shared/config.php";
require "raw/crafting.php";

if ((isset($_GET['amount']) && (is_numeric($_GET['amount'])) || $_GET['amount'] == "all")) {
    $amountOfCards = $_GET['amount'];
} else if (isset($_GET['type']) && $_GET['type'] == "default") {
    $amountOfCards = $GenerationSettings["defaultCardsAmount"];
} else {
    $amountOfCards = $GenerationSettings["randomCardsAmount"];;   
}
if ($amountOfCards == "all") {
    $amountOfCards = count(getCorrectNumber($definedCraftings));
}

if (isset($_GET['type']) && $_GET['type'] == "random") {
    $cards = array();
    for ($j=0; $j < $amountOfCards ; $j++) { 
        $randomCard = generateRandom($possibleCraftingOptions, $emptyCraftingModel, $CraftingConfig['randomization']['chooseBetween'], $CraftingConfig['randomization']['amount']);
        $randomCard = createCard($randomCard, $j, $CraftingConfig);
        $randomCard['id'] = "C???";
        array_push($cards, $randomCard);
    }
} else {
    if ($amountOfCards > count(getCorrectNumber($definedCraftings))) {
        $amountOfCards = count(getCorrectNumber($definedCraftings));
    }
    $cards = getCorrectNumber($definedCraftings);
}

// statistics
if (isset($_GET['stats']) && strtolower($_GET['stats']) == "true") {
    ?>
    <div class="statistics header">
        <p class="headerItem margin">Amount of cards: <span title="with duplicate cards"><?php echo $amountOfCards ?></span>, <span title="without duplicate cards"><?php echo count($definedCraftings) ?></span></p>
        <?php foreach ($possibleCraftingOptions["type"] as $key => $value) { ?>
        <p class="headerItem margin headerText" onclick="console.log('\'<?php echo $value ?>\'')"><?php echo "amount of '" . returnTextWithImages($value, "Icon", "", true, true) . "' type cards" ?>: <span title="with duplicate cards"><?php echo array_count_values(array_column(getCorrectNumber($definedCraftings), 'type'))[$value]; ?></span>, <span title="without duplicate cards"><?php echo array_count_values(array_column($definedCraftings, 'type'))[$value]; ?></span></p>
        <?php } ?>
        <?php foreach ($possibleCraftingOptions["series"] as $key => $value) { ?>
        <p class="headerItem margin headerText" onclick="console.log('\'<?php echo $value ?>\'')"><?php echo "amount of '" . returnTextWithImages($value, "Icon", "", true, true) . "' series cards" ?>: <span title="with duplicate cards"><?php echo array_count_values(array_column(getCorrectNumber($definedCraftings), 'series'))[$value]; ?></span>, <span title="without duplicate cards"><?php echo array_count_values(array_column($definedCraftings, 'series'))[$value]; ?></span></p>
        <?php } ?>
        <?php foreach ($possibleCraftingOptions["energy"] as $key => $value) { ?>
            <div class="headerItem margin">
                <p class="headerText">amount of'"</p>
                <div class="energy iconWithNumber">
                    <img src="<?php echo getCorrectImage('Energy') ?>" alt="Energy Icon BackgroundIcon">
                    <span class="IconNumber"><?php echo $value ?></span>
                </div>
                <p class="headerText">"' energy cards: <span title="with duplicate cards"><?php echo array_count_values(array_column(getCorrectNumber($definedCraftings), 'energy'))[$value]; ?></span>, <span title="without duplicate cards"><?php echo array_count_values(array_column($definedCraftings, 'energy'))[$value]; ?></span></p>
            </div>
        <?php } ?>
        <?php foreach ($possibleCraftingOptions["power"] as $key => $value) { ?>
            <div class="headerItem margin">
                <p class="headerText">amount of'"</p>
                <div class="power iconWithNumber">
                    <img src="<?php echo getCorrectImage('Power') ?>" alt="Power Icon BackgroundIcon">
                    <span class="IconNumber"><?php echo $value ?></span>
                </div>
                <p class="headerText">"' power cards: <span title="with duplicate cards"><?php echo array_count_values(array_column(getCorrectNumber($definedCraftings), 'power'))[$value]; ?></span>, <span title="without duplicate cards"><?php echo array_count_values(array_column($definedCraftings, 'power'))[$value]; ?></span></p>
            </div>
        <?php } ?>
        <?php foreach ($possibleCraftingOptions["shopCost"] as $key => $value) { ?>
        <p class="headerItem margin headerText" onclick="console.log('\'<?php echo $value ?>\'')"><?php echo "amount of '" . $value . "' shopCost cards" ?>: <span title="with duplicate cards"><?php echo array_count_values(array_column(getCorrectNumber($definedCraftings), 'shopCost'))[$value]; ?></span>, <span title="without duplicate cards"><?php echo array_count_values(array_column($definedCraftings, 'shopCost'))[$value]; ?></span></p>
        <?php } ?>
        <?php foreach ($possibleCraftingOptions["deck"] as $key => $value) { ?>
        <p class="headerItem margin headerText" onclick="console.log('\'<?php echo $value ?>\'')"><?php echo "amount of '" . $value . "' deck cards" ?>: <span title="with duplicate cards"><?php echo array_count_values(array_column(getCorrectNumber($definedCraftings), 'deck'))[$value]; ?></span>, <span title="without duplicate cards"><?php echo array_count_values(array_column($definedCraftings, 'deck'))[$value]; ?></span></p>
        <?php } ?>
    </div>
    <?php
}



for ($i=0; $i < $amountOfCards; $i++) { 
    ?>
<div class="card" onclick="console.log(<?php echo printCard($cards[$i]) ?>)">
    <div class="card-header">
        <div class="id"><?php echo $cards[$i]['id'] ?></div>
    </div>
    <div class="reward card-info">
        <h1 class="reward"><?php echo returnTextWithImages($cards[$i]['reward'], "inHeaderImages") ?></h1>
    </div>
    <div class="cost-info">
        <div title="Description" class="description <?php getTextSizeClass($cards[$i])?>">
            <span class="flexSpan">For the cost of:</span>
        </div>
        <div title="Description" class="description <?php getTextSizeClass($cards[$i])?>">
            <span class="flexSpan"><?php echo returnTextWithImages($cards[$i]['costs'], "costImages") ?></span>
        </div>
        <?php if (isset($cards[$i]['bonusText']) && $cards[$i]['bonusText'] != "") { ?>
        <div title="On Reveal abillity" class="ability <?php getTextSizeClass($cards[$i])?>">
            <span class="flexSpan">
                <span><?php echo returnTextWithImages($cards[$i]['bonusText'], "inTextImages") ?></span>
            </span>
        </div>
        <?php } if (isset($cards[$i]['onGoing']) && $cards[$i]['onGoing'] != "") { ?>
        <div title="Ongoing abillity" class="ability <?php getTextSizeClass($cards[$i])?>">
            <span class="flexSpan">
                <?php echo returnTextWithImages("|onGoing|", "displayBlock Icon") ?>
                <span><?php echo returnTextWithImages($cards[$i]['onGoing'], "inTextImages") ?></span>
            </span>
        </div>
        <?php } if (isset($cards[$i]['special']) && $cards[$i]['special'] != "") { ?>
        <div title="Special abillity" class="ability <?php getTextSizeClass($cards[$i])?>">
            <span class="flexSpan">
                <?php echo returnTextWithImages("|special|", "displayBlock Icon") ?>
                <span><?php echo returnTextWithImages($cards[$i]['special'], "inTextImages") ?></span>
            </span>
        </div>
        <?php } ?>
    </div>
</div> 




<?php
}
?>