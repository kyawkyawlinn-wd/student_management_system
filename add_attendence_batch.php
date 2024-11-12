<?php require_once ("./layout/header.php") ?>
<?php
$message = '';
$student_list_attendence = get_all_student_attendence($mysqli, $_GET["batch_id"]);
if (count($student_list_attendence ->fetch_all()) === 0) {
    $student_list = get_all_student_with_batch_id($mysqli, $_GET["batch_id"]);
    while ($std = $student_list->fetch_assoc()) {
        absent_attendence($mysqli, $std['student_batch_id']);
    }
}

if (isset($_GET['present'])) {
    $id = $_GET['present'];
    if (present_attendence($mysqli, $id)) {
        header("Location:./add_attendence_batch.php?batch_id=$_GET[batch_id]");
    } else {
        $message = "Internal server error!";
    }
}
if (isset($_GET['leave'])) {
    $id = $_GET['leave'];
    if (leave_attendence($mysqli, $id)) {
        header("Location:./add_attendence_batch.php?batch_id=$_GET[batch_id]");
    } else {
        $message = "Internal server error!";

    }
}

if (isset($_GET['present_all'])) {
    $student_list = get_all_student_attendence($mysqli, $_GET["batch_id"]);
    while ($std = $student_list->fetch_assoc()) {
        present_attendence($mysqli, $std['attendence_id']);
    }
}


?>
<h2>Pay attencence</h2>
<div class="card">
    <div class="card-header d-flex justify-content-end">
        <a href="./add_attendence_batch.php?batch_id=<?= $_GET["batch_id"] ?>&present_all" class="btn btn-success me-3">Present All</a>
    </div>
    <div class="card-body">
        <table class="table table-border">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Age</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $student_list = get_all_student_attendence($mysqli, $_GET["batch_id"]); ?>
                <?php $i = 1;?>
                <?php while ($student = $student_list->fetch_assoc()) { ?>           
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $student["student_name"] ?></td>
                    <td><?= $student["student_email"] ?></td>
                    <td><?= $student["student_address"] ?></td>
                    <td><?= $student["student_age"] ?></td>
                    <td>
                        <?php if ($student["present"] == 0 && $student["leave"] == 0) {?>
                            <a href="./add_attendence_batch.php?batch_id=<?= $_GET["batch_id"] ?>&present=<?= $student["attendence_id"] ?>" class="btn btn-success btn-sm">Present</a>
                            <a href="./add_attendence_batch.php?batch_id=<?= $_GET["batch_id"] ?>&leave=<?= $student["attendence_id"] ?>" class="btn btn-warning btn-sm">Leave</a>
                        <?php } else {?>
                            <?php if ($student["present"] === "1") { ?>
                                <p class="text-success">Present</p>
                            <?php } elseif ($student["leave"] === "1") { ?>
                                    <p class="text-warning">Leave</p>
                                <?php } else {?>
                                <p class="text-danger">Absent</p>
                            <?php } ?>
                        <?php } ?>
                    </td>
                </tr>                  
                <?php $i++;
                } ?>    
            </tbody>
        </table>
    </div>
</div>
<?php require_once ("./layout/footer.php") ?>