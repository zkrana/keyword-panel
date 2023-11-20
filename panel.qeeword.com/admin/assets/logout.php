<?php
session_start();

// Include your database configuration file
include("config.php");

// Check if the user is logged in
if (isset($_SESSION["id"])) {
    // Get the logout time
    $logout_time = date('Y-m-d H:i:s');

    // Check if the database connection is valid
    if (!$connect) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Update the logout time in the database
    $update_logout_query = "UPDATE user_activity_log SET logout_time = ? WHERE user_id = ?";
    $stmt = $connect->prepare($update_logout_query);
    $stmt->bind_param("si", $logout_time, $_SESSION["id"]);
    $stmt->execute();

    // Destroy the session
    session_unset();
    session_destroy();

    // Redirect the user to the login page
    header("Location: ../../index.php");
    exit;
}
?>
