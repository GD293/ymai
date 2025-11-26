<?php
header('Content-Type: text/plain');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $email = trim($_POST["email"]);
    
    // Basic email validation
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Save to file
        file_put_contents('subscribers.txt', $email . "," . date('Y-m-d H:i:s') . "\n", FILE_APPEND | LOCK_EX);
        http_response_code(200);
        echo "success";
    } else {
        http_response_code(400);
        echo "invalid_email";
    }
} else {
    http_response_code(400);
    echo "invalid_request";
}
?>