<?php
$pageTitle = "Sign In";
require_once ROOT . '/view/template/header.php';
?>
<main class="container mt-5">
    <form action="login-validate" method="POST">
        <div class="mb-4">
            <h2>Sign In</h2>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">email</label>
            <input type="email" id="email" class="form-control" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">password</label>
            <input type="password" id="password" class="form-control" name="password">
        </div>
        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Log in</button>
        </div>
    </form>
</main>

<?php
require_once ROOT . '/view/template/footer.php';
?>