<?php
require("./layout/db.php");
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$email = test_input($_POST["email"]);
$password = test_input($_POST["password"]);

$sql = "SELECT * FROM staff WHERE email='$email' AND password='$password' ";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        session_start();
        $_SESSION["staff"]="u6rv9tb8pq89u";
        $_SESSION["sdept"]=$row['dept'];
        $_SESSION["sname"]=$row['name'];
        $_SESSION["ssem"]=$row['sem'];
        $_SESSION["semail"]=$row['email'];
        header("Location:/staff/home.php");
        die();
    }
} else {
    header("Location:/staff");
    die();
}
?>