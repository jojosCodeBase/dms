<?php
// Check if the user ID is provided
if(isset($_POST['id'])) {
    // Connect to your database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a delete statement
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Set the user ID parameter and execute the statement
    $id = $_POST['id'];
    if ($stmt->execute()) {
        // Deletion successful
        echo "User deleted successfully.";
    } else {
        // Deletion failed
        echo "Error deleting user: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If user ID is not provided, return an error message
    echo "User ID not provided.";
}
?>
