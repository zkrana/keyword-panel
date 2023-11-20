<?php
session_start();
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
    if (isset($_POST['multiple_input']) && $_POST['multiple_input'] == 1) {
        // Handle multiple inputs
        if (!empty($_POST['multiple_data'])) {
            $multipleData = $_POST['multiple_data'];
            $pairs = explode(',', $multipleData);

            foreach ($pairs as $pair) {
                $pair = trim($pair);
                list($keyword_name, $k_url) = explode('=', $pair);
                $keyword_name = trim($keyword_name);
                $k_url = trim($k_url);

                if (!empty($keyword_name) && !empty($k_url)) {
                    // Use a prepared statement to check if the keyword already exists
                    $matchKey = "SELECT * FROM keywords WHERE BINARY keyword_name = ?";
                    $stmtMatch = mysqli_prepare($connect, $matchKey);
                    mysqli_stmt_bind_param($stmtMatch, 's', $keyword_name);
                    mysqli_stmt_execute($stmtMatch);

                    // Store the result of the first query
                    mysqli_stmt_store_result($stmtMatch);

                    if (mysqli_stmt_num_rows($stmtMatch) > 0) {
                        // Keyword already exists in the database; handle accordingly
                        $_SESSION['error_message'] = "Keyword '$keyword_name' already exists.";
                    } else {
                        // Close the result set of the first query
                        mysqli_stmt_close($stmtMatch);

                        // Keyword doesn't exist; you can proceed to insert it
                        $sql = "INSERT INTO keywords (keyword_name, keyword_url) VALUES (?, ?)";
                        $stmt = mysqli_prepare($connect, $sql);
                        mysqli_stmt_bind_param($stmt, 'ss', $keyword_name, $k_url);

                        if (mysqli_stmt_execute($stmt)) {
                            $_SESSION['success_message'] = "Data Successfully Added.";
                        } else {
                            $_SESSION['error_message'] = "Error: " . mysqli_error($connect);
                        }
                    }
                }
            }
        } else {
            $_SESSION['error_message'] = "No data provided.";
        }
    } else {
        // Handle single input
        $keyword_name = $_POST['keyword_name'];
        $k_url = $_POST['k_url'];

        if (!empty($keyword_name) && !empty($k_url)) {
            // Use a prepared statement to check if the keyword already exists
            $matchKey = "SELECT * FROM keywords WHERE BINARY keyword_name = ?";
            $stmtMatch = mysqli_prepare($connect, $matchKey);
            mysqli_stmt_bind_param($stmtMatch, 's', $keyword_name);
            mysqli_stmt_execute($stmtMatch);

            // Store the result of the first query
            mysqli_stmt_store_result($stmtMatch);

            if (mysqli_stmt_num_rows($stmtMatch) > 0) {
                // Keyword already exists in the database; handle accordingly
                $_SESSION['error_message'] = "Keyword '$keyword_name' already exists.";
            } else {
                // Close the result set of the first query
                mysqli_stmt_close($stmtMatch);

                // Keyword doesn't exist; you can proceed to insert it
                $sql = "INSERT INTO keywords (keyword_name, keyword_url) VALUES (?, ?)";
                $stmt = mysqli_prepare($connect, $sql);
                mysqli_stmt_bind_param($stmt, 'ss', $keyword_name, $k_url);

                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['success_message'] = "Data Successfully Added.";
                } else {
                    $_SESSION['error_message'] = "Error: " . mysqli_error($connect);
                }
            }
        } else {
            $_SESSION['error_message'] = "Both Keyword Name and Target Url are required.";
        }
    }
}


mysqli_close($connect);

// Redirect back to the addkeyword page
header('Location: addkeyword.php');
?>
