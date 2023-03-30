<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Henk Empires New Kingdoms</title>
</head>
<body>
    <?php $redirectDict = array(
        'home' => 'pages/home.php',
        "battleCards" => "pages/cardDesign.php",
    );
    ?>

    <?php if (isset($_GET['page'])) {
        if (array_key_exists($_GET['page'], $redirectDict)) {
            require $redirectDict[$_GET['page']];
        } else {
            require 'pages/home.php';
        }
    } else {
        require 'pages/home.php';
    }
    ?>
</body>
</html>