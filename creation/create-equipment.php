<?php
$pageTitle = "Create Equipment";
include '../template/header.php';
?>

<main class="container mt-5">
    <form class="row g-3" action="../store/add-equipment.php" method="POST">
        <div class="col-md-12">
            <label for="Name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="Name" placeholder="Name" required>
        </div>
        <div class="col-md-12">
            <label for="status" class="form-label">Condition</label>
            <select name="status" class="form-select">
                <option value="Working" selected>Working</option>
                <option value="Under maintainence">Under Maintainence</option>
                <option value="out of order">Out of order</option>
            </select>
        </div>
        <div class="col-12">
            <label for="purchase-date" class="form-label">Purchase Date</label>
            <input type="date" class="form-control" id="purchase_date" name="purchase_date" required>
        </div>
        <div class="col-12">
            <label for="price" class="form-label">price</label>
            <input type="number" class="form-control" name="price">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</main>

<script>
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');

    const formattedDate = `${yyyy}-${mm}-${dd}`;
    document.getElementById('purchase_date').value = formattedDate;
</script>



<?php include '../template/footer.php'; ?>