<?php
session_start();
include('./link/connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])){
    $id = intval($_POST['delete']);
    $stmt = $conn->prepare("DELETE FROM membership WHERE member_id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()){
        $_SESSION['message'] = ['type' => 'success', 'text' => 'Record delete successfully.'];
    }else{
        $_SESSION['message'] = ['type' => 'danger', 'text' => 'Error deleting record:' . $conn->error];
    }
    $stmt->close();
    header("Location: show-membership.php");
    exit;
}

$pageTitle = "Equipment List";
include('./template/header.php');

$sql = "SELECT * FROM equipment";
$result = $conn->query($sql);
?>

<main class="container mt-5">
    <h2>Equipment list</h2>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?= htmlspecialchars($_SESSION['message']['type']) ?>">
            <?= htmlspecialchars($_SESSION['message']['type']); ?>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <table class="table table-striped col-md-6 mx-auto">
        <tr>
            <th>Member_name</th>
            <th>Membership-type</th>
            <th>Start-date</th>
            <th>End-date</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <tr>
                    <td><?= htmlspecialchars($row["member_name"]) ?></td>
                    <td><?= htmlspecialchars($row["membership-id"]) ?></td>
                    <td><?= htmlspecialchars($row["Start-date"]) ?></td>
                    <td><?= htmlspecialchars($row["End-date"]) ?></td>
                    <td>
                        <form action="show-membership.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this trainer?');">
                            <input type="hidden" name="delete" value="<?= htmlspecialchars($row["trainer_id"]) ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>

                    </td>
                </tr>
        <?php }
        } else {
            echo "<tr><td colspan='5'>No record found</td></tr>";
        }
        ?>

    </table>
    <a class="btn btn-primary" href="./creation/create-membership.php">
        add membership
    </a>

</main>
<?php
include('./template/footer.php');
$conn->close();
?>