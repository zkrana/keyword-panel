<?php
include 'session.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php'; // Include the Composer autoloader

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email_id']) && isset($_POST['reply_content'])) {
    $emailId = $_POST['email_id'];
    $replyContent = $_POST['reply_content'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);
    
    $successMessage = '';
    $errorMessage = '';

    try {
        // Server settings
        $mail->SMTPDebug = 0; // Enable verbose debugging (0 for no output, 2 for maximum debugging)
        $mail->isSMTP();
        $mail->Host = 'qeeword.com'; // Your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'info@qeeword.com'; // Your email username
        $mail->Password = '5?m#)0^;o[Z['; // Your email password
        $mail->SMTPSecure = 'ssl'; // Enable SSL/TLS
        $mail->Port = 465; // SMTP port

        // Fetch the original email
        $hostname = 'qeeword.com'; // IMAP server hostname
        $username = 'info@qeeword.com'; // Your email username
        $password = '5?m#)0^;o[Z['; // Your email password
        $inbox = '{' . $hostname . ':993/imap/ssl/novalidate-cert}INBOX';

        $imap = imap_open($inbox, $username, $password) or die('Cannot connect to the mailbox: ' . imap_last_error());
        $originalEmail = imap_fetchbody($imap, $emailId, 1);
        $header = imap_headerinfo($imap, $emailId);
        $senderEmail = $header->from[0]->mailbox . "@" . $header->from[0]->host;

        // Set the sender and recipient
        $mail->setFrom('info@qeeword.com', 'Qeeword Information Desk'); // Replace with your information
        $mail->addAddress($senderEmail, $header->from[0]->personal);

        // Content
        $mail->isHTML(false); // Set to true if you want to send HTML emails
        $mail->Subject = 'Re: ' . $header->subject;
        $mail->Body = "On " . date("Y-m-d H:i:s") . ", you wrote:\n\n" . $originalEmail . "\n\nYour reply:\n\n" . $replyContent;

        // Send the email
        $mail->send();
        $successMessage = 'Reply sent successfully!';
    } catch (Exception $e) {
        $errorMessage = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }

    // Close the mailbox connection
    if (isset($imap)) {
        imap_close($imap, CL_EXPUNGE);
    }

    // Set the error or success messages in session variables
    $_SESSION['success_message'] = $successMessage;
    $_SESSION['error_message'] = $errorMessage;

    // Redirect back to viewAllEmail.php
    header('Location: viewAllEmail.php');
} else {
    echo 'Invalid request';
}
?>
