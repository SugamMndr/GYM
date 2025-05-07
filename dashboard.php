<?php
session_start();
include 'template/header.php';
if (isset($_SESSION['user'])) {
?>
    <h2>Welcome <?php echo $_SESSION['user']['name']; ?></h2>
<?php
}

include 'template/footer.php';
