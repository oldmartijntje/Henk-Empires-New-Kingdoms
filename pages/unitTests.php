<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UnitTesting</title>
</head>
<body>
    <?php require "shared/functions.php";
    $tests = [
        "amountStarted" => 0,
        "amountFinished" => 0,
        "failed" => 0,
        "correct" => 0,
    ];
        echo "<h1>Testing numberToString</h1>";
        // Test cases
        $testCases = [
            ["num" => 1, "length" => 3, "expected" => "001"],
            ["num" => 12, "length" => 2, "expected" => "12"],
            ["num" => 123, "length" => 5, "expected" => "00123"],
            ["num" => 1234, "length" => 3, "expected" => "1234"],
            ["num" => -1234, "length" => 3, "expected" => "-1234"],
            ["num" => '1234', "length" => 3, "expected" => "1234"],
            ["num" => '-12', "length" => 4, "expected" => "0-12"],
            ["num" => 'a', "length" => 4, "expected" => "000a"],
        ];
        // Run tests
        foreach ($testCases as $testCase) {
            $result = numberToString($testCase["num"], $testCase["length"]);
            $tests = testFunction($result, $testCase["expected"], $tests);
        }

        echo "<h1>Testing calculateId</h1>";
        // Test cases for calculateId
        $testCasesCalculateId = [
            ["card" => ["id" => "", "name" => "Card 1"], "index" => 1, "base" => "B%s", "expected" => ["id" => "B001", "name" => "Card 1"]],
            ["card" => ["id" => "", "name" => "Card 2"], "index" => 10, "base" => "C%s", "expected" => ["id" => "C010", "name" => "Card 2"]],
            ["card" => ["id" => "", "name" => "Card 3"], "index" => 123, "base" => "D%04d", "expected" => ["id" => "D0123", "name" => "Card 3"]],
        ];

        // Run tests for calculateId
        foreach ($testCasesCalculateId as $testCase) {
            $result = calculateId($testCase["card"], $testCase["index"], $testCase["base"]);
            $tests = testFunction($result, $testCase["expected"], $tests);
        }

        echo "<h1>Testing getCorrectImage</h1>";
        // Test cases for getCorrectImage
        $testCasesGetCorrectImage = [
            ["imageTag" => "Electric", "expected" => "assets/icons/electric.png"],
            ["imageTag" => "Fire", "expected" => "assets/icons/fire.png"],
            ["imageTag" => "Power", "expected" => "assets/icons/power.png"],
            ["imageTag" => "404nf", "expected" => "assets/icons/404nf.png"],
            ["imageTag" => "error", "expected" => "assets/images/error.png"],
            ["imageTag" => "fdsgsfgfsg", "expected" => "assets/icons/404nf.png"],
            ["imageTag" => 1, "expected" => "assets/icons/404nf.png"],
        ];

        // Run tests for getCorrectImage
        foreach ($testCasesGetCorrectImage as $testCase) {
            $result = getCorrectImage($testCase["imageTag"]);
            $tests = testFunction($result, $testCase["expected"], $tests);
        }
        echo "<h1>Testing logArray</h1>";

        // Test cases for logArray
        $testCasesLogArray = [
            ["array" => ["one", "two", "three"], "expected" => "<pre>Array\n(\n    [0] => one\n    [1] => two\n    [2] => three\n)\n</pre>"],
            ["array" => ["apple" => "red", "banana" => "yellow"], "expected" => "<pre>Array\n(\n    [apple] => red\n    [banana] => yellow\n)\n</pre>"],
            ["array" => ["one", ["two", "three"], ["four", "five", "six"]], "expected" => "<pre>Array\n(\n    [0] => one\n    [1] => Array\n        (\n            [0] => two\n            [1] => three\n        )\n\n    [2] => Array\n        (\n            [0] => four\n            [1] => five\n            [2] => six\n        )\n\n)\n</pre>"],
        ];

        // Run tests for logArray
        foreach ($testCasesLogArray as $testCase) {
            ob_start();
            logArray($testCase["array"]);
            $result = ob_get_clean();
            $tests = testFunction($result, $testCase["expected"], $tests);
        }

        echo "<h1>Testing returnItems</h1>";
        // Define test cases for returnItems
        $testCasesReturnItems = [
            [
                "selectionList" => ["apple", "banana", "cherry", "durian"],
                "amountOfSelectionList" => 2,
                "expected" => 2
            ],
            [
                "selectionList" => ["cat", "dog", "fish"],
                "amountOfSelectionList" => 1,
                "expected" => 1
            ],
            [
                "selectionList" => ["red", "blue", "green", "yellow"],
                "amountOfSelectionList" => 3,
                "expected" => 3
            ]
        ];

        // Run tests for returnItems
        foreach ($testCasesReturnItems as $testCase) {
            $result = returnItems($testCase["selectionList"], $testCase["amountOfSelectionList"]);
            $tests = testFunction(count($result), $testCase["expected"], $tests);
        }

        echo "<h1>Testing generateRandom</h1>";
        // Define test cases for generateRandom
        $testCasesGenerateRandom = [
            [
                "options" => [
                    "color" => ["red", "green", "blue"],
                    "shape" => ["circle", "square", "triangle"],
                    "size" => ["small", "medium", "large"]
                ],
                "emptyModel" => [
                    "color" => "",
                    "shape" => "",
                    "size" => ""
                ],
                "selectionList" => ["color", "size"],
                "amountOfSelectionList" => 1,
                "seed" => 123, // Seed the random number generator
                "expected" => [
                    "color" => "",
                    "shape" => "square",
                    "size" => "small"
                ]
            ],
            [
                "options" => [
                    "fruit" => ["apple", "banana", "cherry"],
                    "drink" => ["water", "soda", "juice"],
                    "dessert" => ["cake", "ice cream", "pudding"]
                ],
                "emptyModel" => [
                    "fruit" => "",
                    "drink" => "",
                    "dessert" => ""
                ],
                "selectionList" => ["dessert"],
                "amountOfSelectionList" => 2,
                "seed" => 456, // Seed the random number generator
                "expected" => [
                    "fruit" => "banana",
                    "drink" => "soda",
                    "dessert" => "pudding"
                ]
            ],
            [
                "options" => [
                    "color" => ["red", "green", "blue"],
                    "shape" => ["circle", "square", "triangle"],
                    "size" => ["small", "medium", "large"]
                ],
                "emptyModel" => [
                    "color" => [],
                    "shape" => [],
                    "size" => []
                ],
                "selectionList" => ["color", "size"],
                "amountOfSelectionList" => 1,
                "seed" => 1234, // Seed the random number generator
                "expected" => [
                    "color" => [],
                    "shape" => "circle",
                    "size" => "small"
                ]
            ],
            [
                "options" => [
                    "fruit" => ["apple", "banana", "cherry","apple", "banana", "cherry"],
                    "drink" => ["water", "soda", "juice","apple", "banana", "cherry"],
                    "dessert" => ["cake", "ice cream", "pudding","apple", "banana", "cherry"]
                ],
                "emptyModel" => [
                    "fruit" => [],
                    "drink" => [],
                    "dessert" => []
                ],
                "selectionList" => ["dessert"],
                "amountOfSelectionList" => 2,
                "seed" => 4560, // Seed the random number generator
                "expected" => [
                    "fruit" => "banana",
                    "drink" => "juice",
                    "dessert" => "cherry"
                ]
            ]
        ];

        // Run tests for generateRandom
        foreach ($testCasesGenerateRandom as $testCase) {
            srand($testCase["seed"]); // Seed the random number generator
            $result = generateRandom($testCase["options"], $testCase["emptyModel"], $testCase["selectionList"], $testCase["amountOfSelectionList"]);
            $tests = testFunction($result, $testCase["expected"], $tests);
        }

        echo "<h1>Testing getTextSizeClass</h1>";
        // Define test cases
        $testCasesgetTextSizeClass = [
            [
                'card' => [
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a mi ex. Nulla facilisi. In euismod, ipsum sit amet laoreet posuere, est dolor feugiat nunc, non pulvinar magna eros non dui. Proin laoreet tortor a elit ullamcorper, eu tristique turpis feugiat. Donec ut fringilla mauris. In hac habitasse platea dictumst. Duis euismod tristique diam.',
                    'onReveal' => '',
                    'onGoing' => '',
                    'special' => ''
                ],
                'expected' => 'textSize4px'
            ],
            [
                'card' => [
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a mi ex. Nulla facilisi. In euismod, ipsum sit amet laoreet posuere, est dolor feugiat nunc, non pulvinar magna eros non dui. Proin laoreet tortor a elit ullamcorper, eu tristique turpis feugiat. Donec ut fringilla mauris. In hac habitasse platea dictumst. Duis euismod tristique diam.',
                    'onReveal' => 'Vestibulum suscipit sem non justo vulputate rhoncus. ',
                    'onGoing' => '',
                    'special' => ''
                ],
                'expected' => 'textSize4px'
            ],
            [
                'card' => [
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a mi ex. Nulla facilisi. In euismod, ipsum sit amet laoreet posuere, est dolor feugiat nunc, non pulvinar magna eros non dui. Proin laoreet tortor a elit ullamcorper, eu tristique turpis feugiat. Donec ut fringilla mauris. In hac habitasse platea dictumst. Duis euismod tristique diam.',
                    'onReveal' => '',
                    'onGoing' => '',
                    'special' => 'Nunc at lectus massa. Aliquam feugiat consequat felis, nec feugiat orci molestie a. Quisque a lacinia libero. Praesent nec eros congue, euismod lorem vel, fringilla mi.'
                ],
                'expected' => 'textSize4px'
            ],
        ];
        foreach ($testCasesgetTextSizeClass as $testCase) {
            $result = getTextSizeClass($testCase['card'], true);
            $tests = testFunction($result, $testCase["expected"], $tests);
        }

        echo "<h1>Testing printCard</h1>";
        // Define test cases
        $testCasesprintCard = [    
            [        
                "input" => [            
                    "card" => ["id" => "B001", "title" => "Title 1", "description" => "Description 1", "image" => "Image 1"],
                ],
                "expectedOutput" => trim(HTMLspecialchars('\'["id" => "B001", "title" => "Title 1", "description" => "Description 1", "image" => "Image 1"],\\n\'')),
            ],
            [        
                "input" => [            
                    "card" => ["id" => "B002", "title" => "Title 2", "description" => "", "image" => ""],
                ],
                "expectedOutput" => trim(HTMLspecialchars('\'["id" => "B002", "title" => "Title 2", "description" => "", "image" => ""],\\n\'')),
            ],
            [        
                "input" => [            
                    "card" => ["id" => "B003", "title" => "Title 3", "description" => null, "image" => null],
                ],
                "expectedOutput" => trim(HTMLspecialchars('\'["id" => "B003", "title" => "Title 3", "description" => "", "image" => ""],\\n\'')),
            ],
        ];

        // Run tests
        foreach ($testCasesprintCard as $i => $test) {
            $input = $test["input"]["card"];
            $expectedOutput = $test["expectedOutput"];
            $output = printCard($input);
            $tests = testFunction($output, $expectedOutput, $tests);
        }


        // Print test results
        echo "<h2>Test results:</h2>";
        echo "Tests started: " . $tests["amountStarted"] . "<br>";
        echo "Tests finished: " . $tests["amountFinished"] . "<br>";
        echo "Tests passed: " . $tests["correct"] . "<br>";
        echo "Tests failed: " . $tests["failed"] . "<br>";
        

    ?>
</body>
</html>