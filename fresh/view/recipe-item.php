<?php
/* PHP 7.4.2 */
/* Start Session */
session_start();

/* Make table headers */
$headerArray = array("Tournament", "Recipe", "Favorite", "Cart");

/* NOTE: this is just a simulation for a database*/
$recipe = array(
    "Cinnamon Baked French Toast", "Brown Sugar Oatmeal Cookies", "Wafflemaker Hash Browns",
    "Pan Fried Pork Chops", "Chocolate Peanut Butter Pie", "Chicken Thighs with Creamy Mustard Sauce",
    "Cauliflower Pizza Crust", "Pesto Lasagna Rolls", "Chicken Tortilla Dump Dinner",
    "Chocolate Lava Cakes", "Alfredo Shrimp Scampi Dump Dinner", "Southern Red Velvet Cake"
);
$recipeInstruction = array(
    "Cook XYZ",
    "Cook XYZ",
    "Cook XYZ",
    "Cook XYZ",
    "Cook XYZ",
    "Cook XYZ",
    "Cook XYZ",
    "Cook XYZ",
    "Cook XYZ",
    "Cook XYZ",
    "Cook XYZ",
    "Cook XYZ"
);

$index = 0;
if (isset($_GET['recipeItem'])) {
    $index = intval($_GET['recipeItem']);
}
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

    <title>Recipe Item</title>
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
            <!-- Home Button -->
            <a class="item" href="../index.php"><i class="fa fa-home"></i></a>
            &emsp;

            <!-- Page Menu -->
            <?php for ($i = 0; $i < count($headerArray); $i++) : ?>
                <?php if (in_array(strtolower($headerArray[$i]), array("favorite", "cart"))) : ?>
                    <?php if (isset($_SESSION["user_id"])) : ?>
                        <a class="<?php if (basename(__FILE__, ".php") == strtolower($headerArray[$i])) : echo "active ";
                                    endif; ?>item" href="./<?php echo strtolower($headerArray[$i]) ?>.php"><?php echo $headerArray[$i] ?></a>
                    <?php endif; ?>
                <?php else : ?>
                    <?php if (in_array(strtolower($headerArray[$i]), array("tournament"))) : ?>
                        <a class="<?php if (basename(__FILE__, ".php") == strtolower($headerArray[$i])) : echo "active ";
                                    endif; ?>item" href="../tournament/<?php echo strtolower($headerArray[$i]) ?>.php"><?php echo $headerArray[$i] ?></a>
                    <?php else : ?>
                        <a class="<?php if (basename(__FILE__, ".php") == strtolower($headerArray[$i])) : echo "active ";
                                    endif; ?>item" href="./<?php echo strtolower($headerArray[$i]) ?>.php"><?php echo $headerArray[$i] ?></a>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endfor; ?>

            <!-- Refresh/Login Button -->
            <div class="right menu">
                <a class="item" href="<?php echo basename(__FILE__) ?>?recipeItem=<?php echo $index ?>">
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

    <!-- List recipes and redirect to recipe information after clicked information -->
    <div class="ui container">
        <a class="ui fluid black card">
            <div class="content">
                <div class="header"><?php echo $recipe[$index] ?></div>
                <div class="description">
                    <p><?php echo $recipeInstruction[$index] ?></p>
                </div>
            </div>
            <div class="extra content">
                <div class="left floated">
                    <button id="like<?php print $i ?>" class="ui compact teal button" onclick="window.location.href ='recipe.php'">
                        <i class="fa fa-undo"></i>&emsp;Go Back
                    </button>
                </div>
            </div>
        </a>
    </div>
</body>

</html>