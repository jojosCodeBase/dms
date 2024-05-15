<?php
include ('../includes/session.php');
include ('../includes/config.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $disaster = $_POST['disaster'];
    $pincode = $_POST['pincode'];
    $date = date('Y-m-d');
    $status = 0;

    // SQL to insert data into table
    $sql = "INSERT INTO posts (name, phone, description, location, disaster_type, pincode, date, status)
            VALUES ('$username', '$phone', '$description', '$location', '$disaster', '$pincode', $date, $status)";

    // Execute SQL query
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Records inserted successfully.');</script>";
        echo "<script>window.location.href='index.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
}
?>
