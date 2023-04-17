<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cards</title>
</head>

<body>
<div class="table">
<?php
    $loadDict = array(
        "battleCards" => "models/battleCardModel.php",
        "locations" => "models/locationModel.php",
    );
    
    if (isset($_GET['page'])) {
        if (array_key_exists($_GET['page'], $loadDict)) {
            require $loadDict[$_GET['page']];
        } else {
            require 'models/error.php';
        }
    }
?>
</div>
</body>
</html>