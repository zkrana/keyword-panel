<?php

// Function to generate a random alphanumeric captcha code with rotations
function generateRotatedCaptchaCode($length) {
    $charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    $captchaCode = "";
    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, strlen($charset) - 1);
        $character = $charset[$randomIndex];
        $rotation = mt_rand(-10, 20); // Random rotation between -10 and 10 degrees
        $rotatedCharacter = "<span style='transform: rotate(${rotation}deg); display: inline-block;'>${character}</span>";
        $captchaCode .= $rotatedCharacter;
    }
    return $captchaCode;
}

// Generate a new captcha code with rotations
$newCaptcha = generateRotatedCaptchaCode(6);

// Return the new captcha code with rotations as plain text
echo $newCaptcha;
?>
