<?php require_once ("./layout/header.php") ?>
<?php

if (isset($_GET['present'])) {
    $id = $_GET['present'];
    if (present_attendence($mysqli, $id)) {
        header("Location:student_attendence.php?student_batch_id=$_GET[student_batch_id]");
    }
}
if (isset($_GET['leave'])) {
    $id = $_GET['leave'];
    if (leave_attendence($mysqli, $id)) {
        header("Location:student_attendence.php?student_batch_id=$_GET[student_batch_id]");
    }
}
if (isset($_GET['absent'])) {
    $id = $_GET['absent'];
    if (absent_attendence_update($mysqli, $id)) {
        header("Location:student_attendence.php?student_batch_id=$_GET[student_batch_id]");
    }
}


?>
<div class="card">
    <div class="card-body">
        <table class="table table-border">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $detail_list = get_attendence_with_student_batch($mysqli, $_GET["student_batch_id"]); ?>
                <?php $i = 1;?>
                <?php while ($student = $detail_list->fetch_assoc()) { ?>             
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $student["date"] ?></td>
                    <td><?php if ($student["present"] == 1) { ?>
                        <p class="text-success">Present</p>
                        <?php } elseif ($student["leave"] == 1) { ?>
                            <p class="text-warning">Leave</p>
                        <?php } else { ?>   
                            <p class="text-danger">Absent</p>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="./student_attendence.php?student_batch_id=<?= $_GET["student_batch_id"] ?>&present=<?= $student["attendence_id"] ?>" class="btn btn-success btn-sm">Present</a>
                        <a href="./student_attendence.php?student_batch_id=<?= $_GET["student_batch_id"] ?>&leave=<?= $student["attendence_id"] ?>" class="btn btn-warning btn-sm">Leave</a>
                        <a href="./student_attendence.php?student_batch_id=<?= $_GET["student_batch_id"] ?>&absent=<?= $student["attendence_id"] ?>" class="btn btn-danger btn-sm">Absent</a>
                    </td>
                </tr>                  
                <?php $i++;
                } ?>    
            </tbody>
        </table>
    </div>
</div>
<?php require_once ("./layout/footer.php") ?>