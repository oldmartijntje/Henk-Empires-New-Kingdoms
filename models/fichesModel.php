<?php
$amountOfCards = 0;
require "shared/config.php";
require "raw/fiches.php";

function logArrayy($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}


$cards = getCorrectNumber($definedFiches);
$amountOfCards = count($cards);

// statistics
if (isset($_GET['stats']) && strtolower($_GET['stats']) == "true") {
    ?>
    
    <?php
}



for ($i=0; $i < $amountOfCards; $i++) { 
    ?>
<link rel="stylesheet" href="styling/style.css">
<div class="fiche" onclick="console.log(<?php echo printCard($cards[$i]) ?>)" <?php if ($cards[$i]["color"] != "") {
        echo "style='background-color: " . $cards[$i]["color"] . "'";
    } ?>>
    <div class="fiche-info" <?php if ($cards[$i]["color"] != "") {
        echo "style='background-color: " . $cards[$i]["color"] . "'";
    } ?>>
        <span><?php echo $cards[$i]['text'] ?></span>
        <img src="<?php echo getCorrectImage($cards[$i]['type']) ?>" alt="Icon" class="FicheIcon">
    </div>
    <div class="fiche-footer">
        <div class="id"><?php echo $cards[$i]['id'] ?></div>
    </div>
</div> 




<?php
}
?>