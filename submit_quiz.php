<?php
include('config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $question1 = $_POST['question1'] ?? null;
    $question2 = $_POST['question2'] ?? null;
    $question3 = $_POST['question3'] ?? null;
    $question4 = $_POST['question4'] ?? null;
    $question5 = $_POST['question5'] ?? null;
    $question6 = $_POST['question6'] ?? null;
    $question7 = $_POST['question7'] ?? null;
    $question8 = $_POST['question8'] ?? null;
    $question9 = $_POST['question9'] ?? null;
    $question10 = $_POST['question10'] ?? null;
    $question11 = $_POST['question11'] ?? null;
    $question12 = $_POST['question12'] ?? null;
    $question13 = $_POST['question13'] ?? null; // Corrected here
    $question14 = $_POST['question14'] ?? null; // Changed from question13
    $question15 = $_POST['question15'] ?? null;
    $name = $_POST['name'] ?? null;
    $mobile = $_POST['mobile'] ?? null;
    $answers = [
        'question1' => $question1,
        'question2' => $question2,
        'question3' => $question3,
        'question4' => $question4,
        'question5' => $question5,
        'question6' => $question6,
        'question7' => $question7,
        'question8' => $question8,
        'question9' => $question9,
        'question10' => $question10,
        'question11' => $question11,
        'question12' => $question12,
        'question13' => $question13,
        'question14' => $question14,
        'question15' => $question15,
    ];

    // Initialize answer counters
    $answerCounts = ['a' => 0, 'b' => 0, 'c' => 0];

    // Count the occurrences of each answer
    foreach ($answers as $answer) {
        if (isset($answerCounts[$answer])) {
            $answerCounts[$answer]++;
        }
    }
    $a = $answerCounts['a'] * 6.6;
    $b = $answerCounts['b'] * 6.6;
    $c = $answerCounts['c'] * 6.6;

    $max = max($a, $b, $c);

    $min = min($a, $b, $c);

    $middle = $a + $b + $c - $max - $min;

    $des = '';
    // Determine primary descriptor based on max value
    if ($a == $max) {
        $des = "a";
    } elseif ($b == $max) {
        $des = "b";
    } elseif ($c == $max) {
        $des = "c";
    }

    // Check if max and middle are close
    if ($max - $middle <= 15) {
        if (floatsAreEqual($a, $middle)) {
            if (!str_contains($des, "a")) {
                $des .= "a";
            }
        }
        if (floatsAreEqual($b, $middle)) {
            if (!str_contains($des, "b")) {
                $des .= "b";
            }
        }
        if (floatsAreEqual($c, $middle)) {
            if (!str_contains($des, "c")) {
                $des .= "c";
            }
        }
    }

    // Check if max and min are close
    if ($max - $min <= 15) {
        if (floatsAreEqual($a, $min)) {
            if (!str_contains($des, "a")) {
                $des .= "a";
            }
        }
        if (floatsAreEqual($b, $min)) {
            if (!str_contains($des, "b")) {
                $des .= "b";
            }
        }
        if (floatsAreEqual($c, $min)) {
            if (!str_contains($des, "c")) {
                $des .= "c";
            }
        }
    }






    if ($des == 'a') {
        $pdfContent = file_get_contents('Vata_Prakriti.pdf');
    } elseif ($des == 'b') {
        $pdfContent = file_get_contents('pitta_Prakriti.pdf');
    } elseif ($des == 'c') {
        $pdfContent = file_get_contents('kapha_Prakriti.pdf');
    } elseif ($des == 'ab') {
        $pdfContent = file_get_contents('Vata_pitta_Prakriti.pdf');
    } elseif ($des == 'ba') {
        $pdfContent = file_get_contents('Vata_pitta_Prakriti.pdf');
    } elseif ($des == 'bc') {
        $pdfContent = file_get_contents('kapha_pitta_Prakriti.pdf');
    } elseif ($des == 'cb') {
        $pdfContent = file_get_contents('kapha_pitta_Prakriti.pdf');
    } elseif ($des == 'ca') {
        $pdfContent = file_get_contents('kapha_vata_Prakriti.pdf');
    } elseif ($des == 'ac') {
        $pdfContent = file_get_contents('kapha_vata_Prakriti.pdf');
    } else {
        $pdfContent = file_get_contents('tri_Prakriti.pdf');
    }


  
    $logEntry = "name: " . $name . "\n";
    $logEntry .= "mobile: " . $mobile . "\n";
    $logEntry .= "\n\nanswers: " . $ans . "\n";
    $logEntry .= "a: " . $a . "\n";
    $logEntry .= "b: " . $b . "\n";
    $logEntry .= "c: " . $c . "\n";
    $logEntry .= "max: " . $max . "\n";
    $logEntry .= "middle: " . $middle . "\n";
    $logEntry .= "min: " . $min . "\n";
    $logEntry .= "des: " . $des . "\n\n\n";
    $ans = $question1 . ' , ' . $question2 . ' , ' . $question3 . ' , ' . $question4 . ' , ' . $question5 . ' , ' . $question6 . ' , ' . $question7 . ' , ' . $question8 . ' , ' . $question9 . ' , ' . $question10 . ' , ' . $question11 . ' , ' . $question12 . ' , ' . $question13 . ' , ' . $question14 . ' , ' . $question15;
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        // Prepare and execute the SQL statement
        $sql = "INSERT INTO qa (name, mobile,answers) VALUES (:name, :mobile, :answers)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':mobile', $mobile);
        
        $stmt->bindParam(':answers', $ans);
        // Execute the prepared statement
        $stmt->execute();
    } catch (\PDOException $e) {
        $logEntry .= "Error: " . $e->getMessage(). "\n\n\n";
        
    }

    // Prepare log entry
    
    
    // Append log entry to file
    $logFile = 'quiz_responses.log'; // Ensure this path is correct and writable
    if (file_put_contents($logFile, $logEntry, FILE_APPEND) === false) {
      
    } else {
    }

    // Set headers to return a PDF file
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="downloaded.pdf"');
    echo $pdfContent;
    exit;
} else {
    echo 'Invalid request method.';
}
function floatsAreEqual($float1, $float2, $epsilon = 0.00001)
{
    return abs($float1 - $float2) < $epsilon;
}
