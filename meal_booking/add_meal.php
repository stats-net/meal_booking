<?php
include 'db.php';

$name = $meal = $date = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize inputs
    $name = trim($_POST["name"]);
    $meal = trim($_POST["meal"]);
    $date = trim($_POST["date"]);

    // Validation
    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($meal)) {
        $errors[] = "Meal is required.";
    }

    if (empty($date)) {
        $errors[] = "Date is required.";
    }

    // Insert if no errors
    if (empty($errors)) {
        $stmt = $db->prepare("INSERT INTO meals (name, meal, date) VALUES (:name, :meal, :date)");
        $stmt->bindValue(':name', htmlspecialchars($name), SQLITE3_TEXT);
        $stmt->bindValue(':meal', htmlspecialchars($meal), SQLITE3_TEXT);
        $stmt->bindValue(':date', $date, SQLITE3_TEXT);

        if ($stmt->execute()) {
            header("Location: view_meals.php");
            exit();
        } else {
            $errors[] = "Database error: could not insert data.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book a Meal</title>
</head>
<body>
    <h2>Book a Meal</h2>

    <?php
    if (!empty($errors)) {
        echo "<ul style='color:red;'>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }
    ?>

    <form method="post" action="">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>"><br><br>

        <label>Meal:</label><br>
        <input type="text" name="meal" value="<?php echo htmlspecialchars($meal); ?>"><br><br>

        <label>Date:</label><br>
        <input type="date" name="date" value="<?php echo htmlspecialchars($date); ?>"><br><br>

        <button type="submit">Submit Booking</button>
    </form>

    <br>
    <a href="index.php">Back to Home</a>
</body>
</html>
