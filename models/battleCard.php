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
    $amountOfCards = count($definedBattleCards);
}

if (isset($_GET['type']) && $_GET['type'] == "random") {
    $cards = array();
    for ($j=0; $j < $amountOfCards ; $j++) { 
        $randomCard = generateRandom($possibleOptions, $emptyModel, ["onReveal", "onGoing", "special"], 1);
        $randomCard = createCard($randomCard, $j, $BattleCardConfig);
        $randomCard['name'] = "Randomized Card";
        $randomCard['image'] = getCorrectImage("error");
        array_push($cards, $randomCard);
    }
} else {
    if ($amountOfCards > count($definedBattleCards)) {
        $amountOfCards = count($definedBattleCards);
    }
    $cards = $definedBattleCards;
}
for ($i=0; $i < $amountOfCards; $i++) { 
    ?>

<div class="card">
    <div class="card-header">
        <div class="name"><?php echo $cards[$i]['name'] ?></div>
        <div class="id"><?php echo $cards[$i]['id'] ?></div>
    </div>
    <div class="card-image">
        <img src="<?php echo $cards[$i]['image'] ?>" alt="<?php echo $cards[$i]['name'] ?>">
        <?php if (isset($cards[$i]['series']) && $cards[$i]['series'] != "") { ?>
        <div class="series-icon">
            <img src="<?php echo getCorrectImage($cards[$i]['series']) ?>" alt="Henk Series Icon">
        </div>
        <?php } ?>
        <div class="type-icon">
            <img src="<?php echo getCorrectImage($cards[$i]['type']) ?>" alt="<?php echo $cards[$i]['type'] ?> Type Icon">
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
            <div class="description">
                <span>"<?php echo $cards[$i]['description'] ?>"</span>
            </div>
        <?php } if (isset($cards[$i]['onReveal']) && $cards[$i]['onReveal'] != "") { ?>
        <div class="ability">
            <span>
                <img class="Icon" src="assets/icons/onreveal.png" alt="On Reveal Ability Icon">
                <?php echo $cards[$i]['onReveal'] ?>
            </span>
        </div>
        <?php } if (isset($cards[$i]['onGoing']) && $cards[$i]['onGoing'] != "") { ?>
        <div class="ability">
            <span>
                <img class="Icon" src="assets/icons/ongoing.png" alt="Ongoing Ability Icon">
                <?php echo $cards[$i]['onGoing'] ?>
            </span>
        </div>
        <?php } if (isset($cards[$i]['special']) && $cards[$i]['special'] != "") { ?>
        <div class="ability">
            <span>
                <img class="Icon" src="assets/icons/special.png" alt="Special Ability Icon">
                <?php echo $cards[$i]['special'] ?>
            </span>
        </div>
        <?php } ?>
    </div>
    <div class="card-footer">
        <div class="deck">Deck <?php echo $cards[$i]['deck'] ?></div>
        <div class="shop-cost">Shop Cost: <?php echo $cards[$i]['shopCost'] ?></div>
    </div>
</div> 




<?php
}
?>


