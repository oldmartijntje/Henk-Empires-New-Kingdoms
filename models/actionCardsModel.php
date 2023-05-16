<link rel="stylesheet" href="styling/style.css">
<div class="table">
<?php
require "shared/config.php";
require "raw/actionCard.php";
if ((isset($_GET['amount']) && (is_numeric($_GET['amount'])) || $_GET['amount'] == "all")) {
    $amountOfCards = $_GET['amount'];
} else if (isset($_GET['type']) && $_GET['type'] == "default") {
    $amountOfCards = $GenerationSettings["defaultCardsAmount"];
} else {
    $amountOfCards = $GenerationSettings["randomCardsAmount"];;   
}
if ($amountOfCards == "all") {
    $amountOfCards = count(getCorrectNumber($definedActionCards));
}

if (isset($_GET['type']) && $_GET['type'] == "random") {
    $cards = array();
    for ($j=0; $j < $amountOfCards ; $j++) { 
        $randomCard = generateRandom($possibleActionCardOptions, $emptyActionCardModel, $ActionCardConfig['randomization']['chooseBetween'], $ActionCardConfig['randomization']['amount']);
        $randomCard['balance'] = $randomCard['power'] - $randomCard['energy'];
        $randomCard = createCard($randomCard, $j, $ActionCardConfig);
        $randomCard['name'] = "Randomized Card";
        $randomCard['image'] = getCorrectImage("error");
        $randomCard['id'] = "B???";
        $randomCard['shopCost'] = "???";
        $randomCard['deck'] = "???";
        array_push($cards, $randomCard);
    }
} else {
    if ($amountOfCards > count(getCorrectNumber($definedActionCards))) {
        $amountOfCards = count(getCorrectNumber($definedActionCards));
    }
    $cards = getCorrectNumber($definedActionCards);
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
        <?php if (isset($cards[$i]['where']) && $cards[$i]['where'] != "") { ?>
        <div class="series-icon">
            <?php echo returnTextWithImages($cards[$i]['where'], "", "", true, true) ?>
        </div>
        <?php } ?>
        <div class="type-icon">
            <?php echo returnTextWithImages($cards[$i]['type'], "", "", true, true) ?>
        </div>
    </div>
    <div class="card-info">
        <?php if (isset($cards[$i]['description']) && $cards[$i]['description'] != "") { ?>
            <div title="Description" class="description <?php getTextSizeClass($cards[$i])?>">
                <span class="flexSpan"><?php echo returnTextWithImages($cards[$i]['description'], "inTextImages") ?></span>
            </div>
        <?php } ?>
    </div>
    <div class="card-footer">
        <div class="shop-cost">Shop Cost: <?php echo $cards[$i]['shopCost'] ?></div>
    </div>
</div> 




<?php
}
?>
</div>