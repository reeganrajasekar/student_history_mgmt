<?php require("./layout/Header.php") ?>
<?php require("./layout/Navbar.php") ?>
<?php require("./layout/db.php") ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
            <div class="card-body p-4">
                <div class="row">
                <div class="col-8">
                    <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Students</p>
                    <h5 class="font-weight-bolder mb-0">
                        <?php
                        $dept=$_SESSION["sdept"];
                        $sem=$_SESSION["ssem"];
                        $sql = "SELECT * FROM student WHERE  sem='$sem' AND dept='$dept'";
                        $result = $conn->query($sql);
                        echo $result->num_rows;
                        ?>
                    </h5>
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card bg-gradient-warning">
            <div class="card-body p-4">
                <div class="row">
                <div class="col-8">
                    <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Records</p>
                    <h5 class="font-weight-bolder mb-0">
                        <?php
                        $sem=$_SESSION["ssem"];
                        $dept=$_SESSION["sdept"];
                        $sql = "SELECT DISTINCT attendance.date FROM attendance INNER JOIN student ON attendance.reg=student.reg WHERE student.sem='$sem' AND student.dept='$dept'";
                        $result = $conn->query($sql);
                        echo $result->num_rows;
                        ?>
                    </h5>
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                        <i class="ni ni-world text-lg opacity-10 text-warning" aria-hidden="true"></i>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    
</div>


<?php require("./layout/Footer.php") ?>