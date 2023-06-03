<?php require("./layout/Header.php") ?>
<?php require("./layout/Navbar.php") ?>
<?php require("./layout/db.php") ?>

<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 mb-0 px-3">
            <h4 class="mb-0" style="display:flex;justify-content:space-between">
                Attendance Details
                <div>
                    <a class="btn btn-info" href="/assets/attendance.csv" target="_blank">Format</a>
                    <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" aria-controls="offcanvasExample">
                        Add
                    </button>
                </div>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Update Attendance</h5>
                        <button type="button" class="btn btn-close text-dark" data-bs-dismiss="offcanvas" aria-label="Close">x</button>
                    </div>
                    <div class="offcanvas-body">
                        <form action="/staff/action/attendance.php" enctype="multipart/form-data" method="post">
                            <label>Input File (CSV) :</label>
                            <div class="mb-2">
                                <input type="file" accept=".csv" required name="file" class="form-control" placeholder="Name" aria-label="Email" aria-describedby="email-addon">
                            </div>
                            <div class="mb-2">
                                <p class="text-danger">Please Check & Verify the input file before upload!</p>
                            </div>
                            <div class="text-end">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </h4>
        </div>
        <div class="card-body pt-2 p-3">
            <ul class="list-group">
                <?php
                $dept=$_SESSION["sdept"];
                $sem=$_SESSION["ssem"];
                $sql = "SELECT DISTINCT attendance.date FROM attendance INNER JOIN student ON attendance.reg=student.reg WHERE student.sem='$sem' AND student.dept='$dept' ORDER BY date DESC LIMIT 10";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                ?>
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                    <h6 class="mb-3 text-md"><?php echo($row['date'])?></h6>
                    <?php
                        $date=$row['date'];
                        $sql = "SELECT attendance.id FROM attendance INNER JOIN student ON attendance.reg=student.reg WHERE student.sem='$sem' AND student.dept='$dept' AND attendance.date='$date'";
                        $result1 = $conn->query($sql);
                    ?>
                    <span class="mb-2 text-xs">Total Records : <span class="text-dark ms-sm-2 font-weight-bold"><?php echo($result1->num_rows)?></span></span>
                    </div>
                    <div class="ms-auto text-end">
                        <form action="/staff/action/deleteattendance.php" onsubmit="return confirm('Do you want to delete Total Record?')" method="post">
                            <input type="hidden" value="<?php echo($row['date'])?>" name="date">
                            <button class="btn btn-link text-danger text-gradient px-3 mb-0">
                                <i class="far fa-trash-alt me-2"></i>Delete
                            </button>
                        </form>
                    </div>
                </li>
                <?php
                    }
                } else {
                ?>
                    <p class="text-muted" style="text-align:center">Nothing Found !</p>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>


<?php require("./layout/Footer.php") ?>