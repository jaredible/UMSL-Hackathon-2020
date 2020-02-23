<?php
/* PHP 7.4.2 */
/* Database connection */
$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "";
$con = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname) or die("Could not connect: " . mysqli_error($con));
return $con;
