<?php
// Establish a database connection (You should replace these values with your own)
// Define constants for your database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'qeeword_kUsQee');
define('DB_PASS', '~V#p&DMCiQ9v');
define('DB_NAME', 'qeeword_keyPQ');

// Attempt to create a database connection
$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check the connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Optionally, you can set the character set for your connection to prevent SQL injection
mysqli_set_charset($connect, 'utf8');

error_reporting(E_ALL);
ini_set('display_errors', 1);


$error_message = '';
$success_message = '';

// Get the user's email from the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_email = $_POST['email'];

    // Check if the email exists in the database
    $check_email_sql = "SELECT * FROM user_table WHERE user_email = '$user_email'";
    $result = mysqli_query($connect, $check_email_sql);

    if (mysqli_num_rows($result) > 0) {
        // Generate a unique token
        $token = bin2hex(openssl_random_pseudo_bytes(16));

        // Store the token and expiration time in the database
        $reset_expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $sql = "UPDATE user_table SET reset_token = '$token', reset_expiration = '$reset_expiration' WHERE user_email = '$user_email'";
        if (mysqli_query($connect, $sql)) {
            // Send a password reset link to the user's email
            $reset_link = "https://panel.lewat88.com/admin/assets/reset_password.php?token=$token";
            // You can send an email containing the $reset_link to the user here

            $success_message = "A password reset link has been sent to your email. " ." </br> "." Please check your inbox.";

            // Include the message in the URL parameter when redirecting
            header("Location: forgot.php?success_message=$success_message");
            exit; // Make sure to exit after the header redirection
        } else {
            $error_message = "Error: " . mysqli_error($connect);
        }
    } else {
        $error_message = "The email doesn't exist in our database. " ." </br> "." Please check your email address.";
        header("Location: forgot.php?error_message=$error_message");
    }

    // Close the database connection
    mysqli_close($connect);
}

?>
