<?php
// Start output buffering to capture and manipulate the script's output
ob_start();
// Set the default timezone to Asia/Kolkata
date_default_timezone_set('Asia/Kolkata');

// Get the 'action' parameter from the URL
$action = $_GET['action'];

// Include the 'admin_class.php' file, which contains the 'Action' class
include_once '../model/admin_class.php';

// Create an instance of the 'Action' class
$crud = new Action();

// Perform actions based on the provided 'action' parameter
if ($action == 'login') {
    // Call the 'login' method and capture the result
    $login = $crud->login();
    // Output the result if it exists
    if ($login)
        echo $login;
}

if ($action == 'logout') {
    // Call the 'logout' method and capture the result
    $logout = $crud->logout();
    // Output the result if it exists
    if ($logout)
        echo $logout;
}

if ($action == 'save_user' || $action == 'update_user') {
    // Call the 'save_user' method and capture the result
    $save = $crud->save_user();
    // Output the result if it exists
    if ($save)
        echo $save;
}

if ($action == 'delete_user') {
    // Call the 'delete_user' method and capture the result
    $save = $crud->delete_user();
    // Output the result if it exists
    if ($save)
        echo $save;
}

if ($action == 'save_project') {
    // Call the 'save_project' method and capture the result
    $save = $crud->save_project();
    // Output the result if it exists
    if ($save)
        echo $save;
}

if ($action == 'delete_project') {
    // Call the 'delete_project' method and capture the result
    $save = $crud->delete_project();
    // Output the result if it exists
    if ($save)
        echo $save;
}

if ($action == 'save_task') {
    // Call the 'save_task' method and capture the result
    $save = $crud->save_task();
    // Output the result if it exists
    if ($save)
        echo $save;
}

if ($action == 'delete_task') {
    // Call the 'delete_task' method and capture the result
    $save = $crud->delete_task();
    // Output the result if it exists
    if ($save)
        echo $save;
}

// Flush the output buffer, sending the captured output to the browser
ob_end_flush();
?>