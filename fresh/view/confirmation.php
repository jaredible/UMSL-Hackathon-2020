<?php
/* PHP 7.4.2 */
/* Start Session */
session_start();

/* If user didn't submit from cart page, redirect to a specific page */
if (!isset($_POST["submit_cart"])) {
    header("Location: ./cart.php");
    exit();
}

/* Make table headers */
$headerArray = array("Tournament", "Recipe", "Favorite", "Cart");

$ingredient_name = array('apple', 'beef', 'cilantro');
$ingredient_measure = array('count', 'lbs', 'bunch');
$total_amount = array(4, 2, 1);

$order_ingredient_name = [];
$order_ingredient_total = [];
$order_ingredient_measure = [];
foreach ($ingredient_name as $element) {
    if (isset($_POST[$element . '_check'])) {
        if ($_POST[$element . '_check'] == 'on') {
            array_push($order_ingredient_name, $_POST[$element]);
            array_push($order_ingredient_total, $_POST[$element . '_total']);
            array_push($order_ingredient_measure, $_POST[$element . '_measure']);
        }
    }
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

    <title>Confirmation</title>
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
                <?php if (in_array(strtolower($headerArray[$i]), array("tournament"))) : ?>
                    <a class="<?php if (basename(__FILE__, ".php") == strtolower($headerArray[$i])) : echo "active ";
                                endif; ?>item" href="../tournament/<?php echo strtolower($headerArray[$i]) ?>.php"><?php echo $headerArray[$i] ?></a>
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

    <!-- Ingredient Table -->
    <div class="ui container">
        <form class="ui form" method="POST" action="payment.php">
            <table class="ui selectable fixed inverted striped grey table">
                <!-- Column Name: Label -->
                <thead>
                    <tr class="center aligned">
                        <th><strong>Ingredient Name</strong></th>
                        <th><strong>Total Amount</strong></th>
                        <th><strong>Measure</strong></th>
                        <th><strong>Include</strong></th>
                    </tr>
                </thead>

                <!-- Display Data -->
                <tbody>
                    <div class="field">
                        <?php for ($i = 0; $i < count($ingredient_name); $i++) : ?>
                            <tr class="center aligned">
                                <td>
                                    <div class="field">
                                        <p><?php echo ucwords($ingredient_name[$i]) ?></p>
                                        <input type="hidden" name="<?php echo $ingredient_name[$i] ?>" value="<?php echo $ingredient_name[$i] ?>">
                                    </div>
                                </td>
                                <td>
                                    <div class="field">
                                        <p><?php echo $total_amount[$i] ?></p>
                                        <input type="hidden" name="<?php echo $ingredient_name[$i] ?>_total" value="<?php echo $total_amount[$i] ?>">
                                    </div>
                                </td>
                                <td>
                                    <p><?php echo $ingredient_measure[$i] ?></p>
                                    <input class="right aligned" type="hidden" name="<?php echo $ingredient_name[$i] ?>_measure" value="<?php echo $ingredient_measure[$i] ?>">
                                </td>
                                <td>
                                    <div class="ui checkbox">
                                        <input type="checkbox" name="<?php echo $ingredient_name[$i] ?>_check" checked>
                                        <label></label>
                                    </div>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </div>
                </tbody>
            </table>
            <button class="ui right floated red button" onclick="window.location.href ='cart.php'">Cancel</button>
            <button class="ui right floated green button" type="submit" name="confirmation_submit"">Proceed</button>
        </form>
    </div>
</body>

</html>