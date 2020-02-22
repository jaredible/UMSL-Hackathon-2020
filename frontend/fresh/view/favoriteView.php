<?php


$headerArray = ["Cart", "Recipe", "Favorite", "Tournament", "Log-in"];

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- Font Awesome 4 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../css/main.css" />

    <!-- JS -->
    <script type="text/javascript" src="../js/university.js"></script>

    <title>University Database Managment</title>
</head>

<body id="main-background" class="dimmable">
<!-- No JavaScript Error Message -->
<div id="javascript-warning" class="ui active dimmer">
    <div class="ui text loader"><i class="fa fa-exclamation-triangle"></i>&emsp;Error: Please enable JavaScript...</div>
</div>

<!-- Navigation Menu -->
<div class="ui container">
    <!-- Table Menu -->
    <div class="ui borderless stackable no-top-border-radius no-margin inverted pointing teal menu">
        <?php for($i = 0; $i < count($headerArray); $i++): ?>
            <a class="item" href="index.php?mn=<?php echo $i ?>"><?php echo $headerArray[$i] ?></a>
        <?php endfor; ?>
    </div>
</div>

<div class="ui hidden divider"></div>

<!-- List Recipes and redirect to recipe information after clicked Information -->
<div class="ui container">
    <?php for($i = 0; $i < count($fav_recipe) ; $i++) {?>
        <div id="card<?php print $i ?>" class="ui link cards">
            <div class="card">
                <div class="content">
                    <div class="header">
                        <a href="recipeItemView.php?recipeItem=<?php print $i ?>"><?php print $fav_recipe[$i] ?></a>
                    </div>
                </div>
                <div class="extra content">
                    <span>
                    <button onclick="getElementById('card<?php print $i?>').style.display='none'" class="ui inverted red button"><!-- onclick="window.location.href = './favoriteView.php'"  -->
                        Remove
                    </button>
                  </span>
                </div>
            </div>
        </div>
    <?php } ?>
</div>


</body>

</html>
