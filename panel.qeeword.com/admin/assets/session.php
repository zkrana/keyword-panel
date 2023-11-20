<?php
session_start();
include("config.php");

// Update the session login_time when the page is refreshed
if (isset($_SESSION['id'])) {
    $_SESSION['loggedin_time'] = time();
}

if (!isset($_SESSION['id'])) {
    header("Location: ../../index.php");
    exit();
}

if (isset($_SESSION['id'])) {
    $user_check = $_SESSION['id'];

    $stmt = $connect->prepare("SELECT id, username, user_role, user_email, photo FROM user_table WHERE id = ?");
    $stmt->bind_param("i", $user_check);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $login_session, $login_role, $user_email, $user_photo);
        $stmt->fetch();

        $login_session_duration = 1000;
        $current_time = time();

        if (isset($_SESSION['loggedin_time']) and isset($_SESSION['id'])) {
            if ((time() - $_SESSION['loggedin_time']) > $login_session_duration) {
                // Redirect to login page before any output is sent to the browser
                header("Location: ../../index.php");
                exit();
            }
        }
    } else {
        // Handle the case where the user ID is not valid
        session_unset(); // Unset all session variables
        session_destroy(); // Destroy the session data
        header("Location: ../../index.php");
        exit();
    }

    $stmt->close();
}
?>
