<?php
$host = 'localhost';
$username = 'qeeword_kUsQee';
$password = '~V#p&DMCiQ9v';
$database = 'qeeword_keyPQ';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL query to fetch data from the 'keywords' table
    $query = "SELECT keyword_name, keyword_url FROM keywords";
    $stmt = $pdo->query($query);

    // Initialize an empty array to store the mappings
    $keywordMappings = [];

    // Fetch the data from the query and populate the keywordMappings array
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $originalKeyword = $row['keyword_name']; // Original case
        $keyword_url = $row['keyword_url'];
        $keywordMappings[$originalKeyword] = $keyword_url;
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

$error = ''; // Initialize an empty error message

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userInput = trim($_POST['searchInput']); // Keep original case

    if (empty($userInput)) {
        $error = 'Please enter the keyword'; // Set the error message
    } elseif (isset($keywordMappings)) {
        // Convert both user input and keywords in the database to lowercase for case-insensitive comparison
        $lowerUserInput = strtolower($userInput);
        $lowerKeywordMappings = array_change_key_case($keywordMappings, CASE_LOWER);

        if (array_key_exists($lowerUserInput, $lowerKeywordMappings)) {
            // Log the search query to the database
            try {
                $userIP = $_SERVER['REMOTE_ADDR'];
                $query = "INSERT INTO search_logs (user_ip, search_query) VALUES (:user_ip, :search_query)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':user_ip', $userIP, PDO::PARAM_STR);
                $stmt->bindParam(':search_query', $userInput, PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $e) {
                // Handle database error
                // You might want to log this error for further investigation
                die("Error: " . $e->getMessage());
            }

            // Redirect to the matching URL
            $targetUrl = $lowerKeywordMappings[$lowerUserInput];
            header("Location: $targetUrl");
            exit();
        } else {
            $error = 'Website / brand name is wrong, please try again!'; // Set the error message
        }
    }
}

?>