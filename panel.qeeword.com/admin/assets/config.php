<?php
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


?>
