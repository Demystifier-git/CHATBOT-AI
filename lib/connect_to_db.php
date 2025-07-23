<?php

$mysqli = new mysqli("sql309.infinityfree.com", "if0_38068908", "8DBuDsjDtmAW7xm", "if0_38068908_roq");
// $mysqli = new mysqli("localhost", "root", "", "roq");
if($mysqli->connect_error) die($mysqli->connect_error);