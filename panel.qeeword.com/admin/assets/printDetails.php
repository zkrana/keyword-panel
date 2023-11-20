<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("session.php");
// Include your database connection and necessary functions here

// Get the search query from the URL
$searchQuery = isset($_GET['search_query']) ? mysqli_real_escape_string($connect, $_GET['search_query']) : '';

// Check if the search query is empty
if (empty($searchQuery)) {
    echo "<p>Invalid request</p>";
    exit();
}

// Fetch data with pagination from the database, including the count of searches
$countQuery = "SELECT user_ip, COUNT(*) as search_count
               FROM search_logs
               WHERE search_query = '$searchQuery'
               GROUP BY user_ip";
$countResult = mysqli_query($connect, $countQuery);

// Initialize arrays to store country information
$countries = [];
$totalUsersByCountry = [];
$totalSearchByCountry = [];

while ($row = mysqli_fetch_assoc($countResult)) {
    $userIp = $row['user_ip'];
    $searchCount = $row['search_count'];

    // Replace 'YOUR_IPSTACK_API_KEY' with your actual ipstack API key
    $apiKey = '7aedc5c16d99392ad3a43a9d83b07e13';

    // Construct the API URL
    $url = "http://api.ipstack.com/{$userIp}?access_key={$apiKey}";

    // Make a cURL request to the ipstack API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    if ($response !== false) {
        $userInfo = json_decode($response, true);

        // Add the country name to the $countries array
        $country = isset($userInfo['country_name']) ? $userInfo['country_name'] : 'Unknown';
        $countries[] = $country;

        // Increment the total user count for the country
        if (!isset($totalUsersByCountry[$country])) {
            $totalUsersByCountry[$country] = 1;
        } else {
            $totalUsersByCountry[$country]++;
        }

        // Increment the total search count for the country
        if (!isset($totalSearchByCountry[$country])) {
            $totalSearchByCountry[$country] = $searchCount;
        } else {
            $totalSearchByCountry[$country] += $searchCount;
        }
    }

    curl_close($ch);
}

// Display the country-wise information in a table
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Details for <?php echo $searchQuery; ?></title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 20px;
        min-height: 100vh;
    }

    h1 {
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
</style>

</head>
<body>
    <h1>Search Details for <?php echo $searchQuery; ?></h1>
    <table>
        <thead>
            <tr>
                <th>Country Name</th>
                <th>Total Users</th>
                <th>Total Search</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($totalUsersByCountry as $country => $totalUsers) {
                $totalSearch = isset($totalSearchByCountry[$country]) ? $totalSearchByCountry[$country] : 0;
                echo "<tr><td>{$country}</td><td>{$totalUsers}</td><td>{$totalSearch}</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <!-- Add your scripts or additional content here -->
</body>
</html>
