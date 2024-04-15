<?php
include ('../includes/session.php');
include ('../includes/config.php');
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // echo date('h:i d-m-y');
    // die();

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO posts (name, postedby, disaster_type, status, date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $name, $postedby, $disaster_type, $status, $date);

    // Set parameters
    $name = $_POST['name'];
    $disaster_type = $_POST['disaster_type'];
    $status = 1;

    // Get user role based on session['user_id']
    $user_id = $_SESSION['user_id'];
    $user_role_sql = "SELECT role FROM users WHERE id = ?";
    $role_stmt = $conn->prepare($user_role_sql);
    $role_stmt->bind_param("i", $user_id);
    $role_stmt->execute();
    $result = $role_stmt->get_result();
    $row = $result->fetch_assoc();
    $user_role = $row['role'];

    // Set $postedby based on user role
    if ($user_role == 0) {
        $postedby = 'Admin';
    } else {
        // Fetch user's name from users table
        $user_name_sql = "SELECT name FROM users WHERE id = ?";
        $name_stmt = $conn->prepare($user_name_sql);
        $name_stmt->bind_param("i", $user_id);
        $name_stmt->execute();
        $name_result = $name_stmt->get_result();
        $name_row = $name_result->fetch_assoc();
        $postedby = $name_row['name'];
    }

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Redirect back to the previous page
        header("Location: manage-posts.php?alert=success");
        exit();
    } else {
        // Set error message
        header("Location: manage-posts.php?alert=error&message=" . urlencode("Error: " . $stmt->error));
    }

    // Close statements and database connection
    $stmt->close();
    $role_stmt->close();
    $name_stmt->close();
    $conn->close();
}
?>

