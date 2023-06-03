<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    SJCET-TNJ
  </title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <script src="/assets/js/plugins/chartjs.min.js"></script>
  <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
  <link id="pagestyle" href="/assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
</head>
<body class="g-sidenav-show container  bg-gray-100">

<?php require("./admin/layout/db.php") ?>
<?php
session_start();
$id=$_SESSION["id"];
$sql = "SELECT * FROM student WHERE id='$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reg=$row["reg"];
        $name=$row["name"];
        $sem=$row["sem"];
        $fname=$row["fname"];
        $email=$row["email"];
    }
}
?>
<div class="container-fluid">
    <div class="page-header min-height-100 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        <?php echo($name); ?>
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        <?php echo($reg." - ".$email); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12 col-xl-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Attendance Logs</h6>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-8">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-12 d-flex align-items-center justify-content-between">
                            <h6 class="mb-0">Exam Results</h6>
                    
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="row gx-3">
                        <script>mark=[]</script>
                    <?php
                        $sql = "SELECT * FROM result WHERE reg='$reg' and sem='$sem'";
                        $result = $conn->query($sql);
                        if($result->num_rows){
                            while($row=$result->fetch_assoc()){
                    ?>
                        <div class="col-sm-12 col-md-12 col-lg-3  mb-2">
                            <p class="text-center text-bold text-underline text-lg"><?php echo($row["type"]) ?></p>
                            <script>
                                data=<?php echo($row["data"]) ?>;
                                text=``;
                                subject=[]
                                for(k=0;k<data.length;k++){
                                    subject.push(data[0][k])
                                    mark.push(data[1][k])
                                    text+=`<p class='text-center'>${data[0][k]} - ${data[1][k]}</p>`;
                                }
                                document.write(text)
                            </script>
                        </div>
                    <?php
                            }
                    ?>
                        <div class="col-sm-12 col-md-12 col-lg-3 mb-2">
                            <p class="text-center text-bold text-underline text-lg">Prodiction</p>
                            <script>
                                text=``;
                                j=subject.length
                                for(k=0;k<subject.length;k++){
                                    total=0
                                    m=k;
                                    while(m<mark.length){
                                        total+=parseInt(mark[m])
                                        m+=j
                                    }
                                    total=Math.round(total/(j+1))
                                    text+=`<p class='text-center'>${subject[0]} - ${total}</p>`;
                                }
                                document.write(text)
                            </script>
                        </div>
                    <?php
                        }else{
                            echo("<p class='text-secondary text-center mt-4'>Nothing Found!</p>");
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
<?php
$sql = "SELECT * FROM attendance WHERE reg='$reg' and sem='$sem' and status='Present'";
$result = $conn->query($sql);
$present = $result->num_rows;
$sql = "SELECT * FROM attendance WHERE reg='$reg' and sem='$sem' and status='Absent'";
$result = $conn->query($sql);
$absent = $result->num_rows;
$sql = "SELECT * FROM attendance WHERE reg='$reg' and sem='$sem' and status='OD'";
$result = $conn->query($sql);
$od = $result->num_rows;
?>
<script>
var ctx = document.getElementById("chart-bars").getContext("2d");

new Chart(ctx, {
  type: "pie",
  data: {
    labels: ["Absent", "Present" , 'OD'],
    datasets: [{
      label: "Sales",
      tension: 0.4,
      borderWidth: 0,
      borderRadius: 4,
      borderSkipped: false,
      backgroundColor: ["#8f00ff","#ddd","#FF6347"],
      data: [<?php echo($present.",".$absent.",".$od) ?>],
      maxBarThickness: 6
    }, ]
  },
});
</script>


<script src="/assets/js/core/popper.min.js"></script>
  <script src="/assets/js/core/bootstrap.min.js"></script>
  <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="/assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>
</html>