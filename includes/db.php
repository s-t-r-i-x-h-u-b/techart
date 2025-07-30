<?php

include "config.php";

$connection = mysqli_connect($db['host'], $db['user'], $db['password'], $db['dbname']);

if  (!$connection) {
    echo mysqli_connect_error();
    exit();
} 