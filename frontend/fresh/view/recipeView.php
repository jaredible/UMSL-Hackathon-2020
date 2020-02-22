<?php
$headerArray = array();

$headerArray = ["Cart", "Recipe", "Favorite", "Tournament", "Log-in"];

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
    <script type="text/javascript" src="../js/recipeView.js"></script>

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
        <?php for($i = 0; $i < count($headerArray); $i++):
            if($i == 2):
                ?>
                <a class="item" href="favoriteView.php"> <?php echo $headerArray[$i] ?> </a>
        <?php
            else:
                ?>
                <a class="item" href="index.php?mn=<?php echo $i ?>"><?php echo $headerArray[$i] ?></a>
            <?php
            endif;?>

        <?php endfor; ?>
    </div>
</div>

<div class="ui hidden divider"></div>

<!-- List Recipes and redirect to recipe information after clicked Information -->
<div class="ui container">
    <?php for($i = 0; $i < count($recipe) ; $i++) {?>
    <div class="ui link cards">
        <div class="card">
            <div class="content">
                <div class="header">
                    <a href="recipeItemView.php?recipeItem=<?php print $i ?>"><?php print $recipe[$i] ?></a>
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
                    <button onclick="this.disabled=true" class="ui inverted green button"><!-- onclick="window.location.href = './favoriteView.php'"  -->
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
