<?php
// Define your database schema
$schema = [
    'users' => [
        'id' => 'INT AUTO_INCREMENT PRIMARY KEY',
        'name' => 'VARCHAR(255)',
        'email' => 'VARCHAR(255)',
        'phone' => 'VARCHAR(20)',
        'password' => 'VARCHAR(255)',
        'role' => 'VARCHAR(50)',
        'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        'updated_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    ],
    'donations' => [
        'id' => 'INT AUTO_INCREMENT PRIMARY KEY',
        'donated_by' => 'VARCHAR(255)',
        'date' => 'DATE',
        'item' => 'VARCHAR(100)',
        'amount' => 'DECIMAL(10, 2)',
        'area' => 'VARCHAR(255)',
        'relief_type' => 'VARCHAR(100)',
        'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        'updated_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    ],
    'relief' => [
        'id' => 'INT AUTO_INCREMENT PRIMARY KEY',
        'name' => 'VARCHAR(255)',
        'area' => 'VARCHAR(255)',
        'relief_type' => 'VARCHAR(100)',
        'date' => 'DATE',
        'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        'updated_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    ],
    'posts' => [
        'id' => 'INT AUTO_INCREMENT PRIMARY KEY',
        'name' => 'VARCHAR(255)',
        'postedby' => 'VARCHAR(255)',
        'disaster_type' => 'VARCHAR(100)',
        'status' => 'INT(2)',
        'date' => 'DATE',
        'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        'updated_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    ]
];

// Connect to MySQL server (change these values as per your MySQL configuration)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Execute SQL statements
foreach ($schema as $table => $columns) {
    // Drop the table if it already exists
    $dropSql = "DROP TABLE IF EXISTS $table";
    if ($conn->query($dropSql) === FALSE) {
        echo "Error dropping table $table: " . $conn->error . "<br>";
        continue; // Skip creating the table if dropping fails
    }

    // Create the table
    $sql = "CREATE TABLE $table (";
    foreach ($columns as $column => $attributes) {
        $sql .= "$column $attributes, ";
    }
    $sql = rtrim($sql, ', ') . ")";

    if ($conn->query($sql) === TRUE) {
        echo "Table $table created successfully<br>";
    } else {
        echo "Error creating table $table: " . $conn->error . "<br>";
    }
}

$conn->close();
?>