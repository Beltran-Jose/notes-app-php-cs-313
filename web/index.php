<?php
// Start the session
session_start();

// Filter the Action
$action = filter_input(INPUT_POST, 'action');

if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

//Send to the main landing page.
switch ($action) {
    case 'something':

        break;

    default:
        include 'home.php';
}

?>