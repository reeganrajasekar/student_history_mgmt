<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_POST["email"]=="admin@gmail.com" && $_POST["password"]=="admin") {
    session_start();
    $_SESSION["admin"]="u6rv9tb8pq89u";
    $_SESSION["dept"]="CSE";
    header("Location:/admin/home.php");
    die();
} else {
    header("Location:/admin");
    die();
}
?>