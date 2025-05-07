<?php
session_start();

require_once '../link/connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email'], $_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $stmt = $conn->prepare("select * from users where email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'name' => $user['name'],
                    'email' => $user['email']
                ];
                header('Location: ../dashboard.php');
                $stmt->close();
                $conn->close();
                exit();
            } else {
                echo 'Password does not match';
            }
        } else {
            echo 'User does not exists.';
        }
    } else {
        echo 'Please fill all the field.';
    }
} else {
    echo 'Invalid Request';
}
