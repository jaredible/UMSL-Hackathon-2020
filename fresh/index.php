<?php
/* PHP 7.4.2 */
/* Start Session */
session_start();

/* Sign out admin mode */
//Check to see if the sign out button has been pressed.
if (isset($_POST["sign_out"])) {
    unset($_SESSION["user_id"]);
    $_SESSION["database_message"] = "Signed out successfully!";
    $_SESSION["database_message_type"] = "success";

    header("Location: ./index.php");
    exit();
}

/* Make table headers */
$headerArray = array("Tournament", "Recipe", "Favorite", "Cart");
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
    <link rel="stylesheet" type="text/css" href="css/main.css" />

    <!-- JS -->
    <script type="text/javascript" src="js/misc.js"></script>

    <title>Home</title>
</head>

<body id="main-background" class="dimmable">
    <!-- No JavaScript Error Message -->
    <div id="javascript-warning" class="ui active dimmer">
        <div class="ui text loader"><i class="fa fa-exclamation-triangle"></i>&emsp;Error: Please enable JavaScript...</div>
    </div>

    <!-- Database Message -->
    <?php if (isset($_SESSION["database_message"])) : ?>
        <div class="ui <?php echo $_SESSION["database_message_type"]; ?> no-margin message">
            <i class="close icon"></i>
            <div class="header">
                <?php echo (strcasecmp($_SESSION["database_message_type"], "negative") == 0) ? "Error" : ucwords($_SESSION["database_message_type"]) ?>
            </div>
            <p><?php echo $_SESSION["database_message"] ?></p>
        </div>
    <?php endif; ?>

    <!-- Navigation Menu -->
    <div class="ui container">
        <!-- Navigation Menu -->
        <div class="ui borderless stackable no-top-border-radius  no-margin inverted pointing menu">
            <!-- Home Button -->
            <a class="item" href="index.php"><i class="fa fa-home"></i></a>
            &emsp;

            <!-- Page Menu -->
            <?php for ($i = 0; $i < count($headerArray); $i++) : ?>
                <?php if (in_array(strtolower($headerArray[$i]), array("favorite", "cart"))) : ?>
                    <?php if (isset($_SESSION["user_id"])) : ?>
                        <a class="<?php if (basename(__FILE__, ".php") == strtolower($headerArray[$i])) : echo "active ";
                                    endif; ?>item" href="./view/<?php echo strtolower($headerArray[$i]) ?>.php"><?php echo $headerArray[$i] ?></a>
                    <?php endif; ?>
                <?php else : ?>
                    <?php if (in_array(strtolower($headerArray[$i]), array("tournament"))) : ?>
                        <a class="<?php if (basename(__FILE__, ".php") == strtolower($headerArray[$i])) : echo "active ";
                                    endif; ?>item" href="./tournament/<?php echo strtolower($headerArray[$i]) ?>.php"><?php echo $headerArray[$i] ?></a>
                    <?php else : ?>
                        <a class="<?php if (basename(__FILE__, ".php") == strtolower($headerArray[$i])) : echo "active ";
                                    endif; ?>item" href="./view/<?php echo strtolower($headerArray[$i]) ?>.php"><?php echo $headerArray[$i] ?></a>
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

    <!-- Display Information -->
    <div class="ui container">
        <!-- Display Information -->
        <div class="ui container">
            <img class="ui fluid image-brightness image" alt="https://www.gannett-cdn.com/-mm-/4a626df9bec418678fe2bddeec6b91e0a2236529/c=12-0-5630-3174/local/-/media/2016/05/26/USATODAY/USATODAY/635998479840624001-HandsShot.jpeg?width=660&amp;height=373&amp;fit=crop&amp;format=pjpg&amp;auto=webp" src="./public/img/main-background.jpeg">
            <div class="center-overlay">
                <div class="ui transparent segment">
                    <h1 class="ui intro-text white header">
                        Our Mission
                    </h1>

                    <div class="ui semi-black-transparent segment">
                        <p class="sub-intro-text"><strong>As Fresh</strong>, our goal is to reduce food waste in local communities for grocery stores, supermarkets, and consumers. Fresh's objective, in partnership with retailers, is to reduce food waste for retailers and consumers, as well as finding ways to reduce our carbon foot-print and unnecessary waste in our communities.
                        </p>
                    </div>

                    <div class="ui hidden divider"></div>

                    <div class="container-center">
                        <a class="ui olive big button" href="./view/login.php">
                            Get Started
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui container">
            <div class="ui no-top-border-radius no-bottom-border-radius segment">
                <div class="ui three column very relaxed grid">
                    <div class="column">
                        <div class="container-center sub-intro-text-black">
                            <strong>
                                <p>Problem</p>
                            </strong>
                        </div>
                        <p>Americans spend an estimated 165 billion dollars on wasted food annually (Gunders 4). Gunders found the in-store food loss estimate was 43 billion pounds in 2008, which amounts to ten percent of the total food supply of retailers in the U.S. In-store food loss in 2008 estimated to be 43 billion pounds, ten percent of the total food supply of retailers(10)</p>
                        <p><i>Source: Dana Gunders, NRDC, Aug. 2012</i></p>
                    </div>
                    <div class="column">
                        <div class="container-center sub-intro-text-black">
                            <strong>
                                <p>Pre-Purchasing</p>
                            </strong>
                        </div>
                        <p>By pre-purchasing the proper ingredients for the planned recipes allows consumers to save time and money. Consumers will save time and money since consumers will not need to search for the correct items and quantities.</p>
                        <p><i>Source: Dana Gunders, NRDC, Aug. 2012</i></p>
                    </div>
                    <div class="column">
                        <div class="container-center sub-intro-text-black">
                            <strong>
                                <p>Retailers</p>
                            </strong>
                        </div>
                        <p>For retailers, by allowing for consumers to pre-purchase specific quantities of items for our listed recipes, it allows for the retailers to set aside inventory that will be set aside for the consumers orders.</p>
                        <p><i>Source: Dana Gunders, NRDC, Aug. 2012</i></p>
                    </div>
                </div>

                <div class="ui hidden divider"></div>

                <div class="container-center">
                    <p><i>NRDC: Wasted - How America Is Losing Up to 40 Percent of Its Food from Farm to Fork to Landfill, NRDC, Aug. 2012, www.nrdc.org/sites/default/files/wasted-food-IP.pdf.</i></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
/* Remove specific session */
unset($_SESSION["database_message"]);
unset($_SESSION["database_message_type"]);
unset($_SESSION["is_edit"]);
unset($_SESSION["row-edit"]);
unset($_SESSION["data_output"]);
?>