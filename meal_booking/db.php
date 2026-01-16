<?php
$db = new SQLite3('meal_booking.db');

if (!$db) {
    die("Database connection failed");
}
?>
