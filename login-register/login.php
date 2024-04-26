<?php
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "test"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $username = $_POST['Username'];
  $password = $_POST['Password'];

  // SQL query to check if the username and password match
  $sql = "SELECT * FROM register WHERE Username='$username' AND Password='$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // User authenticated, redirect to dashboard or home page
    header("Location: https://hentaihaven.xxx/");
    exit();
  } else {
    // Authentication failed, redirect back to login page with error message
    header("Location: login.php?error=1");
    exit();
  }
}

// Close connection
$conn->close();
?>
