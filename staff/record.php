<?php require("./layout/Header.php") ?>
<?php require("./layout/Navbar.php") ?>
<?php require("./layout/db.php") ?>
<?php
$id=$_GET["id"];
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" aria-controls="offcanvasExample">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </button>
                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Add Result</h5>
                                    <button type="button" class="btn btn-close text-dark" data-bs-dismiss="offcanvas" aria-label="Close">x</button>
                                </div>
                                <div class="offcanvas-body">
                                    <form action="/staff/action/result.php" enctype="multipart/form-data" method="post">
                                        <label>Exam Type :</label>
                                        <input type="hidden" name="reg" value="<?php echo($reg)?>">
                                        <input type="hidden" name="sem" value="<?php echo($sem)?>">
                                        <input type="hidden" name="id" value="<?php echo($id)?>">
                                        <div class="mb-2">
                                            <select name="type" class="form-select" required>
                                                <option value="" selected disabled>Select Exam Type</option>
                                                <option value="IAT-1">IAT-1</option>
                                                <option value="IAT-2">IAT-2</option>
                                                <option value="Model">Model</option>
                                            </select>
                                        </div>
                                        <div id="i0">
                                            
                                        </div>
                                        <script>
                                            i=0
                                            function addlist(){
                                                document.getElementById("i"+i).innerHTML =`
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label>Code :</label>
                                                        <div class="mb-2">
                                                            <input type="text" name="subject[]" class="form-control" placeholder="Subject Code">
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <label>Mark :</label>
                                                        <div class="mb-2">
                                                            <input type="number" name="mark[]" class="form-control" placeholder="Marks">
                                                        </div>
                                                    </div>
                                                    <div class="col-1 d-flex align-items-end"><p onclick="delete_node(${i})">X</p></div>
                                                </div>
                                                `
                                                function insertAfter(referenceNode, newNode) {
                                                    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
                                                }
                                                var el = document.createElement("tr");
                                                el.id = 'i'+(i+1);
                                                var div = document.getElementById('i'+i);
                                                insertAfter(div, el);
                                                i = i+1;
                                            }
                                            addlist()
                                            function delete_node(item){
                                                document.getElementById("i"+item).remove();
                                            }
                                        </script>
                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary" onclick="addlist()">Add</button>
                                            <button class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
                            <form action="/staff/action/deleteresult.php" method="post" class="text-center">
                                <input type="hidden" name="id" value="<?php echo($row['id']) ?>">
                                <input type="hidden" name="uid" value="<?php echo($id) ?>">
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    <?php
                            }
                    ?>
                        <div class="col-sm-12 col-md-12 col-lg-3 mb-2">
                            <p class="text-center text-bold text-underline text-lg">Prediction</p>
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


<?php require("./layout/Footer.php") ?>