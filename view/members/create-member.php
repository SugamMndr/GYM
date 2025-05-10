<?php
require_once ROOT . '/link/connect.php';
$pageTitle = "Create-member";
require_once ROOT . '/view/template/header.php';

$membershipSql = "SELECT * FROM membership";
$membership = $conn->query($membershipSql);


$trainerSql = "SELECT * FROM trainer";
$trainer = $conn->query($trainerSql);

?>
<main class="container mt-5">

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-8 col-md-10">
                <div class="form-container">
                    <div class="form-header text-center">
                        <h2 class="mb-1">Add Members</h2>
                    </div>
                    <?php if (isset($_SESSION['message'])): ?>
                        <div class="alert alert-<?= htmlspecialchars($_SESSION['message']['type']) ?> m-2">
                            <?= htmlspecialchars($_SESSION['message']['text']) ?>
                        </div>
                        <?php unset($_SESSION['message']); ?>
                    <?php endif; ?>
                    <div class="form-body">
                        <form id="contactForm" action="add-member" method="POST">
                            <div class="mb-4">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter member's full name" required>
                            </div>
                            <div class="mb-4">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="number" inputmode="numeric" name="phone" id="phone" class="form-control"
                                    placeholder="Enter member's Phone no." required>
                                <small id="phone-error" class="text-danger d-none">Phone number must be at least 10
                                    digits.</small>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter member's email"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label for="duration" class="form-label">duration</label>
                                <input type="number" name="duration" id="duration" class="form-control"
                                    placeholder="Enter member's duration in months" required>
                            </div>
                            <div class="mb-4 d-flex justify-content-between gap-2">
                                <div class="flex-grow-1">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" required>
                                </div>
                                <div class="flex-grow-1">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="membership_id" class="form-label">Membership type</label>

                                <select name="membership_id" id="membership_id" name="membership_id" class="form-select"
                                    required>
                                    <?php
                                    if ($membership->num_rows > 0):
                                        while ($row = $membership->fetch_assoc()): ?>
                                            <option value="<?= $row['membership_id'] ?>" <?php if ($row['membership_id'] == 1) {
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
                                    <option value="" selected>No trainer</option>
                                    <?php if ($trainer->num_rows > 0):
                                        while ($row = $trainer->fetch_assoc()): ?>
                                            <option value="<?= $row['trainer_id'] ?>"> <?= $row['name'] ?></option>
                                        <?php endwhile; endif; ?>
                                </select>
                            </div>

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