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
    <title>Manage Users</title>
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
                <h4>Manage Users</h4>
            </div>

            <?php
            // Check for success or error query parameters
            if (isset($_GET['alert'])) {
                if ($_GET['alert'] === 'success') {
                    echo "<script>alert('User registered successfully');</script>";
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
                        data-bs-target="#userAddModal">Add User</buttton>
                </div>
                <div class="col">
                    <form action="" method="POST">
                        <div class="row d-flex justify-content-end">
                            <div class="col-7">
                                <input type="text" id="searchInput" placeholder="Search user by name"
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
                    <span class="h4">All Users</span>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Password</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Check if form is submitted
                                if (isset($_POST['submit'])) {
                                    // Get the search query
                                    $search = $_POST['reg-no'];

                                    // Prepare a SQL statement to search for users by name
                                    $sql = "SELECT * FROM users WHERE name LIKE '%$search%'";
                                    $result = mysqli_query($conn, $sql);

                                    // Check if there are any matching records
                                    if (mysqli_num_rows($result) > 0) {
                                        // Loop through each matching row and display the user data
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['phone'] . "</td>";
                                            echo "<td>" . $row['password'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        // Output a message if no matching users are found
                                        echo "<tr><td colspan='4'>No users found</td></tr>";
                                    }
                                } else {
                                    // If the form is not submitted, display all users
                                    $sql = "SELECT * FROM users";
                                    $result = mysqli_query($conn, $sql);

                                    // Check if there are any records
                                    if (mysqli_num_rows($result) > 0) {
                                        // Loop through each row of the result set
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            // Output each user record as a table row
                                            echo "<tr>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['phone'] . "</td>";
                                            echo "<td>" . $row['password'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        // Output a message if no users are found
                                        echo "<tr><td colspan='4'>No users found</td></tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>

        <div class="modal fade" id="userAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../registerSubmit" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone:</label>
                                <input type="tel" id="phone" name="phone" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="confirm-password" class="form-label">Confirm Password:</label>
                                <input type="password" id="confirm-password" name="confirm-password"
                                    class="form-control" required>
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