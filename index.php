<?php

require "utilities.php";

$mysqli = new mysqli("localhost", "root", "", "polls");
print_r(queryDB($mysqli, "INSERT INTO votes (candidate) VALUES (NULL)"));
$mysqli->close();