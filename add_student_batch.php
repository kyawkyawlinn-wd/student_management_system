<?php require_once ("./layout/header.php") ?>
<?php
$student_id =  $student_id_err =  "";
$invalid = true;
$validation_message = "";





if (isset($_POST['student_id'])) {
    $student_id =  $_POST['student_id'];
    if ($student_id === "") {
        $student_id_err = "Class name can not be blank!";
        $invalid = false;
    }

    if ($invalid) {
        if (add_student_batch($mysqli, $student_id, $_GET["batch_id"])) {
            header("Location:student_batch_list.php?batch_id=$_GET[batch_id]&class=$_GET[class]");
        } else {
            $validation_message = "Internal server Error";
        }
    }

}
?>

<h2>Student Registeration</h2>
<div class="card">
    <div class="card-body">
        <div class="card col-4">
            <div class="card-body">
            <form method="post">
            <?php if ($validation_message) { ?>
                <div class="alert alert-danger">
                    <?= $validation_message ?>
                </div>
                <?php } ?>
            <div class="form-group my-3">
                <label for="student_id" class="form-label">Student Name</label>
                <select name="student_id" id="student_id" class="form-select">
                <option value="" selected  >Select Student</option>
                        <?php $student_list = get_all_student_without($mysqli, $_GET['batch_id']); ?>
                        <?php while ($student = $student_list->fetch_assoc()) { ?>
                            <option value="<?= $student['student_id']?>" 
                            <?php if ($student['student_id'] === $student_id) {
                                echo "selected";
                            }?>  
                            ><?= $student['student_name']?></option>
                        <?php } ?>
                </select>
                
                <div class="text-danger" style="font-size:12px;"><?= $student_id_err ?></div>
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>
            </div>
        </div>
            
    </div>
</div>
<?php require_once ("./layout/footer.php") ?>