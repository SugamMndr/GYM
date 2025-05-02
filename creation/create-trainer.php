<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer</title>
</head>

<body>
    <form action="../store/add-trainer.php" method="POST">
        <label for="name">Name</label>
        <input type="text" name="name">
        <label for="phone">Phone</label>
        <input type="number" inputmode="numeric" name="phone">
        <label for="salary">Salary</label>
        <input type="number" name="salary">
        <button type="submit">
            submit
        </button>
    </form>
</body>

</html>