<?php
require "shared/config.php";

function numberToString($num, $length = 3) {
    return str_pad((string)$num, $length, '0', STR_PAD_LEFT);
}

function calculateId($card, $index, $base = "B%s") {
    $card["id"] = sprintf($base, numberToString($index));
    return $card;
}

function getCorrectImage($imageTag) {
    global $imagesDictionary;
    if (array_key_exists($imageTag, $imagesDictionary)) {
        return $imagesDictionary[$imageTag];
    } else {
        return $imagesDictionary["404nf"];
    }
}

?>