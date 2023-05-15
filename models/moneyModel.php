<link rel="stylesheet" href="styling/money.css">
<div class="table">
<?php
$amountOfCards = 0;
require "shared/config.php";
require "raw/money.php";

function logArrayy($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}


$cards = getCorrectNumber($definedMoney);
$amountOfCards = count($cards);

// statistics
if (isset($_GET['stats']) && strtolower($_GET['stats']) == "true") {
    ?>
    
    <?php
}



for ($i=0; $i < $amountOfCards; $i++) { 
    ?>
    <div class="fiche" onclick="console.log(<?php echo printCard($cards[$i]) ?>)">
        <div class="fiche-info">
            <span><?php echo $cards[$i]['amountToShowOfMoney'] ?></span>
            <img src="<?php echo getCorrectImage('money') ?>" alt="Icon" class="FicheIcon">
        </div>
        <div class="fiche-footer">
            <div class="id"><?php echo $cards[$i]['id'] ?></div>
        </div>
    </div> 
    <?php
}
?>
</div>