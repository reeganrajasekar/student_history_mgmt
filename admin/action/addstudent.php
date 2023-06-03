<?php 
require("../layout/db.php");
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
session_start();
$dept = test_input($_SESSION["dept"]);


$tmpName = $_FILES['file']['tmp_name'];

$csv_data = array_map('str_getcsv', file($tmpName));

array_walk($csv_data , function(&$x) use ($csv_data) {
  $x = array_combine($csv_data[0], $x);
});
for($i=1;$i<count($csv_data);$i++) {
    $name = test_input($csv_data[$i]['name']);
    $reg = test_input($csv_data[$i]['regno']);
    $mobile = test_input($csv_data[$i]['mobile']);
    $year = test_input($csv_data[$i]['year']);
    $sem = test_input($csv_data[$i]['sem']);
    $batch = test_input($csv_data[$i]['batch']);
    $gender = test_input($csv_data[$i]['gender']);
    $email = test_input($csv_data[$i]['email']);
    $dob = test_input($csv_data[$i]['dob']);
    $fname = test_input($csv_data[$i]['fname']);
    $mname = test_input($csv_data[$i]['mname']);
    $address = test_input($csv_data[$i]['address']);
    $pmobile = test_input($csv_data[$i]['pmobile']);
    
    $sql = "INSERT INTO student(name,reg,mobile,year,sem,batch,gender,email,dob,fname,mname,pmobile,address,dept) VALUES('$name','$reg','$mobile','$year','$sem','$batch','$gender','$email','$dob','$fname','$mname','$pmobile','$address','$dept');";
    try {
        $conn->query($sql);
    } catch (Exception $e) {
        header("Location:/admin/student.php?err=Something Went Wrong in Line Number - $i at $reg - $name ");
        die();
    }
};  

header("Location:/admin/student.php?msg=Student Details added Successfully!");
die();


?>