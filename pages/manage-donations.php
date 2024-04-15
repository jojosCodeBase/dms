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
    <title>Manage Donations</title>
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
            // alert("Inside function");
            window.location = "logout";
        }
    </script>
    <div class="container-fluid">
        <main class="content">
            <div class="row mb-4 mt-4">
                <h4>Manage Donations</h4>
            </div>
            <?php
            // Check for success or error query parameters
            if (isset($_GET['alert'])) {
                if ($_GET['alert'] === 'success') {
                    echo "<script>alert('Donation added successfully');
                    window.location='manage-donations'
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
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#donationAddModal">Add Donation</buttton>
                </div>
                <div class="col">
                    <form action="" method="POST">
                        <div class="row d-flex justify-content-end">
                            <div class="col-7">
                                <input type="text" id="searchInput" placeholder="Search donation by name"
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
                    <span class="h4">All Donations</span>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Donated By</th>
                                    <th>Item</th>
                                    <th>Area</th>
                                    <th>Relief</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Check if form is submitted
                                if (isset($_POST['submit'])) {
                                    // Get the search query
                                    $search = $_POST['reg-no'];

                                    // Prepare a SQL statement to search for posts by name
                                    $sql = "SELECT * FROM donations WHERE donated_by LIKE '%$search%'";
                                    $result = mysqli_query($conn, $sql);

                                    // Check if there are any matching records
                                    if (mysqli_num_rows($result) > 0) {
                                        // Loop through each matching row and display the user data
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . date('h:i d-m-Y', strtotime($row['created_at'])) . "</td>";
                                            echo "<td>" . $row['donated_by'] . "</td>";
                                            echo "<td>" . $row['item'] . "</td>";
                                            echo "<td>" . $row['area'] . "</td>";
                                            echo "<td>" . $row['relief_type'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        // Output a message if no matching posts are found
                                        echo "<tr><td colspan='4'>No donations found</td></tr>";
                                    }
                                } else {
                                    // If the form is not submitted, display all posts
                                    $sql = "SELECT * FROM donations";
                                    $result = mysqli_query($conn, $sql);

                                    // Check if there are any records
                                    if (mysqli_num_rows($result) > 0) {
                                        // Loop through each row of the result set
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            // Output each user record as a table row
                                            echo "<tr>";
                                            echo "<td>" . date('h:i d-m-Y', strtotime($row['created_at'])) . "</td>";
                                            echo "<td>" . $row['donated_by'] . "</td>";
                                            echo "<td>" . $row['item'] . "</td>";
                                            echo "<td>" . $row['area'] . "</td>";
                                            echo "<td>" . $row['relief_type'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        // Output a message if no posts are found
                                        echo "<tr><td colspan='4'>No donations found</td></tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>

        <div class="modal fade" id="donationAddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Donation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="donationSubmit" method="POST">
                            <div class="mb-3">
                                <label for="donation_date" class="form-label">Date:</label>
                                <input type="date" id="donation_date" name="donation_date" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="donated_by" class="form-label">Donated By:</label>
                                <input type="text" id="donated_by" name="donated_by" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="item" class="form-label">Item:</label>
                                <input type="text" id="item" name="item" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount( if any):</label>
                                <input type="text" id="amount" name="amount" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="area" class="form-label">Area:</label>
                                <input type="text" id="area" name="area" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="relief_type" class="form-label">Relief type:</label>
                                <input type="text" id="relief_type" name="relief_type" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php
    include "../includes/footer.php";
    ?>
</body>

</html>