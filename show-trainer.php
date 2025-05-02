<?php
include('./link/connect.php'); // Include your database connection

$sql = "SELECT * FROM trainer";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer list </title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>

    <h2>Trainer list</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Salary </th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["trainer_id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["phone"] . "</td>";
                echo "<td>" . $row["salary"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No record found</td></tr>";
        }
        ?>

    </table>
<a href="./creation/create-trainer.php">
    add trainer
</a>
</body>

</html>

<?php
$conn->close(); // Close the database connection
?>