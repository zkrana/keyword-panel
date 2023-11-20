<?php
// Include your session.php file if needed
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = mysqli_real_escape_string($connect, $_POST['id']); // Replace 'id' with your primary key field name
    $keyword_name = mysqli_real_escape_string($connect, $_POST['keyword_name']);
    $target_url = mysqli_real_escape_string($connect, $_POST['k_url']);

    // Check if the fields are not empty
    if (!empty($id) && !empty($keyword_name) && !empty($target_url)) {
        // SQL query to update data in the database
        $sql = "UPDATE keywords SET keyword_name = '$keyword_name', keyword_url = '$target_url' WHERE id = $id"; // Replace 'id' with your primary key field name

        if (mysqli_query($connect, $sql)) {
            // Data updated successfully, you can redirect or display a success message
            header("Location: dashboard.php"); // Redirect to the appropriate page
            exit;
        } else {
            // Display an error message
            echo "Error: " . mysqli_error($connect);
        }
    } else {
        // Fields are empty
        echo "All fields are required.";
    }
}

// Close the database connection
mysqli_close($connect);
?>
