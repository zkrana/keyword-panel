<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require '../../vendor/autoload.php';

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

// Perform a SELECT query to retrieve keywords and URLs
$sql = "SELECT keyword_name, keyword_url FROM keywords";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    // Create a new PhpSpreadsheet spreadsheet
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Add headers to the spreadsheet
    $sheet->setCellValue('A1', 'Keyword');
    $sheet->setCellValue('B1', 'URL');

    // Loop through the database results and add data to the spreadsheet
    $row = 2;
    while ($row_data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $row_data['keyword_name']);
        $sheet->setCellValue('B' . $row, $row_data['keyword_url']);
        $row++;
    }

    // Create a writer to generate the Excel file
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');

    // Set the content type and headers for download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="keywords.xlsx"');
    header('Cache-Control: max-age=0');

    // Save the Excel file to the output
    $writer->save('php://output');
} else {
    echo "No data found in the database.";
}

// Close the database connection
$connect->close();
?>
