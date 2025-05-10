<?php
require_once ROOT . '/link/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email'], $_POST['password'])) {
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = trim($_POST['password']);

        if (empty($email) || empty($password)) {
            echo 'Please fill all the fields.';
            exit();
        }

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email']
                ];

                header('Location: trainers');
                exit();
            } else {
                echo htmlspecialchars('Incorrect password.');
            }
        } else {
            echo htmlspecialchars('User does not exist.');
        }

        $stmt->close();
        $conn->close();
    } else {
        echo htmlspecialchars('Please fill all the fields.');
    }
} else {
    echo htmlspecialchars('Invalid Request.');
}
?>