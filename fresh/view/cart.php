<?php
/* PHP 7.4.2 */
/* Start Session */
session_start();

/* If user didn't login, redirect to a specific page */
if (!isset($_SESSION["user_id"])) {
    header("Location: ./login.php");
    exit();
}

/* NOTE: this is just a simulation for a database*/
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

/* Make table headers */
$headerArray = array("Tournament", "Recipe", "Favorite", "Cart");

$ingredient_name_1 = array('potato', 'beef', 'cilantro', 'cucumber');
$ingredient_name_2 = array('tomato', 'butter', 'rice', 'olive');
$ingredient_name_3 = array('onions', 'garlic', 'lettuce', 'cheese');
$ingredient_name_4 = array('beans', 'corn', 'pork', 'flour');

$ingredient_measure = array('count', 'lbs', 'bunch', 'oz');
$total_amount = array(4, 2, 1, 5);


$recipe = array(
    "Cinnamon Baked French Toast", "Brown Sugar Oatmeal Cookies", "Wafflemaker Hash Browns",
    "Pan Fried Pork Chops", "Chocolate Peanut Butter Pie", "Chicken Thighs with Creamy Mustard Sauce",
    "Cauliflower Pizza Crust", "Pesto Lasagna Rolls", "Chicken Tortilla Dump Dinner",
    "Chocolate Lava Cakes", "Alfredo Shrimp Scampi Dump Dinner", "Southern Red Velvet Cake"
);


function printIngredient ($item_1, $item_2){
    if($item_1 == $item_2) :
        ?>
        <p><?php echo ucwords($item_1) ?></p>
        <input type="hidden" name="<?php echo $item_1?>" value="<?php echo $item_1 ?>">
    <?php
        return true;
    endif;
    return false;
}

