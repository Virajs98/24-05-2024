<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['user_master_id'])) {
    $page_title = "allemployee";
    $Dashboard = "ADMIN";
    $Department = "DEPARTMENT";
    $Employee = "EMPLOYEE";
    $Dashboard_link = "admin-dashboard.php";
    $Department_link = "../department/create_dept.php";
    $All_Employee = "ALL EMPLOYEES";
    $My_Team = "MY TEAM";
    $AllEmployee_link = "allEmployee.php";
    $MyTeam_link = "admin_myteam.php";
    include "../master/db_conn.php";
    include "../master/pre-header.php";
    include "../master/header.php";
    include "../master/navbar_admin.php";
    include "../master/breadcrumbs.php";

?>
    <html>

    

    <body>
        <div class="container d-flex align-items-center" style="min-height: 30vh">
            <div class="p-3">
                <?php include '../master/members.php';
                if (mysqli_num_rows($res) > 0) { ?>

                    <h1 class="display-4 fs-1">Members</h1>
                    <div class="d-flex justify-content-end" >
                        <a class="btn btn-primary" href="../create.php">Add new</a>
                    </div>
                    <table class="table table-xl " style="width: 32rem;" data-show-toggle="false" >
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">User name</th>
                                <th scope="col">Role</th>
                                <th scope="col">Is_Manager</th>
                                <th scope="col">Manager ID</th>
                                <th scope="col" style="display:none">Department id</th>
                                <th scope="col">Department Name</th>
                                <th scope="col" >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($rows = mysqli_fetch_assoc($res)) { ?>
                                <tr>
                                    <td scope="row"><?= $rows['user_master_id'] ?></td>
                                    <td><?= $rows['name'] ?></td>
                                    <td><?= $rows['email'] ?></td>
                                    <td><?= $rows['role'] ?></td>
                                    <td><?= $rows['is_manager'] ?></td>
                                    <td><?= $rows['manager_id'] ?></td>
                                    <td><?= $rows['dept_id'] ?></td>
                                    <td><?= $rows['dept_name'] ?></td>
                                    <td>
                                    <a class="btn btn-primary" href="update.php?Id=<?php echo $rows['user_master_id']; ?> &name=<?php echo $rows['name']; ?> &email=<?php echo $rows['email']; ?> &ism=<?php echo $rows['is_manager']; ?> &mid=<?php echo $rows['manager_id']; ?> &did=<?php echo $rows['dept_id']; ?> &dname=<?php echo $rows['dept_name']; ?> &role=<?php echo $rows['role']; ?>"> Edit </a>
                                        <button id="delete" type="button" class="btn btn-success deletebtn">DELETE</button>
                                    </td>

                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script>
            $(document).ready(function() {

                $('.deletebtn').on('click', function() {

                    $('#deletemodal').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#delete_id').val(data[0]);

                });
            });
        </script>
        <!-- ########################################################################## -->
        <!-- delete popup form -->
        <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete department</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="delete.php" method='post'>
                        <div class="modal-body">
                            <input type="hidden" name="delete_id" id="delete_id">
                            <h4> Do you want to Delete this Data ??</h4>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary" name="deletedata" value="deletedata">Yes !! Delete it.</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- delete popup form -->
        <!-- ########################################################################## -->
    </body>

    </html>
<?php
    include "../master/footer.php";
    include "../master/after-footer.php";
} else {
    header('Location:../login.php');
}
?>