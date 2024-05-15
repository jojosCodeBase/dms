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
    <title>Manage Requests</title>
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
    <?php include "../includes/header.php"; ?>
    <script>
        function logout() {
            window.location = "logout";
        }
    </script>
    <div class="container-fluid">
        <main class="content">
            <div class="row mb-4 mt-4">
                <h4>Manage Requests</h4>
            </div>

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
            <div class="row">
                <div class="col">
                    <form action="" method="POST">
                        <div class="row d-flex justify-content-end">
                            <div class="col-4">
                                <input type="text" id="searchInput" placeholder="Search request by name"
                                    class="form-control" name="reg-no" required>
                            </div>
                            <div class="col-auto">
                                <input type="submit" class="btn btn-primary" name="submit" value="Search">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="bg-light mt-2">
                <div class="row p-3 mt-3">
                    <span class="h4">All Requests</span>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Requested by</th>
                                    <th>Phone</th>
                                    <th>Location</th>
                                    <th>Request Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Check if form is submitted
                                if (isset($_POST['submit'])) {
                                    // Get the search query
                                    $search = $_POST['reg-no'];

                                    // Prepare a SQL statement to search for posts by name
                                    $sql = "SELECT * FROM relief WHERE name LIKE '%$search%' ORDER BY created_at DESC";
                                    $result = mysqli_query($conn, $sql);

                                    // Check if there are any matching records
                                    if (mysqli_num_rows($result) > 0) {
                                        // Loop through each matching row and display the user data
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . date('d-m-Y', strtotime($row['created_at'])) . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['phone'] . "</td>";
                                            echo "<td>" . $row['location'] . "</td>";
                                            // echo "<td>" . $row['pincode'] . "</td>";
                                            echo "<td>" . $row['assistance_type'] . "</td>";

                                            if ($row['status'] == 0) {
                                                echo "<td class='text-warning'>Pending</td>";
                                            } else if ($row['status'] == 1) {
                                                echo "<td class='text-success'>Approved</td>";
                                            } else {
                                                echo "<td class='text-danger'>Rejected</td>";
                                            }
                                            echo "<td><a href='view-request?request_id=".$row['id']."'>View</a></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        // Output a message if no matching posts are found
                                        echo "<tr><td colspan='7'>No posts found</td></tr>";
                                    }
                                } else {
                                    // If the form is not submitted, display all posts
                                    $sql = "SELECT * FROM relief ORDER BY created_at DESC";
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
                                            echo "<td>" . $row['location'] . "</td>";
                                            echo "<td>" . $row['assistance_type'] . "</td>";

                                            if ($row['status'] == 0) {
                                                echo "<td class='text-warning'>Pending</td>";
                                            } else if ($row['status'] == 1) {
                                                echo "<td class='text-success'>Approved</td>";
                                            } else {
                                                echo "<td class='text-danger'>Rejected</td>";
                                            }
                                            echo "<td><a href='view-request?request_id=".$row['id']."'>View</a></td>";
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

        <div class="modal fade" id="postAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="postSubmit" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Post Title:</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <assistancefor="disaster_type" class="form-label">Disaster Type:</label>
                                <input type="assistance id="disaster_type" assistanceame="disaster_type" class="form-control"
                                    required>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <?php
    include "../includes/footer.php";
    ?>
</body>

</html>