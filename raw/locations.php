<?php 
require "shared/config.php";
require "shared/functions.php";

$definedLocations = [
    // L001 - L010
    ["name" => "", "description" => "Double the ongoing effects", "icons" => "", "text" => "", "image" => ""],
    ["name" => "", "description" => "Double the on reveal effects", "icons" => "", "text" => "", "image" => ""],
    ["name" => "", "description" => "When this reaches a total power of 10+, switch the location", "icons" => "", "text" => "", "image" => ""],
    ["name" => "", "description" => "Add a random card to everyones deck.", "icons" => "", "text" => "", "image" => ""],
    ["name" => "", "description" => "all cards cost 1 less", "icons" => "", "text" => "", "image" => ""],
    ["name" => "", "description" => "all cards cost 1 more", "icons" => "", "text" => "", "image" => ""],
    ["name" => "", "description" => "everyone teams up with their neighbour, you now gotta win together (total energy is 22)", "icons" => "teams", "text" => "", "image" => ""],
    ["name" => "", "description" => "everyone has 10 extra energy", "icons" => "", "text" => "", "image" => ""],
    ["name" => "", "description" => "energy cost becomes the power of the card", "icons" => "", "text" => "", "image" => ""],
    ["name" => "404-NOTFOUND", "description" => "nothing happens", "icons" => "", "text" => "", "image" => ""],
    // L011 - L020
    ["name" => "Catnip factory", "description" => "when you play a card you have to meow", "icons" => "", "text" => "", "image" => ""],
    ["name" => "", "description" => "only 2 cards can be played per person", "icons" => "", "text" => "", "image" => ""],
    ["name" => "black hole", "description" => "cards have no effects", "icons" => "", "text" => "", "image" => ""],
    ["name" => "", "description" => "ongoing effects are disabled", "icons" => "", "text" => "", "image" => ""],
    ["name" => "", "description" => "on reveal effects are disabled", "icons" => "", "text" => "", "image" => ""],
    ["name" => "Nuclear launch", "description" => "turns into Nuked world (L017) next turn", "icons" => "", "text" => "", "image" => ""],
    ["name" => "Nuked world", "description" => "cards can't be played", "icons" => "notDrawable", "text" => "", "image" => ""],
    ["name" => "", "description" => "you can only play 1 card per turn", "icons" => "", "text" => "", "image" => ""],
    ["name" => "flooding", "description" => "turns into flooded (L020) next turn", "icons" => "", "text" => "", "image" => ""],
    ["name" => "flooded", "description" => "only water type cards can be played here", "icons" => "notDrawable", "text" => "", "image" => ""],
    // L021 - L030
    ["name" => "", "description" => "you can only play cards here that have effects", "icons" => "", "text" => "", "image" => ""],
    ["name" => "", "description" => "all cards cost 2", "icons" => "", "text" => "", "image" => ""],
    ["name" => "mushroom kingdom", "description" => "all mushroom series cards get +1 power", "icons" => "", "text" => "", "image" => ""],
    ["name" => "aperture", "description" => "all cards lose 3 power (2 will turn into -1)", "icons" => "", "text" => "neurotoxins go brrrr", "image" => ""],
]


?>