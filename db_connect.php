<!-- This file connects the TA database to the site -->
<?php
$dbhost = "localhost";
$dbuser= "root";
$dbpass = "cs3319";
$dbname = "assign2db";
$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if (mysqli_connect_errno()) {
    die("database connection failed :" .
    mysqli_connect_error() .
    "(" . mysqli_connect_errno() . ")"
        );
   }

// Set charset to utf8mb4
$connection->set_charset("utf8mb4");
?>
