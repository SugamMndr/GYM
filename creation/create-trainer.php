<?php
$pageTitle = "Create-trainer";
include '../template/header.php';
?>
<main class="container mt-5">
    <form class="row g-3" action="../store/add-trainer.php" method="POST">
        <div class="col-md-12">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>

        </div>

        <div class="col-md-12">
            <label for="phone" class="form-label">Phone</label>
            <input type="number" inputmode="numeric" name="phone" class="form-control" required>
        </div>

        <div class="col-md-12">
            <label for="salary" class="form-label">Salary</label>
            <input type="number" name="salary" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">
            submit
        </button>
    </form>

</main>

<?php
include '../template/footer.php';
?>