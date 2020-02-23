<?php
/* PHP 7.4.2 */
/* Start Session */
session_start();

/* Make table headers */
$headerArray = array("Tournament", "Recipe", "Favorite", "Cart");

$recipe = array();
$fav_recipe = ["Healthy Loaf Bread", "Sloppy Joes"];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="ISO-8859-1">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Semantic UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- Font Awesome 4 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../css/main.css" />
    <link rel="stylesheet" type="text/css" href="tournament.css" />
    <!-- JS -->
    <script type="text/javascript" src="../js/misc.js"></script>
    <script type="text/javascript" src="../js/index.js"></script>

    <script>
        const recipes = [
            "Shrimp Scampi",
            "Oven Baked Salmon",
            "Tomato Soup",
            "Chicken Noodle Soup",
            "Vegetable Lasagne",
            "Vegetable Enchiladas",
            "Pumpkin Pie",
            "Chocolate Pie"
        ];

        function start(index, counter, participant, other, biased, checkRoundFinished, max_votes, round_num) {
            if (counter < max_votes) {
                setTimeout(function() {
                    if (parseInt(other.find("span:last").text()) === max_votes) {
                        return;
                    }
                    if (Math.random() >= 0.5 || biased) {
                        counter += Math.floor(1 + Math.random() * 3 * (biased ? 3 : 1));
                    }
                    if (counter > max_votes) {
                        counter = max_votes;
                    }
                    if (counter === max_votes) {
                        participant.addClass("winner");
                        checkRoundFinished();
                    }
                    participant.find("span:last").text(counter);
                    start(index, counter, participant, other, biased, checkRoundFinished, max_votes, round_num);
                }, Math.floor(10 + Math.random() * (400 - round_num * 100) * (biased ? 0.5 : 1)) * 10);
            }
        }

        function checkRound1Finished() {
            if ($(".round.quarterfinals").find(".winner").length === 4) {
                let winners = $(".round.quarterfinals").find(".winner");
                let winner1 = $(".round.quarterfinals .winners:first .matchup:first .participant.winner");
                let winner2 = $(".round.quarterfinals .winners:first .matchup:last .participant.winner");
                let winner3 = $(".round.quarterfinals .winners:last .matchup:first .participant.winner");
                let winner4 = $(".round.quarterfinals .winners:last .matchup:last .participant.winner");
                $(".round.semifinals .winners .matchup:first .participant:first span:first").text(winner1.find("span:first").text());
                $(".round.semifinals .winners .matchup:first .participant:first span:last").text("0");
                $(".round.semifinals .winners .matchup:first .participant:last span:first").text(winner2.find("span:first").text());
                $(".round.semifinals .winners .matchup:first .participant:last span:last").text("0");
                $(".round.semifinals .winners .matchup:last .participant:first span:first").text(winner3.find("span:first").text());
                $(".round.semifinals .winners .matchup:last .participant:first span:last").text("0");
                $(".round.semifinals .winners .matchup:last .participant:last span:first").text(winner4.find("span:first").text());
                $(".round.semifinals .winners .matchup:last .participant:last span:last").text("0");
                console.log("round 1 end");
                setTimeout(function() {
                    doRound2();
                }, 5000);
            }
        }

        function doRound1() {
            console.log("round 1 begin");
            $(".bracket section.round.quarterfinals .winners .matchup .participants").each(function(index, value) {
                let first = $(this).find(".participant:first");
                let second = $(this).find(".participant:last");
                let biased = Math.random() >= 0.5;
                start(index, 0, first, second, biased, checkRound1Finished, 50, 1);
                start(index, 0, second, first, !biased, checkRound1Finished, 50, 1);
            });
        }

        function checkRound2Finished() {
            if ($(".round.semifinals").find(".winner").length === 2) {
                let winners = $(".round.semifinals").find(".winner");
                let winner1 = $(".round.semifinals .winners .matchup:first .participant.winner");
                let winner2 = $(".round.semifinals .winners .matchup:last .participant.winner");
                console.log(winners);
                console.log(winner1);
                console.log(winner2);
                $(".round.finals .winners .matchup:first .participant:first span:first").text(winner1.find("span:first").text());
                $(".round.finals .winners .matchup:first .participant:first span:last").text(0);
                $(".round.finals .winners .matchup:last .participant:last span:first").text(winner2.find("span:first").text());
                $(".round.finals .winners .matchup:last .participant:last span:last").text(0);
                console.log("round 2 end");
                setTimeout(function() {
                    doRound3();
                }, 5000);
            }
        }

        function doRound2() {
            console.log("round 2 begin");
            $(".bracket section.round.semifinals .winners .matchup .participants").each(function(index, value) {
                let first = $(this).find(".participant:first");
                let second = $(this).find(".participant:last");
                let biased = Math.random() >= 0.5;
                start(index, 0, first, second, biased, checkRound2Finished, 100, 2);
                start(index, 0, second, first, !biased, checkRound2Finished, 100, 2);
            });
        }

        function checkRound3Finished() {
            console.log("round 3 end");
        }

        function doRound3() {
            console.log("round 3 begin");
            $(".bracket section.round.finals .winners .matchup .participants").each(function(index, value) {
                let first = $(this).find(".participant:first");
                let second = $(this).find(".participant:last");
                let biased = Math.random() >= 0.5;
                start(index, 0, first, second, biased, checkRound3Finished, 200, 3);
                start(index, 0, second, first, !biased, checkRound3Finished, 200, 3);
            });
        }

        function beginTournament() {
            $(".bracket section.round.quarterfinals .winners .matchup .participants .participant").each(function(index, value) {
                let participant = $(this);
                setTimeout(function() {
                    let recipe_name = recipes[index];
                    let num_votes = 0;
                    participant.find("span:first").text(recipe_name);
                    participant.find("span:last").text(num_votes);
                }, index * 100);
            });
            setTimeout(function() {
                doRound1();
            }, 5000);
        }

        $(function() {
            setTimeout(function() {
                beginTournament();
            }, 5000);
        });
    </script>

    <title>Favorite</title>
