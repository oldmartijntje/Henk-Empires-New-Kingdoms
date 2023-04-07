<?php
$amountOfCards = 0;
require "shared/config.php";
require "raw/battleCards.php";

if ((isset($_GET['amount']) && (is_numeric($_GET['amount'])) || $_GET['amount'] == "all")) {
    $amountOfCards = $_GET['amount'];
} else if (isset($_GET['type']) && $_GET['type'] == "default") {
    $amountOfCards = $GenerationSettings["defaultCardsAmount"];
} else {
    $amountOfCards = $GenerationSettings["randomCardsAmount"];;   
}
if ($amountOfCards == "all") {
    $amountOfCards = count(getCorrectNumber($definedBattleCards));
}

if (isset($_GET['type']) && $_GET['type'] == "random") {
    $cards = array();
    for ($j=0; $j < $amountOfCards ; $j++) { 
        $randomCard = generateRandom($possibleOptions, $emptyModel, $BattleCardConfig['randomization']['chooseBetween'], $BattleCardConfig['randomization']['amount']);
        $randomCard['balance'] = $randomCard['power'] - $randomCard['energy'];
        $randomCard = createCard($randomCard, $j, $BattleCardConfig);
        $randomCard['name'] = "Randomized Card";
        $randomCard['image'] = getCorrectImage("error");
        $randomCard['id'] = "B???";
        $randomCard['shopCost'] = "???";
        $randomCard['deck'] = "???";
        array_push($cards, $randomCard);
    }
} else {
    if ($amountOfCards > count(getCorrectNumber($definedBattleCards))) {
        $amountOfCards = count(getCorrectNumber($definedBattleCards));
    }
    $cards = getCorrectNumber($definedBattleCards);
}

// statistics
if (isset($_GET['stats']) && strtolower($_GET['stats']) == "true") {
    ?>
    <div class="statistics header">
        <p class="headerItem margin">Amount of cards: <span title="with duplicate cards"><?php echo $amountOfCards ?></span>, <span title="without duplicate cards"><?php echo count($definedBattleCards) ?></span></p>
        <?php foreach ($possibleOptions["type"] as $key => $value) { ?>
        <p class="headerItem margin headerText" onclick="console.log('\'<?php echo $value ?>\'')"><?php echo "amount of '" . returnTextWithImages($value, "Icon", "", true, true) . "' type cards" ?>: <span title="with duplicate cards"><?php echo array_count_values(array_column(getCorrectNumber($definedBattleCards), 'type'))[$value]; ?></span>, <span title="without duplicate cards"><?php echo array_count_values(array_column($definedBattleCards, 'type'))[$value]; ?></span></p>
        <?php } ?>
        <?php foreach ($possibleOptions["series"] as $key => $value) { ?>
        <p class="headerItem margin headerText" onclick="console.log('\'<?php echo $value ?>\'')"><?php echo "amount of '" . returnTextWithImages($value, "Icon", "", true, true) . "' series cards" ?>: <span title="with duplicate cards"><?php echo array_count_values(array_column(getCorrectNumber($definedBattleCards), 'series'))[$value]; ?></span>, <span title="without duplicate cards"><?php echo array_count_values(array_column($definedBattleCards, 'series'))[$value]; ?></span></p>
        <?php } ?>
        <?php foreach ($possibleOptions["energy"] as $key => $value) { ?>
            <div class="headerItem margin">
                <p class="headerText">amount of'"</p>
                <div class="energy iconWithNumber">
                    <img src="<?php echo getCorrectImage('Energy') ?>" alt="Energy Icon BackgroundIcon">
                    <span class="IconNumber"><?php echo $value ?></span>
                </div>
                <p class="headerText">"' energy cards: <span title="with duplicate cards"><?php echo array_count_values(array_column(getCorrectNumber($definedBattleCards), 'energy'))[$value]; ?></span>, <span title="without duplicate cards"><?php echo array_count_values(array_column($definedBattleCards, 'energy'))[$value]; ?></span></p>
            </div>
        <?php } ?>
        <?php foreach ($possibleOptions["power"] as $key => $value) { ?>
            <div class="headerItem margin">
                <p class="headerText">amount of'"</p>
                <div class="power iconWithNumber">
                    <img src="<?php echo getCorrectImage('Power') ?>" alt="Power Icon BackgroundIcon">
                    <span class="IconNumber"><?php echo $value ?></span>
                </div>
                <p class="headerText">"' power cards: <span title="with duplicate cards"><?php echo array_count_values(array_column(getCorrectNumber($definedBattleCards), 'power'))[$value]; ?></span>, <span title="without duplicate cards"><?php echo array_count_values(array_column($definedBattleCards, 'power'))[$value]; ?></span></p>
            </div>
        <?php } ?>
    </div>
    <?php
}



for ($i=0; $i < $amountOfCards; $i++) { 
    ?>

<div class="card" onclick="console.log(<?php echo printCard($cards[$i]) ?>)">
    <div class="card-header">
        <div class="name"><?php echo $cards[$i]['name'] ?></div>
        <div class="id"><?php echo $cards[$i]['id'] ?></div>
    </div>
    <div class="card-image">
        <img src="<?php echo $cards[$i]['image'] ?>" alt="<?php echo $cards[$i]['name'] ?>">
        <?php if (isset($cards[$i]['series']) && $cards[$i]['series'] != "") { ?>
        <div class="series-icon">
            <?php echo returnTextWithImages($cards[$i]['series'], "", "", true, true) ?>
        </div>
        <?php } ?>
        <div class="type-icon">
            <?php echo returnTextWithImages($cards[$i]['type'], "", "", true, true) ?>
        </div>
    </div>
    <div class="card-info">
        <div class="IconsDisplayBox">
            <div class="power iconWithNumber">
                <img src="<?php echo getCorrectImage('Power') ?>" alt="Power Icon BackgroundIcon">
                <span class="IconNumber"><?php echo $cards[$i]['power'] ?></span>
            </div>
            <div class="energy iconWithNumber">
                <img src="<?php echo getCorrectImage('Energy') ?>" alt="Energy Icon BackgroundIcon">
                <span class="IconNumber"><?php echo $cards[$i]['energy'] ?></span>
            </div>
        </div>
        <?php if (isset($cards[$i]['description']) && $cards[$i]['description'] != "") { ?>
            <div title="Description" class="description <?php getTextSizeClass($cards[$i])?>">
                <span class="flexSpan">"<?php echo returnTextWithImages($cards[$i]['description'], "inTextImages") ?>"</span>
            </div>
        <?php } if (isset($cards[$i]['onReveal']) && $cards[$i]['onReveal'] != "") { ?>
        <div title="On Reveal abillity" class="ability <?php getTextSizeClass($cards[$i])?>">
            <span class="flexSpan">
                <?php echo returnTextWithImages("|onReveal|", "displayBlock Icon") ?>
                <span><?php echo returnTextWithImages($cards[$i]['onReveal'], "inTextImages") ?></span>
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
    <div class="card-footer <?php if ($cards[$i]['deck']=='S') {echo 'supportDeckFooterColor';}?>">
        <div class="deck">Deck <?php echo $cards[$i]['deck'] ?></div>
        <div class="shop-cost">Shop Cost: <?php echo $cards[$i]['shopCost'] ?></div>
    </div>
</div> 




<?php
}
?>