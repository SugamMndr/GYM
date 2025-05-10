<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "gym";

$conn = new mysqli("$servername", "$username", "$password");

if ($conn->connect_error) {
    die("connection failed");
}

$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully" . "<br>";
} else {
    die("Error creating database");
}

$conn->select_db($database);

$sql = "CREATE TABLE IF NOT EXISTS trainer (
trainer_id INT PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(100) NOT NULL,
phone VARCHAR(15) UNIQUE,
salary DECIMAL(10,2)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully" . "<br>";
} else {
    die("Error creating table");
}

$sql = "INSERT INTO trainer (name, phone, salary) 
VALUES 
    ('Sugam', 9812345678, 2000.00), 
    ('Sampana', 9812345645, 5000.00), 
    ('Ashim', 9812345667, 8000.00)";

if ($conn->query($sql) === TRUE) {
    echo "trainer records added successfully.<br>";
} else {
    die("Error inserting trainer: " . $conn->error);
}


$sql = "CREATE TABLE IF NOT EXISTS membership (
    membership_id INT AUTO_INCREMENT PRIMARY KEY,
    membership_type VARCHAR(100) UNIQUE NOT NULL,
    price DECIMAL(10,2) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Membership table created successfully.<br>";
} else {
    die("Error creating table: " . $conn->error);
}

$sql = "INSERT INTO membership (membership_type, price) 
VALUES 
    ('silver', 2000.00), 
    ('gold', 5000.00), 
    ('platinum', 8000.00)";

if ($conn->query($sql) === TRUE) {
    echo "Membership records added successfully.<br>";
} else {
    die("Error inserting memberships: " . $conn->error);
}

$sql = "CREATE TABLE IF NOT EXISTS members (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(15) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    duration INT NOT NULL,
    start_date DATE DEFAULT CURRENT_DATE,
    end_date DATE GENERATED ALWAYS AS (DATE_ADD(start_date, INTERVAL duration MONTH)) STORED,
    membership_id INT,
    trainer_id INT NULL,
    FOREIGN KEY (membership_id) REFERENCES membership(membership_id) ON DELETE SET NULL,
    FOREIGN KEY (trainer_id) REFERENCES trainer(trainer_id) ON DELETE SET NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "member created successfully" . "<br>";
} else {
    die("error creating table: " . $conn->error);
}

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(15) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "users table created successfully" . "<br>";
} else {
    die("error creating table: " . $conn->error);
}
$password = password_hash('password', PASSWORD_DEFAULT);

$sql = "INSERT INTO users (name, phone, email, password)
VALUE ('admin','9812345678', 'admin@email.com', '$password' )";

if ($conn->query($sql) === TRUE) {
    echo "user records added successfully.<br>";
} else {
    die("Error inserting user: " . $conn->error);
}


$sql = "CREATE TABLE IF NOT EXISTS equipment (
    equipment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    name VARCHAR(100) NOT NULL,
    status ENUM('working', 'under-maintenance', 'out-of-order') DEFAULT 'working',
    purchase_date DATE,
    price DECIMAL(10,2),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "equipment table created successfully" . "<br>";
} else {
    die("error creating table: " . $conn->error);
}


$conn->close();
