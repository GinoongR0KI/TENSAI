<?php

// Import
if (session_status() === PHP_SESSION_NONE) {session_start();}

require_once("../../../functions/dbConn.php");
require_once("../../Classes/questionManager.php");
//

// Vars
    // Process Data
    $questionData = explode("|amp|", $_POST['questionData']);
    $questions = "";
    
    for ($i = 0; $i < count($questionData); $i++) {
        if ($i+1 >= count($questionData)) {
            $questions .= $questionData[$i];
        } else {
            $questions .= $questionData[$i] . "&";
        }
    }
    
    $optionData = explode("|amp|", $_POST['optionData']);
    $options = "";
    
    for ($i = 0; $i < count($optionData); $i++) {
        if ($i+1 >= count($optionData)) {
            $options .= $optionData[$i];
        } else {
            $options .= $optionData[$i] . "&";
        }
    }
    
    $answerData = explode("|amp|", $_POST['answerData']);
    $answers = "";
    
    for ($i = 0; $i < count($answerData); $i++) {
        if ($i+1 >= count($answerData)) {
            $answers .= $answerData[$i];
        } else {
            $answers .= $answerData[$i] . "&";
        }
    }
        //
    
$manager = new questionManager($db);
//

//
if ($manager->publish($_POST['assessID'], $_POST['title'], $_POST['items'], $questions, $options, $answers, $_POST['typeData'])) {
    echo "true";
} else {
    echo "false";
}
//