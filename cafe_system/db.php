<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "cafe_db");

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>
