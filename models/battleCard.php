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
        <div class="series-icon">
            <img src="<?php echo getCorrectImage($cards[$i]['series']) ?>" alt="Henk Series Icon">
        </div>
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
        <div class="description">
            <span>"<?php echo $cards[$i]['description'] ?>"</span>
        </div>
        <div class="ability">
            <span>
                <img class="Icon" src="assets/icons/onreveal.png" alt="On Reveal Ability Icon">
                <?php echo $cards[$i]['onreveal'] ?>
            </span>
        </div>
        <div class="ability">
            <span>
                <img class="Icon" src="assets/icons/ongoing.png" alt="Ongoing Ability Icon">
                <?php echo $cards[$i]['ongoing'] ?>
            </span>
        </div>
        <div class="ability">
            <span>
                <img class="Icon" src="assets/icons/special.png" alt="Special Ability Icon">
                <?php echo $cards[$i]['special'] ?>
            </span>
        </div>
    </div>
    <div class="card-footer">
        <div class="deck">Deck <?php echo $cards[$i]['deck'] ?></div>
        <div class="shop-cost">Shop Cost: <?php echo $cards[$i]['shopCost'] ?></div>
    </div>
</div> 




<?php
}
?>


