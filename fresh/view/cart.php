<?php

$headerArray = array("Tournament", "Recipe", "Favorite", "Cart");

$ingredient_name = ['apple', 'beef', 'cilantro'];
$ingredient_measure = ['count', 'lbs', 'bunch'];
$total_amount = [4, 2, 1];

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

    <title>Cart</title>

    <style>
        input:read-only {
            background: none;
            border: none;
            outline: none;
        }

        #table-container {
            position: absolute;
            left: 50%;
            top: 65%;
            transform: translate(-50%, -50%);
        }

        @media screen and (max-width: 991px) {
            #table-container {
                position: absolute;
                left: 50%;
                top: 65%;
                transform: translate(-50%, -50%);
            }

        }

        @media screen and (max-width: 767px) {
            #table-container {
                position: absolute;
                left: 50%;
                top: 65%;
                transform: translate(-50%, -50%);
            }

        }

        @media screen and (max-width: 479px) {
            #table-container {
                position: absolute;
                left: 50%;
                top: 60%;
                transform: translate(-50%, -50%);
            }
        }

    </style>
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

<!-- -   -      -     -     ADDED PART   -  -   -         -    -  -->
<div id="table-container" class="ui container">
    <table class="ui unstackable table" width="20px">
        <thead>
        <tr>
            <th>Checkbox</th>
            <th>Ingredient name</th>
            <th>Total amount</th>
            <th class="right aligned">Measure</th>
        </tr>
        </thead>
        <tbody>
        <?php for($i=0; $i<count($ingredient_name); $i++):?>
            <tr>
                <td>
                    <div class="ui checked checkbox">
                        <input name="<?php print $ingredient_name[$i]?>_check" type="checkbox" fitted checked>
                        <label></label>
                    </div>
                </td>
                <td>
                    <div class="field">
                        <input readonly type="text" name="<?php print $ingredient_name[$i]?>"
                               value="<?php print $ingredient_name[$i]?>">
                    </div>
                </td>
                <td>
                    <div class="field">
                        <input readonly type="text" name="<?php print $ingredient_name[$i]?>_total"
                               value="<?php print $total_amount[$i]?>">
                    </div>
                </td>
                <td class="right aligned">
                    <input class="right aligned" readonly type="text" name="<?php print $ingredient_name[$i]?>_measure"
                           value="<?php print $ingredient_measure[$i]?>">
                </td>
            </tr>
        <?php endfor;?>
        </tbody>
    </table>

    <form class="ui form" method="POST" action="confirmation-page.php">
        <div class="field">
            <?php for($i=0; $i<count($ingredient_name); $i++):?>
                <tr>
                    <td>
                        <div style="display: none" class="ui checked checkbox">
                            <input  name="<?php print $ingredient_name[$i]?>_check" type="checkbox" fitted checked>
                            <label></label>
                        </div>
                    </td>
                    <td>
                        <div class="field">
                            <input style="display: none" readonly type="text" name="<?php print $ingredient_name[$i]?>"
                                   value="<?php print $ingredient_name[$i]?>">
                        </div>
                    </td>
                    <td>
                        <div class="field">
                            <input style="display: none" readonly type="text" name="<?php print $ingredient_name[$i]?>_total"
                                   value="<?php print $total_amount[$i]?>">
                        </div>
                    </td>
                    <td class="right aligned">
                        <input style="display: none" class="right aligned" readonly type="text" name="<?php print $ingredient_name[$i]?>_measure"
                               value="<?php print $ingredient_measure[$i]?>">
                    </td>
                </tr>
            <?php endfor;?>
        </div>
        <button class="ui button" type="submit">Submit</button>
    </form>
</div>




<!-- -   -      -     -     ADDED PART   -  -   -         -    -  -->


</body>

</html>
