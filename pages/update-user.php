<?php
include "../includes/session.php";
include "../includes/config.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the ID parameter is present in the POST data
    if(isset($_POST['id'])) {
        // Get the ID from the POST data
        $userId = $_POST['id'];

        // Get the updated user details from the POST data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password']; // Note: This should be hashed before storing in the database

        // Connect to the database
        // $conn = new mysqli($servername, $username, $password, $dbname);

        // // Check connection
        // if ($conn->connect_error) {
        //     die("Connection failed: " . $conn->connect_error);
        // }

        // Prepare an SQL statement to update the user details
        $stmt = $conn->prepare("UPDATE users SET name=?, email=?, phone=?, password=? WHERE id=?");
        $stmt->bind_param("ssssi", $name, $email, $phone, $password, $userId);

        // Execute the statement
        if ($stmt->execute()) {
            // Close statement and connection
            $stmt->close();
            $conn->close();

            // Redirect to manage-user.php
            header("Location: manage-users");
            exit();
        } else {
            echo "Error updating user details: " . $conn->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "User ID not provided.";
    }
} else {
    echo "Invalid request.";
}
?>
