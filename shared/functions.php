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

function logArray($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function returnItems($selectionList = [], $amountOfSelectionList = 0) {
    $chosen = [];
    for ($i=0; $i < $amountOfSelectionList; $i++) { 
        $tempOption = rand(0, count($selectionList)-1);
        if ($selectionList[$tempOption] != '') {
            array_push($chosen, $selectionList[$tempOption]);
        }
        array_splice($selectionList, $tempOption, 1);
    }
    return $chosen;
}

function generateRandom($options, $emptyModel, $selectionList = [], $amountOfSelectionList = 0) {
    $random = $emptyModel;
    foreach ($options as $key => $value) {
        if (!in_array($key, $selectionList)) {
            $random[$key] = $value[array_rand($value)];
        }
    }
    $chosen = returnItems($selectionList, $amountOfSelectionList);
    foreach ($chosen as $value) {
        $val = array_rand($options[$value]);
        $random[$value] = $options[$value][$val];
    }
    return $random;
}

function getTextSizeClass($card) {
    $totalText = returnTextWithoutImagesTags($card['description'] . $card['onReveal'] . $card['onGoing'] . $card['special']);
    if (strlen($totalText) > 220) {
        echo "textSize4px";
    } else if (strlen($totalText) > 240) {
        echo "textSize5px";
    } else if (strlen($totalText) > 225) {
        echo "textSize6px";
    } else if (strlen($totalText) > 205) {
        echo "textSize7px";
    } else if (strlen($totalText) > 190) {
        echo "textSize8px";
    } else if (strlen($totalText) > 170) {
        echo "textSize9px";
    } else if (strlen($totalText) > 110) {
        echo "textSize10px";
    } else if (strlen($totalText) > 80) {
        echo "textSize11px";
    }
}

function printCard($dictionary) {
    $aanhalingsTekens = stripslashes(trim(HTMLspecialchars('"')));
    $textMessage = "'";
    $textMessage .= '[';
    foreach ($dictionary as $key => $value) {
        if (is_string($value)) {
            $textMessage .= $aanhalingsTekens . $key . $aanhalingsTekens . ' => ' . $aanhalingsTekens . $value . $aanhalingsTekens . ', ';
        } else {
            $textMessage .= $aanhalingsTekens . $key . $aanhalingsTekens . ' => ' . strval($value) . ', ';
        }
    }
    $textMessage = substr($textMessage, 0, -2);
    $textMessage .= "],\\n'";
    $textMessage = str_replace("'", "", $textMessage);
    $textMessage = "'" . $textMessage . "'";
    return $textMessage;
}

function returnTextWithImages($textToScan, $classesToEquipImagesWith = "", $splitCharacter = "|", $ifNotSayError = false) {
    global $imagesDictionary;
    $amount = 0;
    foreach ($imagesDictionary as $key => $value) {
        $findThisKey = $splitCharacter . $key . $splitCharacter;
        if(strpos($textToScan, $findThisKey) !== false){
            $amount++;
        }
        $textToScan = str_replace("$findThisKey", "<img title=\"$key\" class=\"$classesToEquipImagesWith\" src=\"$value\">", $textToScan);
    }
    if ($amount == 0 && $ifNotSayError) {
        $textToScan = "<img title=\"$textToScan\" class=\"$classesToEquipImagesWith\" src=\"" . getCorrectImage("404nf") . "\">";
    }
    return $textToScan;
}

function returnTextWithoutImagesTags($textToScan) {
    global $imagesDictionary;
    foreach ($imagesDictionary as $key => $value) {
        $textToScan = str_replace("|$key|", "  ", $textToScan);
    }
    return $textToScan;
}

?>