<?php 
require("../layout/db.php");
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
session_start();
$name = test_input($_POST["name"]);
$mobile = test_input($_POST["mobile"]);
$password = test_input($_POST["password"]);
$sem = test_input($_POST["sem"]);
$email = test_input($_POST["email"]);
$dept = test_input($_SESSION["dept"]);

$sql = "INSERT INTO staff(name,mobile,email,password,sem,dept) VALUES('$name','$mobile','$email','$password','$sem','$dept');";


try {
    $conn->query($sql);
    header("Location:/admin/staff.php?msg=Staff Account Created Successfully!");
    die();
} catch (Exception $e) {
    header("Location:/admin/staff.php?err=Duplicate Entry Found!");
    die();
}

?>