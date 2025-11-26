<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please enter a valid email address.";
        exit;
    }
    
    // Save to text file (simple approach)
    $file = 'subscribers.txt';
    $current = file_get_contents($file);
    $current .= $email . "," . date('Y-m-d H:i:s') . "\n";
    file_put_contents($file, $current);
    
    // Or send confirmation email
    $to = $email;
    $subject = "Welcome to YMAI Newsletter";
    $message = "Thank you for subscribing to Youth Mentorship and Advocacy Initiative newsletter!\n\n";
    $message .= "You'll receive updates about our programs, events, and opportunities.\n\n";
    $message .= "Best regards,\nYMAI Team";
    $headers = "From: newsletter@yourdomain.com";
    
    mail($to, $subject, $message, $headers);
    
    http_response_code(200);
    echo "Thank you for subscribing!<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please enter a valid email address.";
        exit;
    }
    
    // Save to text file (simple approach)
    $file = 'subscribers.txt';
    $current = file_get_contents($file);
    $current .= $email . "," . date('Y-m-d H:i:s') . "\n";
    file_put_contents($file, $current);
    
    // Or send confirmation email
    $to = $email;
    $subject = "Welcome to YMAI Newsletter";
    $message = "Thank you for subscribing to Youth Mentorship and Advocacy Initiative newsletter!\n\n";
    $message .= "You'll receive updates about our programs, events, and opportunities.\n\n";
    $message .= "Best regards,\nYMAI Team";
    $headers = "From: newsletter@yourdomain.com";
    
    mail($to, $subject, $message, $headers);
    
    http_response_code(200);
    echo "Thank you for subscribing! Please check your email for confirmation.";
}
?>";
}
?>