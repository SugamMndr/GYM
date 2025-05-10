<?php
require_once ROOT . '/link/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $phone = trim($_POST["phone"]);
    $email = trim($_POST["email"]);
    $duration = trim($_POST["duration"]);
    $start_date = trim($_POST["start_date"]);
    $end_date = trim($_POST["end_date"]);
    $membership_id = isset($_POST["membership_id"]) ? trim($_POST["membership_id"]) : NULL;
    $trainer_id = isset($_POST["trainer_id"]) && !empty(trim($_POST["trainer_id"])) ? trim($_POST["trainer_id"]) : NULL;

    if (empty($name) || empty($phone) || empty($email) || empty($duration) || empty($start_date) || empty($end_date)) {
        die("Error: Please fill in all required fields.");
    }

    if (!filter_var($duration, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
        die("Error: Duration must be a positive integer.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format.");
    }

    if (!preg_match('/^(98|97)\d{8}$/', $phone)) {
        die("Error: Phone number must contain at least 10 digits.");
    }

    try {
        $stmt = $conn->prepare("INSERT INTO members (name, phone, email, duration, start_date, end_date, membership_id, trainer_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sssissii", $name, $phone, $email, $duration, $start_date, $end_date, $membership_id, $trainer_id);

        if ($stmt->execute()) {
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Member added successfully.'];

        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        header("Location: members");
        exit();
    } catch (Exception $e) {
        echo "Database error: " . $e->getMessage();
    }

    $conn->close();
}
?>