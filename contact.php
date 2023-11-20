<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer classes
require 'vendor/autoload.php';

session_start();

// Function to generate a random alphanumeric captcha code
function generateCaptchaCode($length) {
    $charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    $captchaCode = "";
    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, strlen($charset) - 1);
        $captchaCode .= $charset[$randomIndex];
    }
    return $captchaCode;
}

// Initialize variables
$error_message = "";
$success_message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $userCaptcha = isset($_POST["captcha-i"]) ? $_POST["captcha-i"] : "";

    // Retrieve the captcha code from the session variable
    $captcha = isset($_SESSION["captcha"]) ? $_SESSION["captcha"] : "";

    if (empty($first_name) || empty($last_name) || empty($email) || empty($subject) || empty($message)) {
        $error_message = "Please fill in all fields.";
    } elseif ($userCaptcha === $captcha) {
        // Form is successfully sent. We will contact with you soon.
        $success_message = "Form is successfully sent. We will contact with you soon.";

        // Clear the captcha code from the session variable
        unset($_SESSION["captcha"]);

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF; // Disable debugging
            $mail->isSMTP();
            $mail->Host = 'qeeword.com';  // Use the server name without 'smtp.'
            $mail->SMTPAuth = true;
            $mail->Username = 'info@qeeword.com';
            $mail->Password = '5?m#)0^;o[Z[';

            // Use SSL/TLS encryption
            $mail->SMTPSecure = 'ssl';  // Change to 'tls' if that's the preferred option
            $mail->Port = 465;  // Use the correct SMTP port (SMTPS)

            // Recipients and email content
            $mail->setFrom($email, $first_name . ' ' . $last_name);
            $mail->addAddress('info@qeeword.com', 'Qeeword Help Desk');
            $mail->addReplyTo($email, $first_name.' '.$last_name);

            // Email content
            $mail->isHTML(false);  // Set to 'true' if you want to send HTML email
            $mail->Subject = $subject;
            $mail->Body = $message;

            // Send the email
            if ($mail->send()) {
                $success_message = "Email sent successfully.";
            } else {
                $error_message = "Email could not be sent.";
            }
        } catch (Exception $e) {
            $error_message = "Email could not be sent. Error: " . $e->getMessage();
        }
    } else {
        $error_message = "Captcha is incorrect. Please try again.";
    }
}

// Generate a new captcha and store it in the session
$captcha = generateCaptchaCode(6);
$_SESSION["captcha"] = $captcha;
?>


<!DOCTYPE html>
<html lang="en">
<head>
        <style>
        .message-show {
          margin-top: 10px;
          text-align: center;
        }
        .error-message {
          color: red;
        }
        .success-message {
          color: green;
        }

    </style>
    <meta charset="UTF-8">
    <meta name="description" content="we will bring you to official website for brand you search. avoid phising site / fake site.">
    <meta name="keywords" content="search engine, search brand, search official website, qeeword, qeewords, search brand official website">
    <meta name="author" content="Qeeword">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.svg">
    <title> Contact || Qeeword </title>

</head>
<body>
    <div class="contact-wrapper">
        <div class="contact-form">
            <div class="form-body">
                <h1>Let's Connect</h1>
                <p>
                    Reach out to us, and we'll be thrilled to hear from you. Whether you have questions, feedback, or simply want to say hello, we're here to help.
                </p>
                <form class="form" action="" method="post">
                    <div class="form-controller">
                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" name="first_name">
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="text" name="last_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" rows="4"></textarea>
                    </div>
                    <div class="captcha-varification">
                        <div class="captcha-wrapper">
                            <div class="captcha">
                                <?php
                                // Split the captcha code into individual characters
                                $captchaCharacters = str_split($captcha);
                            
                                // Iterate through each character and apply a rotation transform
                                foreach ($captchaCharacters as $char) {
                                    // Generate a random rotation angle between -10 and 10 degrees
                                    $rotationAngle = rand(-10, 20);
                                    // Output the character with the rotation style
                                    echo '<span style="transform: rotate(' . $rotationAngle . 'deg); display: inline-block;">' . $char . '</span>';
                                }
                                ?>
                            </div>
    
                            <svg width="22" height="19" viewBox="0 0 22 19" fill="none" class="captcha-reload" xmlns="http://www.w3.org/2000/svg"  id="reload-captcha">
                                <path d="M6.52912 7.98315C6.83432 8.33325 6.58571 8.8799 6.12123 8.8799H4.73061C4.72155 9.01749 4.71648 9.15616 4.71648 9.29598C4.71648 12.7608 7.53526 15.5796 11 15.5796C12.6651 15.5796 14.1807 14.9284 15.3062 13.8676L17.2671 16.1616C15.5505 17.7319 13.3415 18.592 11 18.592C8.51696 18.592 6.18254 17.6251 4.42674 15.8693C2.67098 14.1135 1.704 11.7791 1.704 9.29603C1.704 9.1568 1.70748 9.01813 1.71353 8.87994H0.5422C0.0777274 8.87994 -0.17093 8.3333 0.134311 7.98319L2.77668 4.95225L3.3317 4.31563L5.32439 6.60137L6.52912 7.98315Z" fill="#828282"/>
                                <path d="M21.8658 9.75162L19.8949 12.0123L18.6684 13.4192L16.9172 11.4105L15.471 9.75162C15.1658 9.40152 15.4144 8.85488 15.8789 8.85488H17.2679C17.0407 5.5952 14.3165 3.01255 11.0001 3.01255C9.5524 3.01255 8.21767 3.50492 7.15405 4.33066L5.19299 2.03646C6.83584 0.717145 8.86271 6.67572e-05 11.0001 6.67572e-05C13.4832 6.67572e-05 15.8176 0.967005 17.5734 2.7228C19.2248 4.37419 20.1781 6.5375 20.2857 8.85483H21.4579C21.9224 8.85488 22.171 9.40152 21.8658 9.75162Z" fill="#828282"/>
                            </svg>
                        </div>
                        <div class="captcha-input">
                            <input type="text" name="captcha-i" placeholder="Enter code">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="submit-form" name="submit">Send</button>
                        <div class="message-show">
                            <?php if (!empty($error_message)) : ?>
                                <div class="error-message"><?php echo $error_message; ?></div>
                            <?php elseif (!empty($success_message)) : ?>
                                <div class="success-message"><?php echo $success_message; ?></div>
                            <?php endif; ?>
                        </div>
                        <a href="index.php" class="go-back"> 
                        Go Back to Home
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <div class="contact-banner">
            <div class="contact-img">
                <img src="assets/images/contact.png" alt="Banner">
            </div>
        </div>
    </div>

    
    <script>
    document.getElementById('reload-captcha').addEventListener('click', function () {
        // Reload the captcha using JavaScript
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "reload_captcha.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var captchaDiv = document.querySelector('.captcha');
                captchaDiv.innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    });
    
      // Function to hide the message element after a delay
      function hideMessage() {
        var messageElement = document.querySelector('.message-show');
        if (messageElement) {
          setTimeout(function() {
            messageElement.style.display = 'none';
          }, 5000); // Adjust the delay (in milliseconds) as needed
        }
      }
    
      // Call the function to hide the message when the page loads
      window.addEventListener('load', hideMessage);
    </script>



</body>
</html>