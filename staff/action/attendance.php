<?php 
require("../layout/db.php");
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$tmpName = $_FILES['file']['tmp_name'];

$csv_data = array_map('str_getcsv', file($tmpName));
session_start();
array_walk($csv_data , function(&$x) use ($csv_data) {
  $x = array_combine($csv_data[0], $x);
});
for($i=1;$i<count($csv_data);$i++) {
    $reg = test_input($csv_data[$i]['reg']);
    $date = test_input($csv_data[$i]['date']);
    $status = test_input($csv_data[$i]['status']);
    $reason = test_input($csv_data[$i]['reason']);
    $sem = test_input($_SESSION["ssem"]);
    
    $sql = "INSERT INTO attendance(reg,date,status,reason,sem) VALUES('$reg','$date','$status','$reason','$sem');";
    try {
        $conn->query($sql);
    } catch (Exception $e) {
        header("Location:/staff/attendance.php?err=Something Went Wrong in Line Number - $i at $reg ");
        die();
    }
};  

header("Location:/staff/attendance.php?msg=Attendance Updated Successfully!");
die();


?>