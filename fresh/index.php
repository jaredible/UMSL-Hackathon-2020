<?php
/* PHP 7.4.2 */
/* Start Session */
session_start();

/* Database connection */
$con = (require_once "./php/connection.php");

/* Menu Number and Column Number */
$mn = intval(filter_input(INPUT_GET, "mn"));
$cn = intval(filter_input(INPUT_GET, "cn"));

/* Make table headers */
$headerArray = array("Tournament", "Recipes", "Favorite", "Cart");
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
    <script type="text/javascript" src="js/index.js"></script>

    <title>Fresh</title>
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
        <div class="ui borderless stackable no-margin inverted pointing menu">
            <!-- Menu Dropdown Button -->
            <a class="item"><i class="fa fa-bars"></i></a>
            &emsp;

            <!-- Page Menu -->
            <?php for ($i = 0; $i < count($headerArray); $i++) : ?>
                <?php if ($mn == $i) : ?>
                    <a class="active item"><?php echo $headerArray[$i] ?></a>
                <?php else : ?>
                    <a class="item" href="index.php?mn=<?php echo $i ?>"><?php echo $headerArray[$i] ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <!-- Refresh/Login Button -->
            <div class="right menu">
                <a class="item" href="index.php?mn=<?php echo $mn ?>&cn=<?php echo $cn ?>">
                    <i class="fa fa-refresh"></i>&emsp;Refresh
                </a>
                <a class="item" href="./php/admin.php">
                    <i class="fa fa-user"></i>&emsp;Login
                </a>
            </div>
        </div>
    </div>

    <div class="ui hidden divider"></div>

    <!-- Display Information -->
    <div class="ui container">
        <!-- Stuff Go HERE -->
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