<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "gym";

$conn = new mysqli("$servername", "$username", "$password", "$database");

if ($conn->connect_error) {
    die("connection failed");
}
