<?php require("./layout/Header.php") ?>
<?php require("./layout/Navbar.php") ?>
<?php require("./layout/db.php") ?>

<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h4 class="mb-0" style="display:flex;justify-content:space-between">
                Staff Details
                <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" aria-controls="offcanvasExample">
                    Add
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Add Staff</h5>
                        <button type="button" class="btn btn-close text-dark" data-bs-dismiss="offcanvas" aria-label="Close">x</button>
                    </div>
                    <div class="offcanvas-body">
                        <form action="/admin/action/addstaff.php" method="post">
                            <label>Name :</label>
                            <div class="mb-2">
                                <input type="text" required name="name" class="form-control" placeholder="Name" aria-label="Email" aria-describedby="email-addon">
                            </div>
                            <label>Email :</label>
                            <div class="mb-2">
                                <input type="email" required name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                            </div>
                            <label>Password :</label>
                            <div class="mb-2">
                                <input type="password" required name="password" class="form-control" placeholder="Password" aria-label="Email" aria-describedby="email-addon">
                            </div>
                            <label>Mobile :</label>
                            <div class="mb-2">
                                <input type="number" required name="mobile" class="form-control" placeholder="Mobile" aria-label="Email" aria-describedby="email-addon">
                            </div>
                            <label>Semester :</label>
                            <div class="mb-3">
                                <select name="sem" required class="form-select" id="">
                                    <option value="" selected disabled>Select Semester</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>
                            <div class="text-end">
                                <button class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </h4>
        </div>
        <div class="card-body pt-2 p-3">
            <ul class="list-group">
                <?php
                $dept=$_SESSION["dept"];
                $sql = "SELECT * FROM staff WHERE dept='$dept' order by sem ASC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                ?>
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                    <h6 class="mb-3 text-md"><?php echo($row['sem'])?> - Semester</h6>
                    <span class="mb-2 text-sm">Staff Name: <span class="text-dark font-weight-bold ms-sm-2"><?php echo($row['name'])?></span></span>
                    <span class="mb-2 text-xs">Email Address: <span class="text-dark ms-sm-2 font-weight-bold"><?php echo($row['email'])?></span></span>
                    <span class="text-xs">Mobile Number: <span class="text-dark ms-sm-2 font-weight-bold"><?php echo($row['mobile'])?></span></span>
                    </div>
                    <div class="ms-auto text-end">
                        <form action="/admin/action/deletestaff.php" onsubmit="return confirm('Do you want to delete the Staff Account?')" method="post">
                            <input type="hidden" value="<?php echo($row['id'])?>" name="id">
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