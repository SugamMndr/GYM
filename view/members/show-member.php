<?php
require ROOT . '/link/connect.php';
$pageTitle = "Members";
require_once ROOT . '/view/template/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $id = intval($_POST['delete']);
    $stmt = $conn->prepare("DELETE FROM members WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $_SESSION['message'] = ['type' => 'success', 'text' => 'Record deleted successfully.'];
    } else {
        $_SESSION['message'] = ['type' => 'danger', 'text' => 'Error deleting record: ' . $conn->error];
    }
    $stmt->close();
    header("Location: members");
    exit;
}


$sql = "SELECT members.*, membership.price AS membership_price, trainer.name AS trainer_name 
FROM members
JOIN membership ON members.membership_id = membership.membership_id
LEFT JOIN trainer ON members.trainer_id = trainer.trainer_id";


$result = $conn->query($sql);

?>

<main class="container mt-5">
    <h2>Trainer list</h2>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?= htmlspecialchars($_SESSION['message']['type']) ?>">
            <?= htmlspecialchars($_SESSION['message']['text']) ?>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <table class="table table-striped col-md-6 mx-auto">
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Duration</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Trainer</th>
            <th>Due</th>
            <th>Action</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row["name"]) ?></td>
                    <td><?= htmlspecialchars($row["phone"]) ?></td>
                    <td><?= htmlspecialchars($row["email"]) ?></td>
                    <td><?= htmlspecialchars($row["duration"]) ?></td>
                    <td><?= htmlspecialchars($row["start_date"]) ?></td>
                    <td><?= htmlspecialchars($row["end_date"]) ?></td>
                    <td><?php if ($row["trainer_name"]) {
                        echo (htmlspecialchars($row["trainer_name"]));
                    } else {
                        echo "No trainer";
                    } ?>
                    </td>
                    <td>
                        <?php
                        $due = $row['duration'] * $row['membership_price'];
                        echo $due; ?>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <form action="edit-member" method="GET">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($row["id"]) ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </form>
                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this member?');">
                                <input type="hidden" name="delete" value="<?= htmlspecialchars($row["id"]) ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php }
        } else {
            echo "<tr><td colspan='5'>No record found</td></tr>";
        }
        ?>

    </table>
    <a class=" btn btn-primary" href="create-member">
        add member
    </a>
</main>
<?php require_once ROOT . '/view/template/footer.php';
$conn->close();
?>