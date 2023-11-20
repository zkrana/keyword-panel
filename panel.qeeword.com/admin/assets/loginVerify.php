<?php
error_reporting(error_reporting() & ~E_NOTICE);

include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myusername = mysqli_real_escape_string($connect, $_POST['username']);
    $password = stripslashes($_POST['password']);
    $myuserpass = mysqli_real_escape_string($connect, $_POST['passcode']);
    $passcode = md5($myuserpass);

    $stmt = $connect->prepare("SELECT id, username, user_email, password, status FROM user_table WHERE (username = ? OR user_email = ?)");
    $stmt->bind_param("ss", $myusername, $myusername);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows !== 0) {
        $stmt->bind_result($user_id, $user, $mail, $pass, $user_status);
        $stmt->fetch();

        if (($myusername == $user || $myusername == $mail) && $passcode == $pass) {
            if ($user_status == 'active') {
                session_start();
                $_SESSION['id'] = $user_id;
                $_SESSION['status'] = $user_status;
                $_SESSION['loggedin_time'] = time();

                // Record the login time in the database
                $login_time = date('Y-m-d H:i:s');
                $insert_login_query = "INSERT INTO user_activity_log (user_id, username, login_time) VALUES (?, ?, ?)";
                $stmt = $connect->prepare($insert_login_query);
                $stmt->bind_param("iss", $user_id, $user, $login_time);
                $stmt->execute();

                // Check if the "Remember me" checkbox is checked
                if (isset($_POST['remember'])) {
                    // Save username and hashed password as cookies for 15 days
                    setcookie('remember_username', $myusername, time() + 60 * 60 * 24 * 15); // 15 days
                    setcookie('remember_password', md5($myuserpass), time() + 60 * 60 * 24 * 15);
                }

                header("location: dashboard.php");
                exit;
            } else {
                $errors = "Your account is now inactive by admin. Please contact the admin.";
            }
        } else {
            $errors = "Login failed. Check your credentials.";
        }
    } else {
        $errors = "User not registered. Please, register first.";
    }

    header("Location: ../../index.php?error=" . urlencode($errors));
    exit;
}
?>
