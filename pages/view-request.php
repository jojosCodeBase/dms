<?php
include "../includes/session.php";
include "../includes/config.php";

if (isset($_GET['request_id'])) {
    $request_id = $_GET['request_id'];
    $sql = "SELECT * FROM relief WHERE id = $request_id ORDER BY created_at DESC";
    $result = $conn->query($sql);
}
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
    <div class="container-fluid mt-5">
        <h2>Assistance Details</h2>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Location</th>
                            <th>Disaster Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= date('d-m-Y', strtotime($row['created_at'])) ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['phone'] ?></td>
                                <td><?= $row['location'] ?></td>
                                <td><?= $row['assistance_type'] ?></td>
                                <td>
                                    <?php if ($row['status'] == 0): ?>
                                        <span class="badge bg-warning">Pending</span>
                                    <?php elseif ($row['status'] == 1): ?>
                                        <span class="badge bg-success">Approved</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Rejected</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($row['status'] == 0): ?>
                                        <a href='update-post?post_id=<?= $row['id'] ?>&status=approve'
                                            class="btn btn-success">Accept</a>
                                        <a href='update-post?post_id=<?= $row['id'] ?>&status=reject'
                                            class="btn btn-danger">Reject</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($row['image'])): ?>
                                        <img src="<?= $row['image'] ?>" alt="Image"
                                            style="max-width: 100px; max-height: 100px;">
                                    <?php else: ?>
                                        No Image
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>