<?php include "login.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
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
    <title> Qeeword </title>
</head>
<body>
    <div class="search-app">
        <div class="search-wrapper">
            <div class="logo">
                <img src="assets/images/logo.svg" alt="Qeeword">
            </div>
            <div class="form-wrapper">
                <h1 class="search-header"> ENTER SITE OR BRAND NAME </h1>
                <p class="example"> Search Example  => Facebook , Instagram, twitter </p>
                <!-- Display error message if set -->
                <?php if (!empty($error)): ?>
                    <div id="custom-alert">
                        <p id="custom-alert-message"><?php echo $error; ?></p>
                    </div>
                <?php endif; ?>
                <form id="search-form" method="post">
                    <div class="input">
                        <input type="search" name="searchInput" id="search-input">
                    </div>
                    <button type="submit">Search</button>
                </form>
            </div>
            <div class="qee-action"> 
                <a class='about' href="about-us.php"> About Us </a>
                <a class='about' href="contact.php"> Contact Us </a>
            </div>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
</body>
</html>
