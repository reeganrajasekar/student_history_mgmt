<?php
require("./admin/layout/db.php");
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$reg = test_input($_POST["reg"]);
$mobile = test_input($_POST["mobile"]);

$sql = "SELECT * FROM student WHERE reg='$reg' AND mobile='$mobile'";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        session_start();
        $_SESSION["id"]=$row['id'];
        header("Location:/data.php");
        die();
    }
} else {
    header("Location:/");
    die();
}
?>