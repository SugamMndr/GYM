<?php
require_once ROOT . '/link/connect.php';
$pageTitle = "Create-trainer";
require_once ROOT . '/view/template/header.php';


$trainerId = (int) $_GET['trainer_id'];
$sql = "SELECT * FROM trainer WHERE trainer_id = $trainerId";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $trainerInfo = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['trainer_id'])) {
    $trainerId = intval($_POST['trainer_id']);
    $name = htmlspecialchars(trim($_POST['name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $salary = floatval($_POST['salary']);

    if (!empty($name) && !empty($phone) && !empty($salary)) {
        $stmt = $conn->prepare("UPDATE trainer SET name = ?, phone = ?, salary = ? WHERE trainer_id = ?");
        $stmt->bind_param("ssdi", $name, $phone, $salary, $trainerId);

        if ($stmt->execute()) {
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Trainer information updated successfully.'];
            header("Location: trainers");
            exit();
        } else {
            echo "Error updating trainer: " . $conn->error;
        }
    } else {
        $_SESSION['message'] = ['type' => 'danger', 'text' => 'fields Empty'];
        header("Location: edit-trainer");
        exit();
    }


    $stmt->close();
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
                                    placeholder="Enter your full name" value="<?= $trainerInfo['name'] ?>" required>
                            </div>
                            <div class="mb-4">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="number" inputmode="numeric" name="phone" class="form-control"
                                    placeholder="Enter your Phone no." value="<?= $trainerInfo['phone'] ?>" required>
                            </div>
                            <div class="mb-4">
                                <label for="salary" class="form-label">Salary</label>
                                <input type="number" inputmode="numeric" name="salary"
                                    value="<?= $trainerInfo['salary'] ?>" class="form-control"
                                    placeholder="Enter your salary" required>
                            </div>
                            <input type="hidden" name="trainer_id" value="<?= $trainerInfo['trainer_id'] ?>">
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