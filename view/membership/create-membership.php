<?php
$pageTitle = "Create-membership";
require_once ROOT . '/view/template/header.php';
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
                        <form id="contactForm" action="add-membership" method="POST">
                            <div class="mb-4">
                                <label for="membership_type" class="form-label">MemberShip Type</label>
                                <input type="text" class="form-control" id="membership_type" name="membership_type"
                                    placeholder="Enter MemberShip Type" required>

                            </div>
                            <div class="mb-4">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" inputmode="numeric" name="price" id="price" class="form-control"
                                    placeholder="Enter price for each months" required>
                                <small class="text-sm">Price per months</small>
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
<?php
require_once ROOT . '/view/template/header.php';
?>