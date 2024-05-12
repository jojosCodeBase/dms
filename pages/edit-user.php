<?php
include "../includes/session.php";
include "../includes/config.php";

// Check if the ID parameter is present in the URL
if(isset($_GET['id'])) {
    // Get the ID from the URL
    $userId = $_GET['id'];
    // Connect to your database
    // $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }

    // Prepare a SQL statement to fetch user details
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        // Fetch user details
        $row = $result->fetch_assoc();
    } else {
        echo "User not found.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "User ID not provided.";
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
    <div class="container">
        <div class="row vh-100 justify-content-center align-items-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="ps-3">Edit User Details</h3>
                        <form action="update-user" method="POST">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone:</label>
                                    <input type="tel" id="phone" name="phone" value="<?php echo $row['phone']; ?>" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password:</label>
                                    <input type="password" id="password" name="password" value="<?php echo $row['password']; ?>" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="confirm-password" class="form-label">Confirm Password:</label>
                                    <input type="password" id="confirm-password" name="confirm-password" value="<?php echo $row['password']; ?>" class="form-control" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
