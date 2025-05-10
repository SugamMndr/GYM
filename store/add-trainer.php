<?php
require_once ROOT . '/link/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $phone = trim($_POST["phone"]);
    $salary = trim($_POST["salary"]);

    if (!empty($name) && !empty($phone) && !empty($salary)) {
        if (preg_match('/^(98|97)\d{8}$/', $phone)) {
            $stmt = $conn->prepare("INSERT INTO trainer (name, phone, salary) VALUES (?, ?, ?)");
            $stmt->bind_param("ssd", $name, $phone, $salary);

            if ($stmt->execute()) {
                $stmt->close();
                $conn->close();

                header("Location: trainers");
                exit();
            } else {
                $_SESSION['message'] = ['type' => 'danger', 'text' => 'Error occurred while inserting data.'];
                header("Location: create-trainer");
                exit();
            }
        } else {
            $_SESSION['message'] = ['type' => 'danger', 'text' => 'Phone number incorrect'];
            header("Location: create-trainer");
            exit();
        }
    } else {
        $_SESSION['message'] = ['type' => 'danger', 'text' => 'All fields are required to be filled.'];
        header("Location: create-trainer");
        exit();
    }
} else {
    $_SESSION['message'] = ['type' => 'danger', 'text' => 'Invalid request.'];
    header("Location: create-trainer");
    exit();
}
?>