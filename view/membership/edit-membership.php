<?php
$pageTitle = "Create-membership";
require_once ROOT . '/link/connect.php';
require_once ROOT . '/view/template/header.php';

if (isset($_GET['membership_id'])) {
    $membership_id = intval($_GET['membership_id']);
    $sql = "SELECT * FROM membership WHERE membership_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $membership_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $membership = $result->fetch_assoc();
    } else {
        echo "No membership found.";
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['membership_id'])) {
    $membership_id = intval($_POST['membership_id']);
    $membership_type = trim($_POST['membership_type']);
    $price = trim($_POST['price']);
    if (empty($membership_type) || empty($price)) {
        die("Error: Please fill in all required fields.");
    }

    if (!filter_var($price, FILTER_VALIDATE_FLOAT) || $price <= 0) {
        die("Error: Price must be a positive number.");
    }

    try {
        $stmt = $conn->prepare("UPDATE membership SET membership_type = ?, price = ? WHERE membership_id = ?");

        $stmt->bind_param("sdi", $membership_type, $price, $membership_id);

        if ($stmt->execute()) {
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'Membership updated successfully.'
            ];
            header("Location: membership");
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

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-8 col-md-10">
                <div class="form-container">
                    <div class="form-header text-center">
                        <h2 class="mb-1">Create Memership Type</h2>
                    </div>
                    <?php if (isset($_SESSION['message'])): ?>
                        <div class="alert alert-<?= htmlspecialchars($_SESSION['message']['type']) ?> m-2">
                            <?= htmlspecialchars($_SESSION['message']['text']) ?>
                        </div>
                        <?php unset($_SESSION['message']); ?>
                    <?php endif; ?>
                    <div class="form-body">
                        <form id="contactForm" action="edit-membership" method="POST">
                            <div class="mb-4">
                                <label for="membership_type" class="form-label">MemberShip Type</label>
                                <input type="text" class="form-control" id="membership_type" name="membership_type"
                                    placeholder="Enter MemberShip Type" value="<?= $membership['membership_type']; ?>"
                                    required>

                            </div>
                            <div class="mb-4">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" inputmode="numeric" name="price" id="price" class="form-control"
                                    placeholder="Enter price for each months" value="<?= $membership['price']; ?>"
                                    required>
                                <small class="text-sm">Price per months</small>
                            </div>
                            <input type="hidden" name="membership_id" value="<?= $membership['membership_id']; ?>">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <button type="reset" class="btn btn-outline-secondary me-md-2">Clear Form</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
<?php
require_once ROOT . '/view/template/header.php';
$conn->close();
?>