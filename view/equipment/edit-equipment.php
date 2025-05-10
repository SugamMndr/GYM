<?php
require_once ROOT . '/link/connect.php';
$pageTitle = "Edit Equipment";
require_once ROOT . '/view/template/header.php';

if (isset($_GET['equipment_id'])) {
    $id = intval($_GET['equipment_id']);
    $sql = "SELECT * FROM equipment WHERE equipment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$result) {
        echo "Error: Equipment not found.";
        exit;
    }
} else {
    header("Location: equipments");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['equipment_id']);
    $name = trim($_POST["name"]);
    $status = trim($_POST["status"]);
    $purchase_date = trim($_POST["purchase_date"]);
    $price = floatval($_POST["price"]);

    if (empty($name) || empty($status) || empty($purchase_date) || empty($price)) {
        die("Error: All fields are required.");
    }

    try {
        $stmt = $conn->prepare("UPDATE equipment SET name = ?, status = ?, purchase_date = ?, price = ? WHERE equipment_id = ?");
        $stmt->bind_param("sssdi", $name, $status, $purchase_date, $price, $id);

        if ($stmt->execute()) {
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Equipment updated successfully.'];
            header("Location: equipments");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } catch (Exception $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>

<main class="container mt-5">
    <form class="row g-3" action="edit-equipment?equipment_id=<?= $result['equipment_id'] ?>" method="POST">
        <div class="col-md-12">
            <label for="Name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="Name" placeholder="Name"
                value="<?= htmlspecialchars($result['name']) ?>" required>
        </div>
        <div class="col-md-12">
            <label for="status" class="form-label">Condition</label>
            <select name="status" class="form-select">
                <option value="working" <?= $result['status'] == 'working' ? 'selected' : '' ?>>Working</option>
                <option value="under-maintenance" <?= $result['status'] == 'under-maintenance' ? 'selected' : '' ?>>Under
                    Maintainence</option>
                <option value="out-of-order" <?= $result['status'] == 'out-of-order' ? 'selected' : '' ?>>Out of order
                </option>
            </select>
        </div>
        <div class="col-12">
            <label for="purchase-date" class="form-label">Purchase Date</label>
            <input type="date" class="form-control" id="purchase_date" name="purchase_date"
                value="<?= htmlspecialchars($result['purchase_date']) ?>" required>
        </div>
        <div class="col-12">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" value="<?= htmlspecialchars($result['price']) ?>"
                name="price">
        </div>
        <input type="hidden" name="equipment_id" value="<?= htmlspecialchars($result['equipment_id']) ?>">
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</main>

<?php require_once ROOT . '/view/template/footer.php'; ?>