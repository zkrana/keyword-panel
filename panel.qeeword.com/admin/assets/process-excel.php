<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../vendor/autoload.php';

// Start the session
session_start();

$successMsg = false; // Initialize the success message
$errorOccurred = false; // Initialize the error message

function insertKeyword($pdo, $keyword, $url) {
    $insertQuery = "INSERT INTO keywords (keyword_name, keyword_url) VALUES (:keyword_name, :keyword_url)";
    $stmt = $pdo->prepare($insertQuery);
    $stmt->bindParam(':keyword_name', $keyword);
    $stmt->bindParam(':keyword_url', $url);
    $stmt->execute();
}

try {
    $host = 'localhost';
    $username = 'qeeword_kUsQee';
    $password = '~V#p&DMCiQ9v';
    $database = 'qeeword_keyPQ';

    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if a file was uploaded
    if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] === UPLOAD_ERR_OK) {
        // Validate the uploaded file (e.g., check file extension and MIME type)
        $allowedExtensions = ['xlsx'];
        $allowedMimeTypes = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

        $fileExtension = pathinfo($_FILES['excel_file']['name'], PATHINFO_EXTENSION);
        $fileMimeType = mime_content_type($_FILES['excel_file']['tmp_name']);

        if (in_array($fileExtension, $allowedExtensions) && in_array($fileMimeType, $allowedMimeTypes)) {
            $fileTmpPath = $_FILES['excel_file']['tmp_name'];

            // Load the Excel file
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileTmpPath);
            $worksheet = $spreadsheet->getActiveSheet();

            // Iterate through the rows to extract keyword name and URL
            foreach ($worksheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(FALSE);

                $rowData = [];
                foreach ($cellIterator as $cell) {
                    $rowData[] = $cell->getValue();
                }

                if (count($rowData) >= 2) {
                    $keywordNames = explode(', ', $rowData[0]);
                    $keywordUrl = $rowData[1];

                    // Insert each keyword individually
                    foreach ($keywordNames as $keyword) {
                        if (!empty($keyword)) {
                            $checkQuery = "SELECT COUNT(*) FROM keywords WHERE keyword_name = :keyword_name";
                            $checkStmt = $pdo->prepare($checkQuery);
                            $checkStmt->bindParam(':keyword_name', $keyword);
                            $checkStmt->execute();

                            $keywordExists = $checkStmt->fetchColumn();

                            if ($keywordExists === 0) {
                                insertKeyword($pdo, $keyword, $keywordUrl);
                                $successMsg = "Data from the Excel file was successfully inserted into the database.";
                            } else {
                                $errorOccurred = "Duplicate keyword found: $keyword. It was not inserted.";
                            }
                        }
                    }
                }
            }
        } else {
            $errorOccurred = "Invalid file format. Please upload a valid Excel file (XLSX).";
        }
    } else {
        $errorOccurred = "No file uploaded or an error occurred during file upload.";
    }
} catch (PDOException $e) {
    $errorOccurred = "Database error: " . $e->getMessage();
}

// Set the error and success messages in session variables
$_SESSION['success_message'] = $successMsg;
$_SESSION['error_message'] = $errorOccurred;

// Redirect back to the addExcel page
header("Location: addByExcel.php");
exit;
?>
