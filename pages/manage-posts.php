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
    <title>Manage Posts</title>
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
                <h4>Manage Posts</h4>
            </div>
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                        data-bs-target="#userAddModal">New Post</buttton>
                </div>
                <div class="col">
                    <form action="" method="POST">
                        <div class="row d-flex justify-content-end">
                            <div class="col-7">
                                <input type="text" id="searchInput" placeholder="Search posts by name" class="form-control"
                                    name="reg-no" required>
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
                    <span class="h4">Recent Posts</span>

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
                                <tr>
                                    <td>John Doe</td>
                                    <td>john@example.com</td>
                                    <td>123-456-7890</td>
                                    <td>12345678</td>
                                </tr>
                                <tr>
                                    <td>Jane Smith</td>
                                    <td>jane@example.com</td>
                                    <td>987-654-3210</td>
                                    <td>12345678</td>
                                </tr>
                                <tr>
                                    <td>Alice Johnson</td>
                                    <td>alice@example.com</td>
                                    <td>456-789-0123</td>
                                    <td>12345678</td>
                                </tr>
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
                        <h5 class="modal-title" id="exampleModalLabel">New Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST">
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
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
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