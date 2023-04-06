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
    if ($amountOfCards > count($definedBattleCards)) {
        $amountOfCards = count(getCorrectNumber($definedBattleCards));
    }
    $cards = getCorrectNumber($definedBattleCards);
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