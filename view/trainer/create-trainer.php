<?php
$pageTitle = "Create-trainer";
require_once ROOT . '/view/template/header.php';
?>
<main class="container mt-5">

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-8 col-md-10">
                <div class="form-container">
                    <div class="form-header text-center">
                        <h2 class="mb-1">Add Trainer</h2>
                    </div>
                    <?php if (isset($_SESSION['message'])): ?>
                        <div class="alert alert-<?= htmlspecialchars($_SESSION['message']['type']) ?> m-2">
                            <?= htmlspecialchars($_SESSION['message']['text']) ?>
                        </div>
                        <?php unset($_SESSION['message']); ?>
                    <?php endif; ?>
                    <div class="form-body">
                        <form id="contactForm" action="add-trainer" method="POST">
                            <div class="mb-4">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter your full name" required>
                            </div>
                            <div class="mb-4">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="number" inputmode="numeric" name="phone" id="phone" class="form-control"
                                    placeholder="Enter your Phone no." required>
                                <small id="phone-error" class="text-danger d-none">Phone number must be at least 10
                                    digits.</small>
                            </div>
                            <div class="mb-4">
                                <label for="salary" class="form-label">Salary</label>
                                <input type="number" inputmode="numeric" name="salary" class="form-control"
                                    placeholder="Enter your salary" required>
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
</script>

<?php
require_once ROOT . '/view/template/header.php';
?>