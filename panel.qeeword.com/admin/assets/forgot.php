<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qeeword Admin Login</title>
    <link rel="icon" type="image/x-icon" href="../../assets/images/favicon.svg">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body>
    <div class="container">
        <div class="card"></div>
        <div class="card">
            <h1 class="title">Forgot Password</h1>
            <?php
                // Check for and display error messages
                if (isset($_GET['error_message'])) {
                    echo '<div class="error-message" style="color: red; text-align:center;">' . $_GET['error_message'] . '</div>';
                    echo '<script>
                        setTimeout(function() {
                            var errorMessage = document.querySelector(".error-message");
                            if (errorMessage) {
                                errorMessage.style.display = "none";
                            }
                            // Remove the error message from the URL
                            history.replaceState({}, document.title, window.location.pathname);
                        }, 4000); // 4000 milliseconds = 4 seconds
                    </script>';
                }

                // Check for and display success messages
                if (isset($_GET['success_message'])) {
                    echo '<div class="success-message" style="color: green; text-align:center;">' . $_GET['success_message'] . '</div>';
                    echo '<script>
                        setTimeout(function() {
                            var successMessage = document.querySelector(".success-message");
                            if (successMessage) {
                                successMessage.style.display = "none";
                            }
                            // Remove the success message from the URL
                            history.replaceState({}, document.title, window.location.pathname);
                        }, 4000); // 4000 milliseconds = 4 seconds
                    </script>';
                }
                ?>
            <form action="getpass.php" method="POST">
                <div class="input-container">
                    <input type="text" id="#{label}" name="email" required="required" />
                    <label for="#{label}">Your Email</label>
                    <div class="bar"></div>
                </div>
                <div class="button-container">
                    <button type="submit"><span>Get Password</span></button>
                </div>

                <a style="text-align: center; margin-top: 15px; display: block;" href="http://panel.qeeword.com/"> Back to Sign In</a>
            </form>
        </div>
    </div>
</body>
</html>
