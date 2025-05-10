<?php
session_start();
include('./link/connect.php');

// CSRF Token Setup
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Handle Deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'], $_POST['csrf_token'])) {
    if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $id = intval($_POST['delete']);
        $stmt = $conn->prepare("DELETE FROM equipment WHERE equipment_id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Record deleted successfully.'];
        } else {
            $_SESSION['message'] = ['type' => 'danger', 'text' => 'Error deleting record: ' . $conn->error];
        }
        $stmt->close();
        header("Location: show-equipment.php");
        exit;
    } else {
        $_SESSION['message'] = ['type' => 'danger', 'text' => 'Invalid CSRF token.'];
        header("Location: show-equipment.php");
        exit;
    }
}

$pageTitle = "Equipment List";
include('./template/header.php');

// Fetch equipment list
$sql = "SELECT * FROM equipment";
$result = $conn->query($sql);
?>

<main class="container mt-5">
    <h2>Equipment List</h2>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?= htmlspecialchars($_SESSION['message']['type']) ?>">
            <?= htmlspecialchars($_SESSION['message']['text']) ?>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <table class="table table-striped col-md-6 mx-auto">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Purchase Date</th>
            <th>Price</th>
            <th></th>
        </tr>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row["equipment_id"]) ?></td>
                    <td><?= htmlspecialchars($row["name"]) ?></td>
                    <td><?= htmlspecialchars($row["status"]) ?></td>
                    <td><?= htmlspecialchars($row["purchase_date"]) ?></td>
                    <td>Nrs.<?= number_format((float)$row["price"], 1) ?></td>
                    <td>
                        <form action="show-equipment.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this equipment?');">
                            <input type="hidden" name="delete" value="<?= htmlspecialchars($row["equipment_id"]) ?>">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No equipment found</td>
            </tr>
        <?php endif; ?>
    </table>

    <a class="btn btn-primary" href="./creation/create-equipment.php">Add Equpiments</a>
</main>

<?php
include('./template/footer.php');
$conn->close();
?>