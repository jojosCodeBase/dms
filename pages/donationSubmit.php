<?php
include ('../includes/session.php');
include ('../includes/config.php');
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Check connection

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO donations (date, donated_by, item, amount, area, relief_type) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $donation_date, $donated_by, $item, $amount, $area, $relief_type);

    // Set parameters and execute
    $donation_date = $_POST['donation_date'];
    $donated_by = $_POST['donated_by'];
    $item = $_POST['item'];
    $amount = $_POST['amount'];
    $area = $_POST['area'];
    $relief_type = $_POST['relief_type'];

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Redirect back to the previous page
        
        header("Location: manage-donations.php?alert=success");
        // if($_POST['type'] === "register"){
        //     header("Location: index.php?alert=success");
        // }else{
        // }
        exit();
    } else {
        // Set error message
        header("Location: manage-donations.php?alert=error&message=" . urlencode("Error: " . $stmt->error));
    }
    // if ($stmt->execute()) {
    //     $message = "Donation added successfully!";
    // } else {
    //     $message = "Error: " . $conn->error;
    // }

    // echo $message;

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>