function testIngredient($mainIng, $ing_1, $ing_2, $ing_3){

    $bool_ing = [];
    if(printIngredient($mainIng,  $ing_1)) :
        array_push($bool_ing, 1);
    endif;
    if(printIngredient($mainIng,  $ing_2)) :
        array_push($bool_ing, 2);
    endif;
    if(printIngredient($mainIng,  $ing_3)) :
        array_push($bool_ing, 3);
    endif;

    return $bool_ing;
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

    <title>Cart</title>
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

    <!-- Ingredient Table -->
    <div class="ui container">
        <form class="ui form" method="POST" action="confirmation.php">
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
                        <?php for ($i = 0; $i < count($recipe); $i++) : ?>
                        <?php if (in_array($i, $cartPosition)) : ?>
                            <tr class="center aligned">
                                <td>
                                    <div class="field">
<!--                                        --><?php
//                                        $ings_exist = [true, true, true, true];
//                                        if ($ings_exist[0]):
//                                            $test_ings = testIngredient($ingredient_name_1[$i],$ingredient_name_2[$i], $ingredient_name_3[$i], $ingredient_name_4[$i]);
//                                            for ($j=0; $j<count($test_ings); $j++):
//                                                $ings_exist[$test_ings[$j]] = false;
//                                                echo $test_ings[$j]." I am in 1\n";
//                                            endfor;
//                                            ?>
<!--                                            <p>--><?php //echo ucwords($ingredient_name_1[$i]) ?><!--</p>-->
<!--                                            <input type="hidden" name="--><?php //echo $ingredient_name_1[$i] ?><!--" value="--><?php //echo $ingredient_name_1[$i] ?><!--">-->
<!--                                        --><?php
//                                        endif;
//                                        if ($ings_exist[1]):
//                                            $test_ings = testIngredient($ingredient_name_2[$i], $ingredient_name_1[$i], $ingredient_name_3[$i], $ingredient_name_4[$i]);
//                                            for ($j=0; $j<count($test_ings); $j++):
//                                                $ings_exist[$test_ings[$j]] = false;
//                                                echo $test_ings[$j]." I am in 2\n";
//                                            endfor;
//                                            ?>
<!--                                            <p>--><?php //echo ucwords($ingredient_name_2[$i]) ?><!--</p>-->
<!--                                            <input type="hidden" name="--><?php //echo $ingredient_name_2[$i] ?><!--" value="--><?php //echo $ingredient_name_2[$i] ?><!--">-->
<!--                                        --><?php
//                                        endif;
//                                        if ($ings_exist[2]):
//                                            $test_ings = testIngredient($ingredient_name_3[$i], $ingredient_name_1[$i],$ingredient_name_2[$i], $ingredient_name_4[$i]);
//                                            for ($j=0; $j<count($test_ings); $j++):
//                                                $ings_exist[$test_ings[$j]] = false;
//                                                echo $test_ings[$j]." I am in 3\n";
//                                            endfor;
//                                            ?>
<!--                                            <p>--><?php //echo ucwords($ingredient_name_3[$i]) ?><!--</p>-->
<!--                                            <input type="hidden" name="--><?php //echo $ingredient_name_3[$i] ?><!--" value="--><?php //echo $ingredient_name_3[$i] ?><!--">-->
<!--                                        --><?php
//                                        endif;
//                                        if ($ings_exist[3]):
//                                            $test_ings = testIngredient($ingredient_name_4[$i], $ingredient_name_1[$i],$ingredient_name_2[$i], $ingredient_name_3[$i]);
//                                            for ($j=0; $j<count($test_ings); $j++):
//                                                $ings_exist[$test_ings[$j]] = false;
//                                                echo $test_ings[$j]." I am in 4\n";
//                                            endfor;
//                                            ?>
<!--                                            <p>--><?php //echo ucwords($ingredient_name_4[$i]) ?><!--</p>-->
<!--                                            <input type="hidden" name="--><?php //echo $ingredient_name_4[$i] ?><!--" value="--><?php //echo $ingredient_name_4[$i] ?><!--">-->
<!--                                        --><?php
//                                        endif;
//                                        ?>

                                        <p><?php echo ucwords($ingredient_name_1[0]) ?></p>
                                        <input type="hidden" name="<?php echo $ingredient_name_1[0] ?>" value="<?php echo $ingredient_name_1[0] ?>">
                                        <p><?php echo ucwords($ingredient_name_2[1]) ?></p>
                                        <input type="hidden" name="<?php echo $ingredient_name_2[1] ?>" value="<?php echo $ingredient_name_2[1] ?>">
                                        <p><?php echo ucwords($ingredient_name_3[2]) ?></p>
                                        <input type="hidden" name="<?php echo $ingredient_name_3[2] ?>" value="<?php echo $ingredient_name_3[2] ?>">
                                        <p><?php echo ucwords($ingredient_name_4[3]) ?></p>
                                        <input type="hidden" name="<?php echo $ingredient_name_4[3] ?>" value="<?php echo $ingredient_name_4[3] ?>">

                                    </div>
                                </td>
                                <td>
                                    <div class="field">
                                        <p><?php shuffle($total_amount); echo $total_amount[0] ?></p>
                                        <input type="hidden" name="<?php echo $ingredient_name_1[0] ?>_total" value="<?php echo $total_amount[0] ?>">
                                        <p><?php shuffle($total_amount); echo $total_amount[1] ?></p>
                                        <input type="hidden" name="<?php echo $ingredient_name_2[1] ?>_total" value="<?php echo $total_amount[1] ?>">
                                        <p><?php shuffle($total_amount); echo $total_amount[2] ?></p>
                                        <input type="hidden" name="<?php echo $ingredient_name_3[2] ?>_total" value="<?php echo $total_amount[2] ?>">
                                        <p><?php shuffle($total_amount); echo $total_amount[3] ?></p>
                                        <input type="hidden" name="<?php echo $ingredient_name_4[3] ?>_total" value="<?php echo $total_amount[3] ?>">
                                    </div>
                                </td>
                                <td>
                                    <p><?php shuffle($ingredient_measure); echo $ingredient_measure[0] ?></p>
                                    <input class="right aligned" type="hidden" name="<?php echo $ingredient_name_1[0] ?>_measure" value="<?php echo $ingredient_measure[0] ?>">
                                    <p><?php shuffle($ingredient_measure); echo $ingredient_measure[1] ?></p>
                                    <input class="right aligned" type="hidden" name="<?php echo $ingredient_name_2[1] ?>_measure" value="<?php echo $ingredient_measure[1] ?>">
                                    <p><?php shuffle($ingredient_measure); echo $ingredient_measure[2] ?></p>
                                    <input class="right aligned" type="hidden" name="<?php echo $ingredient_name_3[2] ?>_measure" value="<?php echo $ingredient_measure[2] ?>">
                                    <p><?php shuffle($ingredient_measure); echo $ingredient_measure[3] ?></p>
                                    <input class="right aligned" type="hidden" name="<?php echo $ingredient_name_4[3] ?>_measure" value="<?php echo $ingredient_measure[3] ?>">
                                </td>
                                <td>
                                    <div class="ui checkbox">
                                        <input type="checkbox" name="<?php echo $ingredient_name_1[$i] ?>_check" checked>
                                        <label></label>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </tbody>
            </table>
            <input type="hidden" name="submit_cart" />
            <button class="ui right floated teal button" type="submit">Submit</button>
        </form>
    </div>


        <!-- Empty List -->
        <?php if (empty($cartPosition)) : ?>
            <div class="ui container">
                <div class="ui center aligned inverted grey segment">
                    <i class="warning icon"></i>
                    No item found! Please go to recipe menu to find your favorite.
                </div>
            </div>
        <?php endif; ?>

</body>

</html>