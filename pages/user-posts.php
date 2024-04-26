<?php
include "../includes/session.php";
include "../includes/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/css/dashboard-style.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <title>Manage posts</title>
    <style>
        .bg-custom {
            background-color: #23282d;
            color: white;
        }

        body {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <?php include "user_dashboard.php"; ?>
    <script>
        function logout() {
            window.location = "logout";
        }
    </script>
    <div class="container-fluid">
        <main class="content">
            <!-- <div class="row mb-4 mt-4">
                <h4>Manage Posts</h4>
            </div> -->

            <?php
            // Check for success or error query parameters
            if (isset($_GET['alert'])) {
                if ($_GET['alert'] === 'success') {
                    echo "<script>alert('Post added successfully');
                    window.location='manage-posts'
                    </script>";
                } elseif ($_GET['alert'] === 'error') {
                    // Decode the message parameter and display the error alert
                    $errorMessage = isset($_GET['message']) ? urldecode($_GET['message']) : "An error occurred.";
                    echo "<script>alert('$errorMessage');</script>";
                }
            }
            ?>
            <div class="bg-light mt-2">
                <div class="row p-3 mt-3">
                    <span class="h4">Reported Disasters</span>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Reported by</th>
                                    <th>Disaster Type</th>
                                    <!-- <th>Password</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Check if form is submitted
                                if (isset($_POST['submit'])) {
                                    // Get the search query
                                    $search = $_POST['reg-no'];

                                    // Prepare a SQL statement to search for posts by name
                                    $sql = "SELECT * FROM posts WHERE name LIKE '%$search%'";
                                    $result = mysqli_query($conn, $sql);

                                    // Check if there are any matching records
                                    if (mysqli_num_rows($result) > 0) {
                                        // Loop through each matching row and display the user data
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . date('h:i d-m-Y', strtotime($row['created_at'])) . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['postedby'] . "</td>";
                                            echo "<td>" . $row['disaster_type'] . "</td>";
                                            // echo "<td>" . $row['password'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        // Output a message if no matching posts are found
                                        echo "<tr><td colspan='4'>No posts found</td></tr>";
                                    }
                                } else {
                                    // If the form is not submitted, display all posts
                                    $sql = "SELECT * FROM posts";
                                    $result = mysqli_query($conn, $sql);

                                    // Check if there are any records
                                    if (mysqli_num_rows($result) > 0) {
                                        // Loop through each row of the result set
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            // Output each user record as a table row
                                            echo "<tr>";
                                            echo "<td>" . date('h:i d-m-Y', strtotime($row['created_at'])) . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['postedby'] . "</td>";
                                            echo "<td>" . $row['disaster_type'] . "</td>";
                                            // echo "<td>" . $row['password'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        // Output a message if no posts are found
                                        echo "<tr><td colspan='4'>No posts found</td></tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php
    include "../includes/footer.php";
    ?>
</body>

</html>