</head>

<body id="main-background" class="dimmable">
    <!-- No JavaScript Error Message -->
    <div id="javascript-warning" class="ui active dimmer">
        <div class="ui text loader"><i class="fa fa-exclamation-triangle"></i>&emsp;Error: Please enable JavaScript...</div>
    </div>

    <!-- Navigation Menu -->
    <div class="ui container">
        <!-- Navigation Menu -->
        <div class="ui borderless stackable no-top-border-radius  no-margin inverted pointing menu">
            <!-- Home Button -->
            <a class="item" href="../index.php"><i class="fa fa-home"></i></a>
            &emsp;

            <!-- Page Menu -->
            <?php for ($i = 0; $i < count($headerArray); $i++) : ?>
                <?php if (in_array(strtolower($headerArray[$i]), array("favorite", "cart"))) : ?>
                    <?php if (isset($_SESSION["user_id"])) : ?>
                        <a class="<?php if (basename(__FILE__, ".php") == strtolower($headerArray[$i])) : echo "active ";
                                    endif; ?>item" href="../view/<?php echo strtolower($headerArray[$i]) ?>.php"><?php echo $headerArray[$i] ?></a>
                    <?php endif; ?>
                <?php else : ?>
                    <?php if (in_array(strtolower($headerArray[$i]), array("tournament"))) : ?>
                        <a class="<?php if (basename(__FILE__, ".php") == strtolower($headerArray[$i])) : echo "active ";
                                    endif; ?>item" href="./<?php echo strtolower($headerArray[$i]) ?>.php"><?php echo $headerArray[$i] ?></a>
                    <?php else : ?>
                        <a class="<?php if (basename(__FILE__, ".php") == strtolower($headerArray[$i])) : echo "active ";
                                    endif; ?>item" href="../view/<?php echo strtolower($headerArray[$i]) ?>.php"><?php echo $headerArray[$i] ?></a>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endfor; ?>

            <!-- Refresh/Login Button -->
            <div class="right menu">
                <a class="item" href="<?php echo basename(__FILE__) ?>">
                    <i class="fa fa-refresh"></i>&emsp;Refresh
                </a>

                <?php if (!isset($_SESSION["user_id"])) : ?>
                    <a class="item" href="./view/login.php">
                        <i class="fa fa-user"></i>&emsp;Login
                    </a>
                <?php else : ?>
                    <form id="sign_out_form" action="./index.php" method="POST">
                        <input type="hidden" name="sign_out" />
                        <a class="item" onclick="document.getElementById('sign_out_form').submit()">
                            <i class="fa fa-sign-out"></i>&emsp;Sign Out
                        </a>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="ui hidden divider"></div>

    <!-- Tournament Brackets -->
    <div class="bracket">
        <section class="round quarterfinals">
            <div class="winners">
                <div class="matchups">
                    <div class="matchup">
                        <div class="participants">
                            <div class="participant" style="width: 275px;">
                                <div style="display: inline-flex; flex-direction: row; float: left; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                                <div style="display: inline-flex; flex-direction: row; float: right; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                            </div>
                            <div class="participant" style="width: 275px;">
                                <div style="display: inline-flex; flex-direction: row; float: left; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                                <div style="display: inline-flex; flex-direction: row; float: right; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="matchup">
                        <div class="participants">
                            <div class="participant" style="width: 275px;">
                                <div style="display: inline-flex; flex-direction: row; float: left; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                                <div style="display: inline-flex; flex-direction: row; float: right; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                            </div>
                            <div class="participant" style="width: 275px;">
                                <div style="display: inline-flex; flex-direction: row; float: left; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                                <div style="display: inline-flex; flex-direction: row; float: right; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="connector">
                    <div class="merger"></div>
                    <div class="line"></div>
                </div>
            </div>
            <div class="winners">
                <div class="matchups">
                    <div class="matchup">
                        <div class="participants">
                            <div class="participant" style="width: 275px;">
                                <div style="display: inline-flex; flex-direction: row; float: left; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                                <div style="display: inline-flex; flex-direction: row; float: right; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                            </div>
                            <div class="participant" style="width: 275px;">
                                <div style="display: inline-flex; flex-direction: row; float: left; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                                <div style="display: inline-flex; flex-direction: row; float: right; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="matchup">
                        <div class="participants">
                            <div class="participant" style="width: 275px;">
                                <div style="display: inline-flex; flex-direction: row; float: left; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                                <div style="display: inline-flex; flex-direction: row; float: right; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                            </div>
                            <div class="participant" style="width: 275px;">
                                <div style="display: inline-flex; flex-direction: row; float: left; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                                <div style="display: inline-flex; flex-direction: row; float: right; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="connector">
                    <div class="merger"></div>
                    <div class="line"></div>
                </div>
            </div>
        </section>
        <section class="round semifinals">
            <div class="winners">
                <div class="matchups">
                    <div class="matchup">
                        <div class="participants">
                            <div class="participant" style="width: 275px;">
                                <div style="display: inline-flex; flex-direction: row; float: left; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                                <div style="display: inline-flex; flex-direction: row; float: right; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                            </div>
                            <div class="participant" style="width: 275px;">
                                <div style="display: inline-flex; flex-direction: row; float: left; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                                <div style="display: inline-flex; flex-direction: row; float: right; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="matchup">
                        <div class="participants">
                            <div class="participant" style="width: 275px;">
                                <div style="display: inline-flex; flex-direction: row; float: left; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                                <div style="display: inline-flex; flex-direction: row; float: right; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                            </div>
                            <div class="participant" style="width: 275px;">
                                <div style="display: inline-flex; flex-direction: row; float: left; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                                <div style="display: inline-flex; flex-direction: row; float: right; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="connector">
                    <div class="merger"></div>
                    <div class="line"></div>
                </div>
            </div>
        </section>
        <section class="round finals">
            <div class="winners">
                <div class="matchups">
                    <div class="matchup">
                        <div class="participants">
                            <div class="participant" style="width: 275px;">
                                <div style="display: inline-flex; flex-direction: row; float: left; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                                <div style="display: inline-flex; flex-direction: row; float: right; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                            </div>
                            <div class="participant" style="width: 275px;">
                                <div style="display: inline-flex; flex-direction: row; float: left; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                                <div style="display: inline-flex; flex-direction: row; float: right; margin-right: 0; margin-left: .25em;">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</body>

</html>