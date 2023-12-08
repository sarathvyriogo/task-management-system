<?php
// Include the file containing the database connection code
include_once '../config/db_connect.php';

// Execute a MySQL query to select a user based on the ID from the $_GET parameters
$qry = $conn->query("SELECT * FROM users where id = ".$_GET['id'])->fetch_array();

// Iterate over the associative array and create variables for each key-value pair
foreach ($qry as $k => $v) {
    $$k = $v;
}

// Include the file new_user.php
include_once 'new_user.php';
?>
