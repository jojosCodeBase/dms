<?php
    // Establish database connection.
    $conn = mysqli_connect('localhost', 'root', '', 'dms');
    if(!$conn)
    {
        echo "<script>alert('Couldn't connect to database');</script>";
        exit();
    }
?>