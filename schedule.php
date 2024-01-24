<?php
$servername = "localhost";
$username = "u526365569_after_school";
$password = "#Govind12345678";
$dbname = "u526365569_contact_info";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $availability = mysqli_real_escape_string($conn, $_POST['availability']);

    $sql = "INSERT INTO meetings (name, number, email, availability) VALUES ('$name', '$number', '$email', '$availability')";

    if ($conn->query($sql) === TRUE) {
        echo "Thanks for scheduling, you will receive a call from us soon:)";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
