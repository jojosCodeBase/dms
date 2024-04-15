<?php
include('includes/config.php');
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $password);

    // Set parameters and execute
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    // $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password before storing
    $password = $_POST['password']; // Hash password before storing

    if ($stmt->execute()) {
        // Redirect back to the previous page

        if($_POST['type'] === "register"){
            header("Location: index.php?alert=success");
        }else{
            header("Location: pages/manage-users.php?alert=success");
        }
        exit();
    } else {
        // Set error message
        header("Location: pages/manage-users.php?alert=error&message=" . urlencode("Error: " . $stmt->error));
    }


    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>