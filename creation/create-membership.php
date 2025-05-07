<?php
$pageTitle = "Create Membership";
include '../template/header.php';
?>
<main class="container mt-5">
    <form class="row g-3" action="../store/add-membership.php" method="POST">
        <div class="col-md-12">
            <label for="member_name">Member_name</label>
            <input type="text" name="text" class="form-control" required>
        </div>
       <div class="col-md-12">
        <label for="type">Membership-type</label>
        <select name="price" class="form-select">
            <option value="Silver">Silver - Rs 1500/Month</option>
            <option value="Gold">Gold - Rs 2500/Month</option>
            <option value="Platinum">Platinum - Rs3500/Month</option>
        </select>
       </div>

       <div class="col-md-12">
        <label for="start-date" class="form-label">Start-date</label>
        <input type="date" class="form-control" id="start-date" name="start-date" required>
       </div>

       <div class="col-md-12">
        <label for="end-date" class="form-label">End-date</label>
        <input type="date" class="form-control" id="end-date" name="end-date" required>
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

<?php 
include '../template/footer.php'; ?>