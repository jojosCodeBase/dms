<?php
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "test"; // Your database name

// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
$conn = new mysqli('localhost', 'root', '', 'test');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $email = $_POST['Email'];
  $username = $_POST['Username'];
  $password = $_POST['Password'];

  // SQL query to insert new user into the database using prepared statements
  $sql = "INSERT INTO register (Email, Username, Password) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $email, $username, $password); // "sss" indicates three string parameters
  if ($stmt->execute()) {
    // Registration successful, redirect to login page
    header("Location: http://localhost/project%2069/login.html");
    exit();
  } else {
    // Registration failed, redirect back to registration page with error message
    header("Location: register.php?error=1");
    exit();
  }
}

// Close statement
$stmt->close();

// Close connection
$conn->close();
?>
