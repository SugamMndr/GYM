<?php
$pageTitle = "Home";
require_once ROOT . '/view/template/header.php';
?>

<main class="px-5">
    <?php if (isLoggedIn()) {
        header("Location: trainers");
    } else {
        require_once ROOT . '/view/auth/login.php';
    } ?>
</main>


<?php require_once ROOT . '/view/template/footer.php'; ?>