<?php 
require("../layout/db.php");
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

  $type = test_input($_POST["type"]);
  $sem = test_input($_POST["sem"]);
  $id = test_input($_POST["id"]);
  $reg = test_input($_POST["reg"]);
  $data = json_encode([$_POST["subject"],$_POST['mark']]);

  $sql = "INSERT INTO result(reg,sem,type,data) VALUES('$reg','$sem','$type','$data');";
  try {
      $conn->query($sql);
      header("Location:/staff/record.php?msg=Result Added Successfully!&id=$id");
      die();
  } catch (Exception $e) {
      header("Location:/staff/record.php?&id=$id&err=Something Went Wrong in Line Number - $i at $reg ");
      die();
  } 


?>