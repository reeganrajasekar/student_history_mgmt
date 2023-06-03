<?php 
require("../layout/db.php");

$id = $_POST["id"];

$sql = "DELETE FROM staff WHERE id='$id'";

try {
    $conn->query($sql);
    header("Location:/admin/staff.php?msg=Staff Account Deleted Successfully!");
    die();
} catch (Exception $e) {
    header("Location:/admin/staff.php?err=Something went Wrong!");
    die();
}
?>