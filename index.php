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
    <link rel="stylesheet" href="assets/animation.css">

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
                <p id="chall-content"></p>
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
    <div id='displayout' class="hidden">
        <div id='output'></div>
    </div>
</body>
<script>
    $("#challenge-form").on('submit', function(e) {
        e.preventDefault();
        verifyAnswer(e);
    });

    $('#challenge').on('change', function() {
        let challenge = this.value;
        $.post("controllers/ChallengeController.php", {
                challenge_index: challenge,
                get_question: true
            },
            function(data, status) {
                $('#chall-content').html(data);
            });
    });

    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    function doTheBoom(finaltext) {
        $("#displayout").removeClass("hidden");
        $("#displayout").addClass("visible");

        // declare all characters
        const characters =
            "!#$%&'()*+,-./:;<=>?@[]^_`{|}~ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";


        iterations = finaltext.length + 20;

        function randomstr() {
            n = Math.random();
            n = n * characters.length;
            n = Math.floor(n);
            out = characters[n];
            return out;
        }

        var text = [];
        for (i = 0; i < finaltext.length; i++) {
            t = [];
            text.push(t);
        }

        for (i = 0; i < finaltext.length; i++) {
            t = text[i];
            for (j = 0; j < iterations - 20 * Math.random(); j++) {
                t.push(randomstr());
            }
            t.push(finaltext[i]);
        }
        //////////////////////////////////////////////////////////////////////////////
        // here we have ready arrays of random characters ending in expected letter///
        //////////////////////////////////////////////////////////////////////////////
        counter = 0;

        const elemout = document.getElementById("output");

        for (i = 0; i < finaltext.length; i++) {
            const outputpart = document.createElement("div");
            outputpart.classList.add("letters");
            outputpart.classList.add("redhacker");
            elemout.appendChild(outputpart);
            outputlist = document.getElementsByClassName("letters");
        }

        function change() {

            for (i = 0; i < finaltext.length; i++) {
                ft = text[i];
                if (counter < ft.length) {
                    outputlist[i].innerHTML = ft[counter];
                } else {
                    outputlist[i].innerHTML = ft[ft.length - 1];
                }

            };

            counter++;
        };

        const inst = setInterval(change, 100);
    }

    function verifyAnswer(e) {
        let challenge = e.target.challenge.value;
        let answer = e.target.answer.value;
        var audio = new Audio('assets/sound-alpha.mp3');
        audio.play();

        window.setTimeout(function(){
            $.post("controllers/ChallengeController.php", {
                challenge_index: challenge,
                answer: answer,
                verify_answer: true
            },
            function(data, status) {
                if (data === "success") {
                    doTheBoom("Pwned!!!");
                } else {
                    doTheBoom("Wrong :(");
                }
                window.setTimeout(function(){
                    window.location.reload();
                }, 10000);
            });   

        }, 500);
    }
</script>

</html>