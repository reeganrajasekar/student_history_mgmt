<?php 
require("../layout/db.php");

$id = $_POST["id"];
$uid = $_POST["uid"];

$sql = "DELETE FROM result WHERE id='$id'";

try {
    $conn->query($sql);
    header("Location:/staff/record.php?id=$uid&msg=Records Deleted Successfully!");
    die();
} catch (Exception $e) {
    header("Location:/staff/record.php?id=$uid&err=Something went Wrong!");
    die();
}
?>