<?php
$db = new SQLite3('meal_booking.db');

$query = "CREATE TABLE IF NOT EXISTS meals (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    meal TEXT NOT NULL,
    date TEXT NOT NULL
)";

if ($db->exec($query)) {
    echo "Database and table created successfully!";
} else {
    echo "Error creating table.";
}
?>