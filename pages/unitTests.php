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
        $imagesDictionary = [
            "test1" => "test1.png",
            "test2" => "test2.png",
            "404" => "404nf.png",
            "test3" => "test3.png",
            "test4" => "test4.png",
            "test5" => "test5.png",
            "404nf" => "owo",
        ];
        // Test cases for getCorrectImage
        $testCasesGetCorrectImage = [
            ["imageTag" => "test1", "expected" => "test1.png"],
            ["imageTag" => "test2", "expected" => "test2.png"],
            ["imageTag" => "test3", "expected" => "test3.png"],
            ["imageTag" => "404", "expected" => "404nf.png"],
            ["imageTag" => "test4", "expected" => "test4.png"],
            ["imageTag" => "fdsgsfgfsg", "expected" => "owo"],
            ["imageTag" => 1, "expected" => "owo"],
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

        echo "<h1>Testing returnTextWithImages</h1>";
        $imagesDictionary = [
            "test1" => "test1.png",
            "test2" => "test2.png",
            "404" => "404nf.png",
            "test3" => "test3.png",
            "test4" => "test4.png",
            "test5" => "test5.png",
            "404nf" => "owoThisIsNotFound.exe",
            "kaas" => "kaas.png",
            "kaa" => "kaa.png",
        ];
        // Define test cases
        $testCasereturnTextWithImages = [
            [
                "input" => [
                    "text" => "This is just text.",
                    "classes" => "",
                    "splitCharacter" => "|",
                    "ifNotSayError" => false,
                    "returnOnlyImages" => false,
                ],
                "expectedOutput" => "This is just text.",
            ],
            [
                "input" => [
                    "text" => "This text contains |test1|. This is another sentence.",
                    "classes" => "",
                    "splitCharacter" => "|",
                    "ifNotSayError" => false,
                    "returnOnlyImages" => false,
                ],
                "expectedOutput" => "This text contains <img title=\"test1\" class=\"\" src=\"test1.png\">. This is another sentence.",
            ],
            [
                "input" => [
                    "text" => "|test1| This text contains |test2| and |test3|. |test4|",
                    "classes" => "",
                    "splitCharacter" => "|",
                    "ifNotSayError" => false,
                    "returnOnlyImages" => false,
                ],
                "expectedOutput" => "<img title=\"test1\" class=\"\" src=\"test1.png\"> This text contains <img title=\"test2\" class=\"\" src=\"test2.png\"> and <img title=\"test3\" class=\"\" src=\"test3.png\">. <img title=\"test4\" class=\"\" src=\"test4.png\">",
            ],
            [
                "input" => [
                    "text" => "|test5| |unknown|",
                    "classes" => "",
                    "splitCharacter" => "|",
                    "ifNotSayError" => false,
                    "returnOnlyImages" => false,
                ],
                "expectedOutput" => "<img title=\"test5\" class=\"\" src=\"test5.png\"> |unknown|",
            ],
            [
                "input" => [
                    "text" => "|test5| |unknown|",
                    "classes" => "",
                    "splitCharacter" => "",
                    "ifNotSayError" => false,
                    "returnOnlyImages" => false,
                ],
                "expectedOutput" => "|<img title=\"test5\" class=\"\" src=\"test5.png\">| |unknown|",
            ],
            [
                "input" => [
                    "text" => "|test5| |unknown|",
                    "classes" => "",
                    "splitCharacter" => "|",
                    "ifNotSayError" => true,
                    "returnOnlyImages" => false,
                ],
                "expectedOutput" => "<img title=\"test5\" class=\"\" src=\"test5.png\"> |unknown|",
            ],
            [
                "input" => [
                    "text" => "|test5| |unknown|",
                    "classes" => "",
                    "splitCharacter" => "",
                    "ifNotSayError" => true,
                    "returnOnlyImages" => false,
                ],
                "expectedOutput" => "|<img title=\"test5\" class=\"\" src=\"test5.png\">| |unknown|",
            ],
            [
                "input" => [
                    "text" => "|test5| |unknown|",
                    "classes" => "",
                    "splitCharacter" => "",
                    "ifNotSayError" => false,
                    "returnOnlyImages" => true,
                ],
                "expectedOutput" => "",
            ],
            [
                "input" => [
                    "text" => "|test5| |unknown|",
                    "classes" => "owo",
                    "splitCharacter" => "",
                    "ifNotSayError" => false,
                    "returnOnlyImages" => true,
                ],
                "expectedOutput" => "",
            ],
            [
                "input" => [
                    "text" => "|test5| |unknown|",
                    "classes" => "",
                    "splitCharacter" => "",
                    "ifNotSayError" => true,
                    "returnOnlyImages" => true,
                ],
                "expectedOutput" => "<img title=\"|test5| |unknown|\" class=\"\" src=\"owoThisIsNotFound.exe\">",
            ],
            [
                "input" => [
                    "text" => "kaastest5kaas kaasunknownkaas",
                    "classes" => "owo",
                    "splitCharacter" => "kaas",
                    "ifNotSayError" => false,
                    "returnOnlyImages" => true,
                ],
                "expectedOutput" => "<img title=\"test5\" class=\"owo\" src=\"test5.png\">",
            ],
            [
                "input" => [
                    "text" => "kaastest5kaas kaasunknownkaas",
                    "classes" => "notOwO",
                    "splitCharacter" => "kaas",
                    "ifNotSayError" => false,
                    "returnOnlyImages" => false,
                ],
                "expectedOutput" => "<img title=\"test5\" class=\"notOwO\" src=\"test5.png\"> kaasunknownkaas",
            ],
            [
                "input" => [
                    "text" => "|test5| |unknown||test4|",
                    "classes" => "",
                    "splitCharacter" => "|",
                    "ifNotSayError" => false,
                    "returnOnlyImages" => true,
                ],
                "expectedOutput" => "<img title=\"test5\" class=\"\" src=\"test5.png\"><img title=\"test4\" class=\"\" src=\"test4.png\">",
            ],
            [
                "input" => [
                    "text" => "|banaan| |unknown|",
                    "classes" => "",
                    "splitCharacter" => "|",
                    "ifNotSayError" => true,
                    "returnOnlyImages" => false,
                ],
                "expectedOutput" => "<img title=\"|banaan| |unknown|\" class=\"\" src=\"owoThisIsNotFound.exe\">",
            ],
            [
                "input" => [
                    "text" => "|test5| |unknown|",
                    "classes" => "henk",
                    "splitCharacter" => "|",
                    "ifNotSayError" => false,
                    "returnOnlyImages" => false,
                ],
                "expectedOutput" => "<img title=\"test5\" class=\"henk\" src=\"test5.png\"> |unknown|",
            ],
            [
                "input" => [
                    "text" => "test5 test4 daf",
                    "classes" => "henk",
                    "splitCharacter" => "",
                    "ifNotSayError" => true,
                    "returnOnlyImages" => true,
                ],
                "expectedOutput" => "<img title=\"test5\" class=\"henk\" src=\"test5.png\"><img title=\"test4\" class=\"henk\" src=\"test4.png\">",
            ],
            [
                "input" => [
                    "text" => "test5 test4 daf",
                    "classes" => "henk",
                    "splitCharacter" => " ",
                    "ifNotSayError" => true,
                    "returnOnlyImages" => true,
                ],
                "expectedOutput" => "<img title=\"test5\" class=\"henk\" src=\"test5.png\"><img title=\"test4\" class=\"henk\" src=\"test4.png\">",
            ],
            [
                "input" => [
                    "text" => "kaas",
                    "classes" => "henk",
                    "splitCharacter" => "",
                    "ifNotSayError" => true,
                    "returnOnlyImages" => true,
                ],
                "expectedOutput" => "<img title=\"<img title=\"kaa\" class=\"henk\" src=\"kaa.png\">s\" class=\"henk\" src=\"<img title=\"kaa\" class=\"henk\" src=\"kaa.png\">s.png\">",
            ],
        ];
    
        foreach ($testCasereturnTextWithImages as $test) {
            $result = returnTextWithImages($test["input"]['text'], $test["input"]['classes'], $test["input"]['splitCharacter'], $test["input"]['ifNotSayError'], $test["input"]['returnOnlyImages']);
            $tests = testFunction($result, $test["expectedOutput"], $tests);
        }

        echo "<h1>Testing returnTextWithoutImagesTags</h1>";
        $imagesDictionary = [
            "test1" => "test1.png",
            "test2" => "test2.png",
            "404" => "404nf.png",
            "test3" => "test3.png",
            "test4" => "test4.png",
            "test5" => "test5.png",
            "404nf" => "owoThisIsNotFound.exe",
        ];
        // Define test cases
        $testCasereturnTextWithImages = [
            [
                "input" => "This is just text.",
                "expectedOutput" => "This is just text.",
            ],
            [
                "input" => "This text contains |test1|. This is another sentence.",
                "expectedOutput" => "This text contains   . This is another sentence.",
            ],
            [
                "input" => "|test1| This text contains |test2| and |test3|. |test4|",
                "expectedOutput" => "   This text contains    and   .   ",
            ],
            [
                "input" => "|test5| |unknown|",
                "expectedOutput" => "   |unknown|",
            ],
            [
                "input" => "|test5||test5| |unknown||test5|",
                "expectedOutput" => "     |unknown|  ",
            ],
            [
                "input" => "|test5||test5||test5| |unknown||test5| |test5|.nl",
                "expectedOutput" => "       |unknown|     .nl",
            ],
        ];

        foreach ($testCasereturnTextWithImages as $test) {
            $result = returnTextWithoutImagesTags($test["input"]);
            $tests = testFunction($result, $test["expectedOutput"], $tests);
        }

        echo "<h1>Testing returnDetectedImages</h1>";
        $imagesDictionary = [
            "test1" => "test1.png",
            "test2" => "test2.png",
            "404" => "404nf.png",
            "test3" => "test3.png",
            "test4" => "test4.png",
            "test5" => "test5.png",
            "404nf" => "owoThisIsNotFound.exe",
        ];
        $testCasereturnDetectedImages = [
            [
                "input" => [
                    "text" => "This is just text.",
                    "splitCharacter" => "|",
                ],
                "expectedOutput" => ["", "This is just text."],
            ],
            [
                "input" => [
                    "text" => "This is just text with |test1|.",
                    "splitCharacter" => "|",
                ],
                "expectedOutput" => "|test1|",
            ],
            [
                "input" => [
                    "text" => "This is just text with test1.",
                    "splitCharacter" => "",
                ],
                "expectedOutput" => ["", "This is just text with test1."],
            ],
            [
                "input" => [
                    "text" => "This is |test1| with |test1|.",
                    "splitCharacter" => "|",
                ],
                "expectedOutput" => "|test1||test1|",
            ],
            [
                "input" => [
                    "text" => "This is |test1| with |test1|, |test1|.",
                    "splitCharacter" => "|",
                ],
                "expectedOutput" => "|test1||test1||test1|",
            ],
            [
                "input" => [
                    "text" => "This is |test1| with |test2|, |test1|.",
                    "splitCharacter" => "|",
                ],
                "expectedOutput" => "|test1||test2||test1|",
            ],
            [
                "input" => [
                    "text" => "This is |test1| with |test1|, |test1|.",
                    "splitCharacter" => "",
                ],
                "expectedOutput" => ["", "This is |test1| with |test1|, |test1|."],
            ],
        ];

        foreach ($testCasereturnDetectedImages as $test) {
            $result = returnDetectedImages($test["input"]["text"], $test["input"]["splitCharacter"]);
            $tests = testFunction($result, $test["expectedOutput"], $tests);
        }

        echo "<h1>Testing getAllOptions</h1>";
        // Test cases for getAllOptions
        $testCasesGetAllOptions = [
            // Test case 1
            [
                "definedCards" => [
                    ["color" => "red", "value" => 5],
                    ["color" => "green", "value" => 10],
                ],
                "blacklistedKeys" => ["color"],
                "possibleOptions" => [
                    "value" => [1, 2, 3, 4, 5]
                ],
                "expected" => [
                    "value" => [1, 2, 3, 4, 5, 10]
                ]
            ],
            // Test case 2
            [
                "definedCards" => [
                    ["color" => "red", "value" => 5],
                    ["color" => "green", "value" => 10],
                ],
                "blacklistedKeys" => ["value"],
                "possibleOptions" => [
                    "value" => [1, 2, 3, 4, 5],
                    "color" => []
                ],
                "expected" => [
                    "value" => [1, 2, 3, 4, 5],
                    "color" => ["red", "green"]
                ]
            ],
            // Test case 3
            [
                "definedCards" => [
                    ["color" => "red", "value" => 5],
                    ["color" => "green", "value" => 10],
                ],
                "blacklistedKeys" => ["value"],
                "possibleOptions" => [
                    "value" => [1, 2, 3, 4, 5],
                ],
                "expected" => [
                    "value" => [1, 2, 3, 4, 5],
                    "color" => ["red", "green"]
                ]
            ],
            // Test case 4
            [
                "definedCards" => [
                    ["color" => "red", "value" => 5],
                    ["color" => "green", "value" => 10],
                ],
                "blacklistedKeys" => ["value"],
                "possibleOptions" => [
                ],
                "expected" => [
                    "color" => ["red", "green"]
                ]
            ]
        ];

        // Run tests for getAllOptions
        foreach ($testCasesGetAllOptions as $testCase) {
            $result = getAllOptions($testCase["definedCards"], $testCase["blacklistedKeys"], $testCase["possibleOptions"]);
            $tests = testFunction($result, $testCase["expected"], $tests);
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