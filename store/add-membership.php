<?php
require_once ROOT . '/link/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $membership_type = trim($_POST["membership_type"]);
    $price = trim($_POST["price"]);

    if (!empty($membership_type) && !empty($price)) {

        $stmt = $conn->prepare("INSERT INTO membership (membership_type , price) VALUES (?, ?)");
        $stmt->bind_param("sd", $membership_type, $price);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();

            header("Location: membership");
            exit();
        } else {
            $_SESSION['message'] = ['type' => 'danger', 'text' => 'Error occurred while inserting data.'];
            header("Location: create-trainer");
            exit();
        }

    } else {
        $_SESSION['message'] = ['type' => 'danger', 'text' => 'All fields are required to be filled.'];
        header("Location: create-membership");
        exit();
    }
} else {
    $_SESSION['message'] = ['type' => 'danger', 'text' => 'Invalid request.'];
    header("Location: create-trainer");
    exit();
}
?>