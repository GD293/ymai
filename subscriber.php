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
    
    // Create file if it doesn't exist
    if (!file_exists($file)) {
        file_put_contents($file, "Email,Subscription Date\n");
    }
    
    // Check if we can write to the file
    if (!is_writable($file)) {
        http_response_code(500);
        echo "System error. Please try again later.";
        exit;
    }
    
    // Append the new subscriber
    $current = file_get_contents($file);
    $current .= $email . "," . date('Y-m-d H:i:s') . "\n";
    
    if (file_put_contents($file, $current) === false) {
        http_response_code(500);
        echo "Failed to save subscription. Please try again.";
        exit;
    }
    
    // Email configuration (optional - you can remove this if emails aren't working)
    $to = $email;
    $subject = "Welcome to YMAI Newsletter";
    $message = "Thank you for subscribing to Youth Mentorship and Advocacy Initiative newsletter!\n\n";
    $message .= "You'll receive updates about our programs, events, and opportunities.\n\n";
    $message .= "Best regards,\nYMAI Team";
    
    // Use your actual email
    $headers = "From: ymainitiatives@gmail.com";
    
    // Try to send email (may not work on all hosting)
    $emailSent = @mail($to, $subject, $message, $headers);
    
    http_response_code(200);
    echo "Thanks for subscribing!";
} else {
    http_response_code(405);
    echo "Method not allowed.";
}
?>