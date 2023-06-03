<?php 
require("../layout/db.php");

$date = $_POST["date"];

$sql = "DELETE FROM attendance WHERE date='$date'";

try {
    $conn->query($sql);
    header("Location:/staff/attendance.php?msg=Records Deleted Successfully!");
    die();
} catch (Exception $e) {
    header("Location:/staff/attendance.php?err=Something went Wrong!");
    die();
}
?>