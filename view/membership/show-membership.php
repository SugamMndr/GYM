<?php
require_once ROOT . '/link/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $id = intval($_POST['delete']);
    $stmt = $conn->prepare("DELETE FROM membership WHERE membership_id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $_SESSION['message'] = ['type' => 'success', 'text' => 'Record deleted successfully.'];
    } else {
        $_SESSION['message'] = ['type' => 'danger', 'text' => 'Error deleting record: ' . $conn->error];
    }
    $stmt->close();
    header("Location: membership");
    exit;
}


$pageTitle = "Membership";
require_once ROOT . ('/view/template/header.php');

$sql = "SELECT * FROM membership";
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
            <th>Price <small style="font-weight: 400; font-size: 12px;">(Per Month)</small></th>
            <th>Action</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row["membership_type"]) ?></td>
                    <td><?= htmlspecialchars($row["price"]) ?></td>
                    <td>
                        <div class="d-flex gap-2">
                            <form action="edit-membership" method="GET">
                                <input type="hidden" name="membership_id"
                                    value="<?= htmlspecialchars($row["membership_id"]) ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                            </form>
                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this Membership?');">
                                <input type="hidden" name="delete" value="<?= htmlspecialchars($row["membership_id"]) ?>">
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
    <a class=" btn btn-primary" href="create-membership">
        Add Membership
    </a>
</main>


<?php
include ROOT . ('/view/template/footer.php');
$conn->close();
?>