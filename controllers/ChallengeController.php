<?php
    require_once("../config/challenges.php");

    if (isset($_POST['get_question'])) {
        $challenge_index = $_POST['challenge_index'];
        $challenge = $challenges[$challenge_index];

        if ($challenge['has_answer'] != false) {
            echo $challenges[$challenge_index]['question'];        
        }
    }
    else if (isset($_POST['verify_answer'])) {
        $challenge_index = $_POST['challenge_index'];
        $answer = $_POST['answer'];
        $challenge = $challenges[$challenge_index];

        if ($challenge['has_answer'] != false) {
            if ($answer === $challenges[$challenge_index]['answer']) {
                echo "correct";
            }
            else {
                echo "wrong";
            }
        }
        
    }