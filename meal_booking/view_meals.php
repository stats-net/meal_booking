<?php
include 'db.php';

$result = $db->query("SELECT * FROM meals ORDER BY date DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Meal Bookings</title>
</head>
<body>
    <h2>Meal Bookings</h2>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Meal</th>
            <th>Date</th>
        </tr>

        <?php
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['meal']) . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <br>
    <a href="add_meal.php">Add New Booking</a> |
    <a href="index.php">Back to Home</a>
</body>
</html>
