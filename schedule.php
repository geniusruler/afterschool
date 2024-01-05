<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $countryCode = $_POST["countryCode"];
    $phone = $_POST["phone"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    // Validate email and phone (server-side validation)
    if (!isValidEmail($email)) {
        die('Invalid email address.');
    }

    if (!isValidPhoneNumber($phone)) {
        die('Invalid phone number.');
    }

    // Implement your additional server-side logic here
    // For demonstration, we'll just echo the submitted data
    echo "Meeting Scheduled:\n\nName: $fullName\nEmail: $email\nPhone: $countryCode $phone\nDate: $date\nTime: $time";

    // Send email confirmation using PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp-relay.brevo.com'; // Replace with your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'udhav355@gmail.com'; // Replace with your SMTP username
        $mail->Password   = '7k0UqFSgW96OfPGV'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('file:///C:/Users/udhav/Downloads/AS/AS.html', 'TheAfterSchool'); // Replace with your email and name
        $mail->addAddress($email, $fullName);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Meeting Scheduled Confirmation';
        $mail->Body    = "Dear $fullName,\n\nYour meeting has been scheduled for:\nDate: $date\nTime: $time\n\nThank you!";

        $mail->send();
        echo "\nEmail confirmation sent successfully.";
    } catch (Exception $e) {
        echo "\nError sending email confirmation: {$mail->ErrorInfo}";
    }
}

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isValidPhoneNumber($phone) {
    // For simplicity, assume a valid phone number is any numeric value with at least 10 digits
    return is_numeric($phone) && strlen($phone) >= 10;
}
?>

