<?php
require "shared/config.php";

function testFunction($function, $expectedOutcome, $testArray) {
    $testArray["amountStarted"]++;
    if ($function === $expectedOutcome) {
        $testArray["correct"]++;
    } else {
        echo "<h2>Test failed: " . $testArray["amountStarted"] . "</h2>";
        if (gettype($function) === "array") {
            echo "<p>Gotten: " . gettype($function) . ": " . "</p>";
            print_r($function);
        } else {
            echo "<p>Gotten: " . gettype($function) . ": $function</p>";
            echo "<p>Gotten w HTMLspecialchars(): " . HTMLspecialchars($function) . "</p>";
        }
        if (gettype($expectedOutcome) === "array") {
            echo "<p>Expected: " . gettype($expectedOutcome) . ": " . "</p>";
            print_r($expectedOutcome);
        } else {
            echo "<p>Expected: " . gettype($expectedOutcome) . ": $expectedOutcome</p>";
            echo "<p>Expected w HTMLspecialchars(): " . HTMLspecialchars($expectedOutcome) . "</p>";
        }
        if (gettype($function) === "array" && gettype($expectedOutcome) === "array") {
            echo "<p>Diff: " . gettype($function) . ": " . "</p>";
            logArray(array_diff($function, $expectedOutcome));
        } else if (gettype($function) === "string" && gettype($expectedOutcome) === "string" && false) {
            echo "<p>This is wrong in the result: " . "</p>";
            logArray(array_diff(str_split($function), str_split($expectedOutcome)));
        }
        $testArray["failed"]++;

    }
    $testArray["amountFinished"]++;
    return $testArray;
}

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
        if (count($selectionList) > 0 && $selectionList[$tempOption] != '') {
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

function getTextSizeClass($card, $trueIfReturnFalseIfEcho = false) {
    $totalText = returnTextWithoutImagesTags($card['description'] . $card['onReveal'] . $card['onGoing'] . $card['special']);
    $value = "";
    if (strlen($totalText) > 220) {
        $value = "textSize4px";
    } else if (strlen($totalText) > 240) {
        $value = "textSize5px";
    } else if (strlen($totalText) > 225) {
        $value = "textSize6px";
    } else if (strlen($totalText) > 205) {
        $value = "textSize7px";
    } else if (strlen($totalText) > 190) {
        $value = "textSize8px";
    } else if (strlen($totalText) > 170) {
        $value = "textSize9px";
    } else if (strlen($totalText) > 110) {
        $value = "textSize10px";
    } else if (strlen($totalText) > 80) {
        $value = "textSize11px";
    }
    if ($trueIfReturnFalseIfEcho) {
        return $value;
    } else {
        echo $value;
    }
}

function printCard($dictionary) {
    $aanhalingsTekens = stripslashes(trim(HTMLspecialchars('"')));
    $arrowBracket = stripslashes(trim(HTMLspecialchars('>')));
    $textMessage = "'";
    $textMessage .= '[';
    foreach ($dictionary as $key => $value) {
        if ($value == null) {
            $value = "";
        }
        if (is_string($value)) {
            $textMessage .= $aanhalingsTekens . $key . $aanhalingsTekens . ' =' . $arrowBracket . ' ' . $aanhalingsTekens . $value . $aanhalingsTekens . ', ';
        } else {
            $textMessage .= $aanhalingsTekens . $key . $aanhalingsTekens . ' =' . $arrowBracket . ' ' . strval($value) . ', ';
        }
    }
    $textMessage = substr($textMessage, 0, -2);
    $textMessage .= "],\\n'";
    $textMessage = str_replace("'", "", $textMessage);
    $textMessage = "'" . $textMessage . "'";
    return $textMessage;
}

function returnTextWithImages($textToScan, $classesToEquipImagesWith = "", $splitCharacter = "|", $ifNotSayError = false, $returnOnlyImages = false) {
    global $imagesDictionary;
    $subtext = $textToScan;
    if ($returnOnlyImages) {
        $result = returnDetectedImages($textToScan, $splitCharacter);
        if (gettype($result) === "array") {
            $textToScan = $result[0];
            $subtext = $result[1];
        } else {
            $textToScan = $result;
            $subtext = $result;
        }
    }
    $amount = 0;
    foreach ($imagesDictionary as $key => $value) {
        $findThisKey = $splitCharacter . $key . $splitCharacter;
        if(strpos($textToScan, $findThisKey) !== false){
            $amount++;
        }
        $textToScan = str_replace("$findThisKey", "<img title=\"$key\" class=\"$classesToEquipImagesWith\" src=\"$value\">", $textToScan);
    }
    if ($amount == 0 && $ifNotSayError) {
        $textToScan = "<img title=\"$subtext\" class=\"$classesToEquipImagesWith\" src=\"" . getCorrectImage("404nf") . "\">";
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

function returnDetectedImages($text, $splitCharacter = "") {
    global $imagesDictionary;
    $originalSplitCharacter = $splitCharacter;
    if ($splitCharacter == "") {
        $splitCharacter = " ";
    }
    if (is_string($splitCharacter) && $splitCharacter != " ") {
        $splittedText = explode($splitCharacter, $text);
    } else {
        $splittedText = preg_split("/\s+/", $text);
    }
    
    $arrayToKeep = [];
    for ($i=0; $i < count($splittedText); $i++) { 
        array_push($arrayToKeep, $splittedText[$i]);
    }
    $returnString = "";
    foreach ($arrayToKeep as $value) {
        if (array_key_exists($value, $imagesDictionary)) {
            if ($originalSplitCharacter == "") {
                $returnString .= $value;
            } else {
                $returnString .= $splitCharacter . $value . $splitCharacter;
            }
            
        }
    }
    if ($returnString == "") {
        return [$returnString, $text];
    }
    return $returnString;
}

function getAllOptions($definedCards, $blacklistedKeys, $possibleOptions) {
    foreach ($definedCards as $card) {
        foreach($card as $key=>$value) {
            if (in_array((string)$key, $blacklistedKeys)) {
                continue;
            } else {
                if (!array_key_exists($key, $possibleOptions)) {
                    $possibleOptions[$key] = [];
                }
                if (in_array($value, $possibleOptions[$key])) {
                    continue;
                } else {
                    array_push($possibleOptions[$key],$value);
                }
            }
        }
    }
    return $possibleOptions;
}

?>