<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"]."/admin/dist/auth/config.php";
$post = $_POST;
$json = array();
$username = $post['username'];

// Activate Profile Functionality
if (!empty($post['action']) && $post['action']=="activate_profile") {
    $sql = "UPDATE users SET activation_status = 'ACTIVATED', warning_1 = '', warning_2 = '', warning_3 = '' WHERE username = '$username'";
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
          $json['msg'] = 'success';
        } else {
            $json['msg'] = 'failed';
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
    $json['sql'] = $link;
    header('Content-Type: application/json');
    echo json_encode($json);
}

// Reject Profile Functionality
if (!empty($post['action']) && $post['action']=="reject_profile") {
    $sql = "UPDATE users SET activation_status = 'NOT ACTIVATED' WHERE username = '$username'";
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
          $json['msg'] = 'success';
        } else {
            $json['msg'] = 'failed';
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
    $json['sql'] = $link;
    header('Content-Type: application/json');
    echo json_encode($json);
}
