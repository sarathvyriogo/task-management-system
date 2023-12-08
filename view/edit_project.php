<?php
// Include the file containing the database connection code
include 'db_connect.php';

// Execute a MySQL query to select a project based on the ID from the $_GET parameters
$qry = $conn->query("SELECT * FROM project_list where id = ".$_GET['id'])->fetch_array();

// Iterate over the associative array and create variables for each key-value pair
foreach ($qry as $k => $v) {
    $$k = $v;
}

// Include the file new_project.php
include 'new_project.php';
?>