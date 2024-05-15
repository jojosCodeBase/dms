<?php
include ('../includes/session.php');
include ('../includes/config.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // die();
    // Retrieve form data
    // Retrieve form data
    $username = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $assistance = $_POST['assistance'];
    $description = $_POST['description'];
    $status = 0;

    // Check if file is uploaded
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
        $image_name = $_FILES['attachment']['name'];
        $image_temp = $_FILES['attachment']['tmp_name'];
        $image_path = "../uploads/" . $image_name;

        // Move uploaded file to uploads directory
        if (move_uploaded_file($image_temp, $image_path)) {
            // SQL to insert data into table
            $sql = "INSERT INTO relief (name, email, phone, description, location, assistance_type, image, date, status)
                    VALUES ('$username', '$email', '$phone', '$description', '$location', '$assistance', '$image_path', NOW(), $status)";

            // Execute SQL query
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Records inserted successfully.');</script>";
                echo "<script>window.location.href='index.html';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error moving uploaded file.";
        }
    } else {
        echo "No file uploaded.";
    }

    // Close database connection
    mysqli_close($conn);
}
?>