<?php
// include "../includes/session.php";
include "../includes/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reported Disasters</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../Homepage/style_homepage.css">
</head>

<body>
    <div class="top-banner">
        <div class="container">
            <div class="small-bold-text banner-text">An official website for Disaster Management System</div>
            <a href="../index" class="login-links">Login</a>
            <a href="../register" class="register-link">Register</a>
        </div>
    </div>
    <nav class="main-nav">
        <a href="#" class="logo">
            <img src="../assets/img/logo.jpg" alt="website logo">
        </a>
        <div class="nav-links">
            <ul class="flex">
                <li><a href="../Homepage/index.html" class="hover-link">Home</a></li>
                <li><a href="../about/about.html" class="hover-link">About us</a></li>
                <li><a href="../request/index.html" class="hover-link">Assistance</a></li>
                <li><a href="#" class="hover-link">Contact</a></li>
                <li><a href="../report/index.html" class="hover-link">Report</a></li>
                <li><a href="../disasters/index" class="hover-link">Disasters</a></li>
                <form class="d-flex">
                    <input type="search" name="search" class="search form-control me-2" id="search"
                        placeholder="Search...">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </ul>
        </div>
    </nav>

    <header>
        <h3 class="fw-bold text-center mb-3">Recently Reported Disasters</h3>
        <div class="container header-section flex">
            <table class="table table-bordered text-center">
                <thead>
                    <th>Date</th>
                    <th>Posted by</th>
                    <th>Phone</th>
                    <th>Disaster Type</th>
                    <th>Location</th>
                    <th>Pincode</th>
                </thead>
                <tbody>
                    <?php

                    // If the form is not submitted, display all posts
                    $sql = "SELECT * FROM posts WHERE status = 1 ORDER BY created_at DESC";
                    $result = mysqli_query($conn, $sql);

                    // Check if there are any records
                    if (mysqli_num_rows($result) > 0) {
                        // Loop through each row of the result set
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Output each user record as a table row
                            echo "<tr>";
                            echo "<td>" . date('d-m-Y', strtotime($row['created_at'])) . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['disaster_type'] . "</td>";
                            echo "<td>" . $row['location'] . "</td>";
                            echo "<td>" . $row['pincode'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // Output a message if no posts are found
                        echo "<tr><td colspan='4'>No posts found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </header>
</body>

</html>