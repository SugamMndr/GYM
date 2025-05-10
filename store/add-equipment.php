<?php
require_once ROOT . '/link/connect.php';

if (isset($_SESSION['user']['id'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim($_POST["name"]);
        $status = trim($_POST["status"]);
        $purchasedate = trim($_POST["purchase_date"]);
        $price = trim($_POST["price"]);
        $user_id = intval($_SESSION['user']['id']);


        if (!empty($name) && !empty($status) && !empty($purchasedate) && !empty($price)) {
            try {
                $stmt = $conn->prepare("INSERT INTO equipment (name, status, purchase_date, price, user_id) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssdi", $name, $status, $purchasedate, $price, $user_id);

                if ($stmt->execute()) {
                    $_SESSION['message'] = ['type' => 'success', 'text' => 'Equipment added successfully.'];
                    $stmt->close();
                    $conn->close();
                    header("Location: equipments");
                    exit();
                } else {
                    throw new Exception("Database error: " . $stmt->error);
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "All fields are required.";
        }
    } else {
        echo "Invalid request.";
    }
} else {
    echo "You must be logged in to add equipment.";
}
?>