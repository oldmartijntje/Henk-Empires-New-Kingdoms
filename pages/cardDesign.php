<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styling/style.css">
    <title>Cards</title>
</head>
<?php
    $card = [["name" => "Henk the Stone",
                "id" => "B002",
                "power" => 1,
                "energy" => 0,
                "balance" => 1,
                "shopCost" => 12,
                "onReveal" => "",
                "onGoing" => "",
                "description" => "You are my rock",
                "special" => "",
                "image" => "assets/images/B002.png",
                "deck" => "A",
                "type" => "Stone",
                "amount" => 1,
                "series" => "Henk"]];
?>
<body>
<div class="table">
    <div class="card">
        <div class="card-header">
            <div class="name">Henk the Stone</div>
            <div class="id">B002</div>
        </div>
        <div class="card-image">
            <img src="assets/images/B002.png" alt="Henk the Stone">
            <div class="series-icon">
                <img src="assets/icons/henk.png" alt="Henk Series Icon">
            </div>
            <div class="type-icon">
                <img src="assets/icons/stone.png" alt="Stone Type Icon">
            </div>
        </div>
        <div class="card-info">
            <div class="IconsDisplayBox">
                <div class="power iconWithNumber">
                    <img src="assets/icons/power.png" alt="Power Icon BackgroundIcon">
                    <span class="IconNumber">1</span>
                </div>
                <div class="energy iconWithNumber">
                    <img src="assets/icons/energy.png" alt="Energy Icon BackgroundIcon">
                    <span class="IconNumber">0</span>
                </div>
            </div>
            <div class="description">
                <span>"You are my rock"</span>
            </div>
            <!-- Display only one of the following abilities -->
            <div class="ability">
                <span>
                    <img class="Icon" src="assets/icons/onreveal.png" alt="On Reveal Ability Icon">
                    On Reveal Ability
                </span>
            </div>
            <div class="ability">
                <span>
                    <img class="Icon" src="assets/icons/ongoing.png" alt="Ongoing Ability Icon">
                    Ongoing Ability
                </span>
            </div>
            <div class="ability">
                <span>
                    <img class="Icon" src="assets/icons/special.png" alt="Special Ability Icon">
                    Special Ability
                </span>
            </div>
        </div>
        <div class="card-footer">
            <div class="deck">Deck A</div>
            <div class="shop-cost">Shop Cost: 12</div>
        </div>
    </div>
</div>
</body>
</html>