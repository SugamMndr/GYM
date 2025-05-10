<?php
require_once ROOT . '/link/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($confirmPassword)) {
        die("Error: Please fill in all required fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format.");
    }

    if (!preg_match('/^(98|97)\d{8}$/', $phone)) {
        die("Error: Phone number must start with 98 or 97 and contain 10 digits.");
    }

    if ($password !== $confirmPassword) {
        die("Error: Passwords do not match.");
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("INSERT INTO users (name, phone, email, password) VALUES (?, ?, ?, ?)");

        $stmt->bind_param("ssss", $name, $phone, $email, $hashedPassword);

        if ($stmt->execute()) {
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'Registration successful. You can now log in.'
            ];
            header("Location: login");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } catch (Exception $e) {
        echo "Database error: " . $e->getMessage();
    }
}

$conn->close();
?>