<?php
require_once 'template/header.php';
?>
<main class="container mt-5">
<form action="store/add-user.php" method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" id="name" class="form-control" name="name">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">email</label>
        <input type="email" id="email" class="form-control" name="email">
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">phone</label>
        <input type="number" id="phone" class="form-control" name="phone">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">password</label>
        <input type="password" id="password" class="form-control" name="password">
    </div>
    <div class="mb-3">
        <label for="confirmPassword" class="form-label">Confirm password</label>
        <input type="password" id="confirmPassword" class="form-control" name="confirmPassword">
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" type="submit">Register</button>
    </div>
</form>
</main>

<?php
require_once 'template/footer.php';
?>