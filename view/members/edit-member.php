<?php
require_once ROOT . '/link/connect.php';
$pageTitle = "Create-trainer";
require_once ROOT . '/view/template/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {

    $postId = $_GET['id'];
    $sql = "SELECT * FROM members WHERE id = '$postId'";
    $memberInfo = $conn->query($sql);
    $memberInfo = $memberInfo->fetch_assoc();

    $membershipSql = "SELECT * FROM membership";
    $membership = $conn->query($membershipSql);


    $trainerSql = "SELECT * FROM trainer";
    $trainer = $conn->query($trainerSql);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $name = trim($_POST["name"]);
    $phone = trim($_POST["phone"]);
    $email = trim($_POST["email"]);
    $duration = trim($_POST["duration"]);
    $start_date = trim($_POST["start_date"]);
    $end_date = trim($_POST["end_date"]);
    $membership_id = isset($_POST["membership_id"]) ? trim($_POST["membership_id"]) : NULL;
    $trainer_id = isset($_POST["trainer_id"]) && !empty(trim($_POST["trainer_id"])) ? trim($_POST["trainer_id"]) : NULL;

    if (empty($name) || empty($phone) || empty($email) || empty($duration) || empty($start_date) || empty($end_date)) {
        die("Error: Please fill in all required fields.");
    }

    if (!filter_var($duration, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
        die("Error: Duration must be a positive integer.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format.");
    }

    if (!preg_match('/^(98|97)\d{8}$/', $phone)) {
        die("Error: Phone number must contain at least 10 digits.");
    }

    try {

        $stmt = $conn->prepare("UPDATE members 
            SET name = ?, phone = ?, email = ?, duration = ?, start_date = ?, end_date = ?, membership_id = ?, trainer_id = ? 
            WHERE id = ?");

        $stmt->bind_param("sssissiii", $name, $phone, $email, $duration, $start_date, $end_date, $membership_id, $trainer_id, $id);

        if ($stmt->execute()) {
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Member updated successfully.'];
            header("Location: members");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } catch (Exception $e) {
        echo "Database error: " . $e->getMessage();
    }

    $conn->close();
}


?>
<main class="container mt-5">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="form-container">
                    <div class="form-header text-center">
                        <h2 class="mb-1">Edit Trainer</h2>
                    </div>
                    <div class="form-body">
                        <form id="contactForm" method="POST">
                            <div class="mb-4">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter member's full name" value="<?= $memberInfo['name']; ?>" required>
                            </div>
                            <div class="mb-4">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="number" inputmode="numeric" name="phone" id="phone" class="form-control"
                                    placeholder="Enter member's Phone no." value="<?= $memberInfo['phone']; ?>"
                                    required>
                                <small id="phone-error" class="text-danger d-none">Phone number must be at least 10
                                    digits.</small>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter member's email"
                                    value="<?= $memberInfo['email']; ?>" required>
                            </div>

                            <div class="mb-4">
                                <label for="duration" class="form-label">duration</label>
                                <input type="number" name="duration" id="duration" class="form-control"
                                    placeholder="Enter member's duration in months"
                                    value="<?= $memberInfo['duration']; ?>" required>
                            </div>
                            <div class="mb-4 d-flex justify-content-between gap-2">
                                <div class="flex-grow-1">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control"
                                        value="<?= $memberInfo['start_date']; ?>" required>
                                </div>
                                <div class="flex-grow-1">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control"
                                        value="<?= $memberInfo['end_date']; ?>" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="membership_id" class="form-label">Membership type</label>
                                <select name="membership_id" id="membership_id" name="membership_id" class="form-select"
                                    required>
                                    <?php
                                    if ($membership->num_rows > 0):
                                        while ($row = $membership->fetch_assoc()): ?>
                                            <option value="<?= $row['membership_id'] ?>" <?php if ($row['membership_id'] == $memberInfo['membership_id']) {
                                                  echo 'selected';
                                              } ?>><?= strtoupper($row['membership_type']); ?>
                                            </option>
                                        <?php endwhile;
                                    endif; ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="trainer_id" class="form-label">Select Trainer</label>
                                <select name="trainer_id" id="trainer_id" name="trainer_id" class="form-select">
                                    <option value="" <?php if ($memberInfo['trainer_id'] == NULL) {
                                        echo 'selected';
                                    } ?>>No trainer</option>
                                    <?php if ($trainer->num_rows > 0):
                                        while ($row = $trainer->fetch_assoc()): ?>
                                            <option value="<?= $row['trainer_id'] ?>" <?php if ($memberInfo['trainer_id'] == $row['trainer_id']) {
                                                  echo 'selected';
                                              } ?>> <?= $row['name'] ?></option>
                                        <?php endwhile; endif; ?>
                                </select>
                            </div>
                            <input type="hidden" name="id" value="<?= $memberInfo['id']; ?>">

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

<script>
    const phoneInput = document.getElementById('phone');
    const phoneError = document.getElementById('phone-error');

    phoneInput.addEventListener('input', () => {
        if (phoneInput.value.length < 10) {
            phoneError.classList.remove('d-none');
        } else {
            phoneError.classList.add('d-none');
        }
    });

    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    const durationInput = document.getElementById('duration');

    function formatDate(date) {
        return date.toISOString().split('T')[0];
    }

    const today = new Date();
    startDateInput.value = formatDate(today);

    function updateEndDate() {
        const startDate = new Date(startDateInput.value);
        const duration = parseInt(durationInput.value);

        if (!isNaN(duration)) {
            const endDate = new Date(startDate.setMonth(startDate.getMonth() + duration));
            endDateInput.value = formatDate(endDate);
        } else {
            endDateInput.value = '';
        }
    }

    durationInput.addEventListener('input', updateEndDate);
    startDateInput.addEventListener('change', updateEndDate);
</script>

<?php
require_once ROOT . '/view/template/header.php';
$conn->close();
?>