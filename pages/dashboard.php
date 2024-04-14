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
    <title>Dashboard</title>
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
                <h4>Welcome, <?php echo $_SESSION['userData']['name'] ?></h4>
            </div>
            <div class="row">
                <div class="col-xl-3 col-6 mb-3">
                    <div class="card bg-custom">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <h5>Donations</h5>
                                    <span class="fw-bold h4">&#8377; 5,84,367</span>
                                </div>
                                <div class="col-4">
                                    <i class="bi bi-person-video3 fs-3 text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-6 mb-3">
                    <div class="card bg-custom">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <h5>Users</h5>
                                    <span class="fw-bold h4">127</span>
                                </div>
                                <div class="col-4">
                                    <i class="bi bi-chat-left-text-fill fs-3 text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-6">
                    <div class="card bg-custom">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <h5>Posts</h5>
                                    <span class="fw-bold h4">876</span>
                                </div>
                                <div class="col-4">
                                    <i class="bi bi-journal-text fs-3 text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-6">
                    <div class="card bg-custom">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <h5>Reliefs</h5>
                                    <span class="fw-bold h4">251</span>
                                </div>
                                <div class="col-4">
                                    <i class="bi bi-journal-text fs-3 text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-light mt-2">
                <div class="row p-3 mt-3">
                    <div class="mb-1">
                        <h5>Recent Activities</h5>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Relief</th>
                                    <th>Area</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2024-04-01</td>
                                    <td>Food Packets</td>
                                    <td>City A</td>
                                </tr>
                                <tr>
                                    <td>2024-04-02</td>
                                    <td>Medical Supplies</td>
                                    <td>City B</td>
                                </tr>
                                <tr>
                                    <td>2024-04-03</td>
                                    <td>Clothing</td>
                                    <td>City C</td>
                                </tr>
                                <tr>
                                    <td>2024-04-04</td>
                                    <td>Shelter</td>
                                    <td>City D</td>
                                </tr>
                                <tr>
                                    <td>2024-04-05</td>
                                    <td>Water Bottles</td>
                                    <td>City E</td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>