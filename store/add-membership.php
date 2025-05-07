<?php include('../link/connect.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $member_name = trim($_POST["member_name"]);
    $membership_type = trim($_POST["membership-type"]);
    $start_date = trim($_POST["start-date"]);
    $end_date = trim($_POST["end-date"]);

    if (!empty($member_name) && !empty($membership_type) && !empty($start_date) && !empty($end_date)){
    $stmt = $conn->prepare("INSERT INTO membership (member_name, membership_type, start_date, end_date) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssss", $member_name, $membership_type, $start_date, $end_date);
    if($stmt->execute()){
        $stmt->close();
        $conn->close();
        header("Location: ../show-membership.php");
        exit();
    } else {
        echo "Execute error: " . $stmt->error;
    }
} else {
    echo "Prepare failed: " . $conn->error;
}
} else {
echo "All fields are required.";
}
} else {
echo "Invalid request method.";
}
?>