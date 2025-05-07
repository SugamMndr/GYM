<?php include('../link/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $password = trim($_POST["password"]);
    $confirmPassword = trim($_POST["confirmPassword"]);

    if (!empty($name) && !empty($email) && !empty($phone) && !empty($password) && !empty($confirmPassword)) {
        if ($password == $confirmPassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $phone, $hash);

            if ($stmt->execute()) {
                $stmt->close();
                $conn->close();
                header("Location: ../login.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Password does not match";
        }
    } else {
        echo "ALL FIELDS ARE REQUIRED TO BE FILLED.";
    }
} else {
    echo "Invalid request.";
}
