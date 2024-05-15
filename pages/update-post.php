<?php
// Include config.php and session.php
include "../includes/session.php";
include "../includes/config.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $status = $_GET['status'];

    // Validate status
    if ($status == 'approve') {
        $newStatus = 1; // Assuming 1 represents 'Approved' status
    } else if ($status == 'reject') {
        $newStatus = 2; // Assuming 2 represents 'Rejected' status
    } else {
        // Invalid status, handle error
        echo "Invalid status.";
        exit;
    }

    // Update post status in the database
    $sql = "UPDATE posts SET status='$newStatus' WHERE id='$post_id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Post status updated successfully.');</script>";
        echo "<script>window.location.href='manage-posts';</script>";
    } else {
        echo "Error updating post status: " . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // If post_id or status is not set, redirect to error page or handle error
    echo "Post ID or status not provided.";
}
?>
