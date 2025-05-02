<?php include('../link/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $phone = trim($_POST["phone"]);
    $salary = trim($_POST["salary"]);

    if (!empty($name) && !empty($phone) && !empty($salary)) {
        $stmt = $conn->prepare("INSERT INTO trainer (name,phone,salary) VALUES (?,?,?)");
        $stmt->bind_param("ssd", $name, $phone, $salary);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();

            header("Location: ../show-trainer.php");
            exit();
        } else {
            echo "error";
        }
    } else {
        echo "all field are required";
    }
} else {
    echo "invalid request";
}
