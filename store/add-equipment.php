<?php include('../link/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $status = trim($_POST["status"]);
    $purchasedate = trim($_POST["purchase_date"]);
    $price = trim($_POST["price"]);

    if (!empty($name) && !empty($status) && !empty($purchasedate) && !empty($price)) {
        $stmt = $conn->prepare("INSERT INTO equipment (name, status, purchase_date, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssd", $name, $status, $purchasedate, $price);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: ../show-equipment.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "ALL FIELDS ARE REQUIRED TO BE FILLED.";
    }
} else {
    echo "Invalid request.";
}
