

<?php
// Database configuration
$servername = "           ";
$username = "            ";
$password = "            ";
$dbname = "              ";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $mobile_number = $_POST['mobile_number'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contacts (full_name, email, mobile_number, subject, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $full_name, $email, $mobile_number, $subject, $message);

    // Execute the query
    if ($stmt->execute()) {
        echo '<script type="text/javascript">';
        echo 'alert("Your message has been successfully submitted!");';
        echo 'window.location.href = "index.html";';  // Change 'index.html' to the main page of your website
        echo '</script>';
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("There was an error submitting your message. Please try again later.");';
        echo 'window.location.href = "contact.html";';  // Redirect back to the contact page
        echo '</script>';
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
