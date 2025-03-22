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

$sql = "CREATE TABLE IF NOT EXISTS Membership (
membership_id INT PRIMARY KEY AUTO_INCREMENT,
type ENUM('SILVER','GOLD','PLATINUM') NOT NULL,
price DECIMAL(10,2) NOT NULL, 
duration INT NOT NULL,
start_date DATE,
end_date DATE
)";

if ($conn->query($sql) === TRUE) {
    echo "membership created successfully" . "<br>";
} else {
    die("error creating table") . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS member (
member_id INT PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(100) NOT NULL,
phone VARCHAR(15) UNIQUE,
email VARCHAR(100),
membership_id INT,
trainer_id INT,
FOREIGN KEY (membership_id) REFERENCES Membership(membership_id) ON DELETE SET NULL,
FOREIGN KEY (trainer_id) REFERENCES trainer(trainer_id) ON DELETE SET NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "member created successfully" . "<br>";
} else {
    die("error creating table") . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS equipment (
equipment_id INT PRIMARY KEY AUTO_INCREMENT,
name varchar(100) NOT NULL,
status ENUM('working','under maintainence','out of order') DEFAULT 'working',
purchase_date DATE,
price DECIMAL(10,2)
)";
if ($conn->query($sql) === TRUE) {
    echo "equipment created successfully" . "<br>";
} else {
    die("error creating table") . $conn->error;
}

$conn->close();
