<?php
/* PHP 7.4.2 */
/* Start Session */
session_start();

/* Make table headers */
$headerArray = array("Tournament", "Recipe", "Favorite", "Cart");


/* NOTE: this is just a simulation for a database */
//Dummy data to display
if (isset($_POST["add_favorite"])) {
    if (isset($_SESSION["user_favorite_list"])) {
        $userList = $_SESSION["user_favorite_list"];
    } else {
        $userList = array();
    }

    if (is_numeric($_POST["add_favorite"])) {
        if ((in_array($_POST["add_favorite"], $userList)) === true) {
            $userList = array_diff($userList, array($_POST["add_favorite"]));
        } else {
            array_push($userList, $_POST["add_favorite"]);
        }
    }
    $_SESSION["user_favorite_list"] = $userList;
}

if (isset($_POST["add_cart"])) {
    if (isset($_SESSION["user_cart_list"])) {
        $userCartList = $_SESSION["user_cart_list"];
    } else {
        $userCartList = array();
    }

    if (is_numeric($_POST["add_cart"])) {
        if ((in_array($_POST["add_cart"], $userCartList)) === true) {
            $userCartList = array_diff($userCartList, array($_POST["add_cart"]));
        } else {
            array_push($userCartList, $_POST["add_cart"]);
        }
    }
    $_SESSION["user_cart_list"] = $userCartList;
}

if (isset($_SESSION["user_cart_list"])) {
    $cartPosition = $_SESSION["user_cart_list"];
} else {
    $cartPosition = array();
}

if (isset($_SESSION["user_favorite_list"])) {
    $favoritePosition = $_SESSION["user_favorite_list"];
} else {
    $favoritePosition = array();
}


$recipe = array(
    "Cinnamon Baked French Toast", "Brown Sugar Oatmeal Cookies", "Wafflemaker Hash Browns",
    "Pan Fried Pork Chops", "Chocolate Peanut Butter Pie", "Chicken Thighs with Creamy Mustard Sauce",
    "Cauliflower Pizza Crust", "Pesto Lasagna Rolls", "Chicken Tortilla Dump Dinner",
    "Chocolate Lava Cakes", "Alfredo Shrimp Scampi Dump Dinner", "Southern Red Velvet Cake"
);
$recipeDescription = array(
    "Ree Drummond's baked french toast is perfect for brunch or any special weekend breakfast.",
    "Brown sugar gives these sweet, baked treats a unique (and totally irresistible) flavor.",
    "Who knew that waffles and hashbrowns could be one and the same?!",
    "Golden-brown porkchops with a side of smashed new potatoes makes the perfect family-friendly weeknight meal.",
    "If pie crust intimidates you, try this sweet and easy-to-make chocolate cookie crust instead. It's the perfect base for creamy peanut butter filling.",
    "Chicken thighs are the unsung hero of weeknight dinners; they're inexpensive, versatile and delicious. In this recipe, Ina proves that they don't need much to become a delicious, crowd-pleasing meal.",
    "Katie Lee's cauliflower pizza is low in carbs but big on flavor. What's not to love?",
    "Each of these noodle roll-ups has just the right amount of filling and bakes in a fraction of the time that a traditional deep-dish lasagna would.",
    "All your favorite Tex-Mex flavors in a comforting casserole that's fast and easy to throw together.",
    "Get ready to impress your friends and family with this homemade dessert — bursting with warm, melted chocolate.",
    "Just dump a box of pasta, bag of shrimp and a few other pantry staples into a dish and bake. Right before serving, stir in the heavy cream and top with grated cheese and fresh parsley for a rich and creamy weeknight dinner in a flash.",
    "It's hard to go wrong with a classic. Red velvet cake is layered with sweet cream cheese frosting for a tasty and traditional treat."
);

/* Simulating getting like and dislike values */
if (!isset($_SESSION["likes"])) {
    $l = array_fill(0, 12, 0);
    $_SESSION["likes"] = $l;
}

if (!isset($_SESSION["dislikes"])) {
    $dl = array_fill(0, 12, 0);
    $_SESSION["dislikes"] = $dl;
}

$likes = $_SESSION["likes"];
$dislikes = $_SESSION["dislikes"];

/* Simulating updating like and dislike values */
if (isset($_POST["like_id"]) && isset($_POST["like_value"])) {
    $likes[intval($_POST["like_id"])] = intval($_POST["like_value"]);
    $_SESSION["likes"] = $likes;
}

if (isset($_POST["dislike_id"]) && isset($_POST["dislike_value"])) {
    $dislikes[intval($_POST["dislike_id"])] = intval($_POST["dislike_value"]);
    $_SESSION["dislikes"] = $dislikes;
}

//unset($_SESSION["likes"] , $_SESSION["dislikes"])
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
                    <a class="<?php if (basename(__FILE__, ".php") == strtolower($headerArray[$i])) : echo "active ";
                                endif; ?>item" href="./<?php echo strtolower($headerArray[$i]) ?>.php"><?php echo $headerArray[$i] ?></a>
                <?php endif; ?>
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

    <!-- List recipes and redirect to recipe information after clicked information -->
    <div class="ui container">
        <div class="ui four stackable cards">
            <?php for ($i = 0; $i < count($recipe); $i++) : ?>
                <a class="ui black card">
                    <div class="content">
                        <div class="header"><?php echo $recipe[$i] ?></div>
                        <div class="description">
                            <p><?php echo $recipeDescription[$i] ?></p>
                        </div>
                    </div>

                    <?php if (isset($_SESSION["user_id"])) : ?>
                        <div class="extra content">
                            <div class="left floated">
                                <div class="ui labeled button">
                                    <button id="like<?php echo $i ?>" class="ui compact green button">
                                        <i class="fa fa-thumbs-up"></i>
                                    </button>
                                    <span id="l-val<?php echo $i ?>" class="ui basic green label">
                                        <?php echo $likes[$i] ?>
                                    </span>
                                </div>
                            </div>

                            <div class="right floated">
                                <div class="ui labeled button">
                                    <button id="dislike<?php echo $i ?>" class="ui compact red button">
                                        <i class="fa fa-thumbs-down"></i>
                                    </button>
                                    <span id="d-val<?php echo $i ?>" class="ui basic red label">
                                        <?php echo $dislikes[$i] ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="extra content">
                        <div class="left floated">
                            <button id="like<?php echo $i ?>" class="ui compact teal button" onclick="window.location.href ='recipe-item.php?recipeItem=<?php echo $i ?>'">
                                <i class="fa fa-list"></i>&emsp;More
                            </button>
                        </div>

                        <?php if (isset($_SESSION["user_id"])) : ?>
                            <form action="recipe.php" method="POST">
                                <div class="right floated">
                                    <div class="ui buttons">
                                        <button class="ui compact yellow button" type="submit">
                                            <input type="hidden" name="add_favorite" value="<?php echo $i ?>" />
                                            <?php if (in_array($i, $favoritePosition)) : ?>
                                                <i class="fa fa-star"></i>
                                            <?php else : ?>
                                                <i class="fa fa-star-o"></i>
                                            <?php endif; ?>
                                        </button>
                                        <button class="ui compact blue button">
                                            <input type="hidden" name="add_cart" value="<?php echo $i ?>" />
                                            <i class="fa fa-cart-plus"></i></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </a>
            <?php endfor; ?>
        </div>
    </div>
</body>

</html>