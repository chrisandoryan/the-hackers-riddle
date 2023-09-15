<?php
    require_once("../config/challenges.php");

    if (isset($_GET['get_question'])) {

    }
    else if (isset($_POST['verify_answer'])) {
        $challenge_index = $_POST['challenge_index'];
        $answer = $_POST['answer'];

        if ($answer === $challenges[$challenge_index]['answer']) {
            var_dump("Correct!");
        }
        else {
            var_dump("Wrong!");
        }
    }