<?php
$conn = mysqli_connect("localhost", "root", "", "curd");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
