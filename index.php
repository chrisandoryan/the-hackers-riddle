<?php
require_once("config/challenges.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The Hacker's Riddle</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/hack.css">
    <link rel="stylesheet" href="assets/dark.css">
    <script src="https://code.jquery.com/jquery-3.6.1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</head>

<div class="nav">
    <!-- <a class="button btn btn-success btn-ghost newq" href="leaderboard.php">Leaderboard</a> -->
    <a class="button btn btn-primary btn-ghost newq" href="index.php">Submission</a>
</div>

<body class="hack dark">
    <div class="grid main-form">
        <form class="form" id="challenge-form" method="POST">
            <fieldset class="form-group">
                <label for="challenge">Challenge:</label>
                <select id="challenge" name="challenge" class="form-control">
                    <?php
                    foreach ($challenges as $q => $c) {
                    ?>
                        <option value="<?= $q ?>"><?= $q ?></option>
                    <?php
                    }
                    ?>
                </select>
            </fieldset>
            <div>
                <p id="chall-content">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Alias sunt quis voluptatem, mollitia eos omnis velit accusamus totam nulla corrupti quisquam aut quibusdam ut quo dolore est magnam cupiditate explicabo.</p>
            </div>
            <fieldset class="form-group">
                <label for="username">Answer:</label>
                <input id="answer" name="answer" type="text" placeholder="" class="form-control">
            </fieldset>
            <div class="form-actions">
                <input type="submit" class="btn btn-primary btn-block btn-ghost" name="send" />
            </div>
        </form>
    </div>
    <div class="footer">
        O le ale strontos, vi gaskar magheda
    </div>
</body>
<script>
    $("#challenge-form").on('submit', function(e) {
        e.preventDefault();
        verifyAnswer(e);
    });

    function doTheBoom() {
        
    }

    function verifyAnswer(e) {
        let challenge = e.target.challenge.value;
        let answer = e.target.answer.value;
        $.post("controllers/ChallengeController.php", {
                challenge_index: challenge,
                answer: answer,
                verify_answer: true
            },
            function(data, status) {
                alert("Data: " + data + "\nStatus: " + status);
            });
    }
</script>

</html>