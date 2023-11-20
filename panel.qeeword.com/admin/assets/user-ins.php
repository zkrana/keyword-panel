<?php
include 'session.php';

if (isset($_FILES['user_files'])) {
    $target_directory = "img/uploads/user_photo/";

    if (!file_exists($target_directory)) {
        mkdir($target_directory, 0755, true);
    }

    $file_name = $_FILES['user_files']['name'];
    $file_size = $_FILES['user_files']['size'];
    $file_tmp = $_FILES['user_files']['tmp_name'];
    $file_type = $_FILES['user_files']['type'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

    $extensions = array("jpeg", "jpg", "png");

    if (!in_array($file_ext, $extensions)) {
        $errors[] = "This extension file is not allowed. Please choose a JPG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = "File size must be 2mb or lower.";
    }

    if (empty($errors)) {
        if (move_uploaded_file($file_tmp, $target_directory . $file_name)) {
            // File uploaded successfully
        } else {
            $errors[] = "Error uploading the file.";
        }
    }

    $user_first_name = mysqli_real_escape_string($connect, $_POST['first_name']);
    $user_last_name = mysqli_real_escape_string($connect, $_POST['last_name']);
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $user_email = mysqli_real_escape_string($connect, $_POST['email']);
    $user_passcode = stripslashes($_POST['passcode']);
    $user_role = mysqli_real_escape_string($connect, $_POST['user_role']);
    $user_status = mysqli_real_escape_string($connect, $_POST['userstatus']);

    $errors = array();

    if (empty($user_first_name) || empty($user_last_name) || empty($username) || empty($user_email) || empty($user_passcode) || empty($user_role) || empty($user_status)) {
        $errors[] = "All fields are required.";
    }

    if (!preg_match("/^[a-zA-Z0-9-' ]*$/", $username)) {
        $errors[] = "Only alphanumeric characters and spaces are allowed in the username.";
    }

    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Check if the username or email already exists
    $sql_check = "SELECT * FROM user_table WHERE username = ? OR user_email = ?";
    $stmt_check = mysqli_prepare($connect, $sql_check);
    mysqli_stmt_bind_param($stmt_check, 'ss', $username, $user_email);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_store_result($stmt_check);

    if (mysqli_stmt_num_rows($stmt_check) > 0) {
        $errors[] = "Username or email already taken.";
    }

    if (empty($errors)) {
        // Hash the password using md5 (not recommended)
        $hashed_password = md5($user_passcode);

        // Insert user into the database
        $sql = "INSERT INTO user_table (first_name, last_name, username, user_email, password, user_role, photo, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssssss', $user_first_name, $user_last_name, $username, $user_email, $hashed_password, $user_role, $file_name, $user_status);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: adduser.php");
        } else {
            $errors[] = "Error: " . mysqli_error($connect);
        }
    } else {
        // Handle errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>
