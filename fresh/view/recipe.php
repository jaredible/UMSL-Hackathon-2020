<?php
/* PHP 7.4.2 */
/* Start Session */
session_start();

/* Make table headers */
$headerArray = array("Tournament", "Recipe", "Favorite", "Cart");

$recipe = array();
$recipe = ["Healthy Loaf Bread", "Sloppy Joes", "Vegetable Noodle Soup"];

$likes = [14, 18, 19];
$dislikes = [0, 0, 0];
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

    <!-- JS -->
    <script type="text/javascript" src="../js/misc.js"></script>
    <script type="text/javascript" src="../js/index.js"></script>
    <script type="text/javascript" src="../js/recipe.js"></script>

    <title>Recipe</title>
</head>

<body id="main-background" class="dimmable">
    <!-- No JavaScript Error Message -->
    <div id="javascript-warning" class="ui active dimmer">
        <div class="ui text loader"><i class="fa fa-exclamation-triangle"></i>&emsp;Error: Please enable JavaScript...</div>
    </div>

    <!-- Navigation Menu -->
    <div class="ui container">

        <!-- Navigation Menu -->
        <div class="ui borderless stackable no-top-border-radius no-margin inverted pointing menu">
            <!-- Menu Dropdown Button -->
            <a class="item"><i class="fa fa-bars"></i></a>
            &emsp;

            <!-- Page Menu -->
            <?php for ($i = 0; $i < count($headerArray); $i++) : ?>
                <a class="<?php if (basename(__FILE__, ".php") == strtolower($headerArray[$i])) : echo "active ";
                            endif; ?>item" href="./<?php echo strtolower($headerArray[$i]) ?>.php"><?php echo $headerArray[$i] ?></a>
            <?php endfor; ?>

            <!-- Refresh/Login Button -->
            <div class="right menu">
                <a class="item" href="<?php echo basename(__FILE__) ?>">
                    <i class="fa fa-refresh"></i>&emsp;Refresh
                </a>

                <?php if (!isset($_SESSION["user_id"])) : ?>
                    <a class="item" href="./login.php">
                        <i class="fa fa-user"></i>&emsp;Login
                    </a>
                <?php else : ?>
                    <form id="sign_out_form" action="../index.php" method="POST">
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

    <!-- List Recipes and redirect to recipe information after clicked Information -->
    <div class="ui container">
        <?php for ($i = 0; $i < count($recipe); $i++) { ?>
            <div class="ui link cards">
                <div class="card">
                    <div class="content">
                        <div class="header">
                            <a href="recipe-item.php?recipeItem=<?php print $i ?>"><?php print $recipe[$i] ?></a>
                        </div>
                    </div>
                    <div class="extra content">
                        <span class="right floated">
                            <div class="ui labeled button" tabindex="0">
                                <div id="like<?php print $i ?>" class="ui button">
                                    <i class="thumbs up icon"></i> Like
                                </div>
                                <span id="l-val<?php print $i ?>" class="ui basic label">
                                    <?php print $likes[$i] ?>
                                </span>
                            </div>
                            <div class="ui labeled button" tabindex="0">
                                <div id="dislike<?php print $i ?>" class="ui button">
                                    <i class="thumbs down icon"></i> Like
                                </div>
                                <span id="d-val<?php print $i ?>" class="ui basic label">
                                    <?php print $dislikes[$i] ?>
                                </span>
                            </div>
                        </span>
                        <span>
                            <button onclick="this.disabled=true" class="ui inverted green button">
                                <!-- onclick="window.location.href = './favoriteView.php'"  -->
                                Add to fav
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>


</body>

</html>