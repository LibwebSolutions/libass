<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Validate required fields
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "Please fill in all required fields.";
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    // Set recipient email
    $to = "libwebsolutionsco@gmail.com";  // <-- Replace this with your actual company email

    // Email subject
    $email_subject = "Contact Form: $subject";

    // Email body
    $email_body = "You have received a new message from your website contact form.\n\n".
                  "Here are the details:\n".
                  "Name: $name\n".
                  "Email: $email\n".
                  "Subject: $subject\n".
                  "Message:\n$message\n";

    // Email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send email
    if (mail($to, $email_subject, $email_body, $headers)) {
        // Redirect back to contact page with success message (you can also do this differently)
        header("Location: contact.html?success=1");
        exit;
    } else {
        echo "Oops! Something went wrong and your message couldn't be sent.";
    }
} else {
    // If not a POST request, redirect to contact page
    header("Location: contact.html");
    exit;
}
?>
