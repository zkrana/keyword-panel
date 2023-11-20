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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connect, $_GET['id']);
    
    // Create a query to retrieve the keyword name based on the provided ID
    $getKeywordNameQuery = "SELECT keyword_name FROM keywords WHERE id = $id";
    $result = mysqli_query($connect, $getKeywordNameQuery);

    if ($row = mysqli_fetch_assoc($result)) {
        $keyword_name = $row['keyword_name'];
    } else {
        // Handle the case where the keyword doesn't exist
        $_SESSION['error_message'] = "Keyword not found.";
        header("Location: dashboard.php"); // Redirect back to the dashboard
        exit;
    }

    // Create JavaScript code to display a confirmation dialog with the keyword name
    echo "<script>";
    echo "var confirmDelete = confirm('Are you sure you want to delete the keyword: $keyword_name?');";
    echo "if (confirmDelete) {";
    echo "   window.location.href = 'delete_keyword.php?id=$id';"; // Redirect to the delete script if confirmed
    echo "} else {";
    echo "   window.location.href = 'dashboard.php';"; // Redirect back to the dashboard if canceled
    echo "}";
    echo "</script>";
}
?>
