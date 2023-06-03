<?php require("./layout/Header.php") ?>
<?php require("./layout/Navbar.php") ?>
<?php require("./layout/db.php") ?>

<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 mb-0 px-3">
            <h4 class="mb-0" style="display:flex;justify-content:space-between">
                Student Details
                <div>
                    <a class="btn btn-info" href="/assets/student.csv" target="_blank">Format</a>
                    <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" aria-controls="offcanvasExample">
                        Add
                    </button>
                </div>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Add Students</h5>
                        <button type="button" class="btn btn-close text-dark" data-bs-dismiss="offcanvas" aria-label="Close">x</button>
                    </div>
                    <div class="offcanvas-body">
                        <form action="/admin/action/addstudent.php" enctype="multipart/form-data" method="post">
                            <label>Input File (CSV) :</label>
                            <div class="mb-2">
                                <input type="file" accept=".csv" required name="file" class="form-control" placeholder="Name" aria-label="Email" aria-describedby="email-addon">
                            </div>
                            <div class="mb-2">
                                <p class="text-danger">Please Check & Verify the input file before upload!</p>
                            </div>
                            <div class="text-end">
                                <button class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </h4>
        </div>
        <form method="get" class="card-header pb-0 px-3 text-end mb-3">
            <input type="number" name="reg" placeholder="Register No" required class="m-0 border rounded" style="height:35px">
            <button class="btn btn-secondary m-0" style="height:40px">Search</button>
        </form>
        <div class="card-body pt-2 p-3">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Student</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Reg No</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Year / Sem</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Batch</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mobile</th>
                            <th class="text-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dept=$_SESSION["dept"];
                        if(isset($_GET["reg"])){
                            $reg=$_GET["reg"];
                            $sql = "SELECT * FROM student WHERE reg='$reg' order by reg_date ASC";
                        }else{
                            $sql = "SELECT * FROM student WHERE dept='$dept' order by reg_date ASC LIMIT 10";
                        }
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm"><?php echo($row['name']) ?></h6>
                                        <p class="text-xs text-secondary mb-0"><?php echo($row['fname']) ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <p class="text-xs font-weight-bold mb-0"><?php echo($row['reg']) ?></p>
                            </td>
                            <td class="text-center">
                                <span class="text-secondary text-xs font-weight-bold"><?php echo($row['year']) ?>-year / <?php echo($row['sem']) ?>-sem</span>
                            </td>
                            <td class="text-center">
                                <span class="text-secondary text-xs font-weight-bold"><?php echo($row['batch']) ?></span>
                            </td>
                            <td class="text-center">
                                <span class="text-secondary text-xs font-weight-bold"><?php echo($row['mobile']) ?></span>
                            </td>
                            <td class="text-end">
                                <a href="/admin/record.php?id=<?php echo($row['id']) ?>" class="border rounded p-2 text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                    View
                                </a>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="6">
                                    <p class="text-muted pt-4" style="text-align:center">Nothing Found !</p>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
              </div>
        </div>
    </div>
</div>


<?php require("./layout/Footer.php") ?>