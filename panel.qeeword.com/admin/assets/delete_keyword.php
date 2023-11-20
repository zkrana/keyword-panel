<?php
include 'session.php';

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

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connect, $_GET['id']);

    // Create an SQL query to delete the record with the given ID
    $sql = "DELETE FROM keywords WHERE id = $id";

    if (mysqli_query($connect, $sql)) {
        // Data deleted successfully, you can redirect to another page or display a success message
        header("Location: dashboard.php"); // Redirect to a success page
        exit;
    } else {
        // Display an error message
        echo "Error: " . mysqli_error($connect);
    }
}

// Close the database connection
mysqli_close($connect);
?>
