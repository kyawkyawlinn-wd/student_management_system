<?php require_once ("./layout/header.php") ?>
<?php
$student_name =  $student_name_err =  "";
$student_email =  $student_email_err =  "";
$student_address =  $student_address_err =  "";
$student_age =  $student_age_err =  "";
$student_batch  = "";
$invalid = true;
$validation_message = "";





if (isset($_POST['student_name'])) {
    $student_name =  $_POST['student_name'];
    $student_email =  $_POST['student_email'];
    $student_address =  $_POST['student_address'];
    $student_age =  $_POST['student_age'];
    $student_batch =  $_POST['student_batch'];
    if ($student_name === "") {
        $student_name_err = "Class name can not be blank!";
        $invalid = false;
    }
    if ($student_email === "") {
        $student_email_err = "Class name can not be blank!";
        $invalid = false;
    }
    if ($student_address === "") {
        $student_address_err = "Class name can not be blank!";
        $invalid = false;
    }
    if ($student_age === "") {
        $student_age_err = "Class name can not be blank!";
        $invalid = false;
    }


    if ($invalid) {
        if (isset($_GET["class_id"])) {
            if (update_class($mysqli, $class_id, $class_name, $description)) {
                header("Location:class_list.php");
            } else {
                $invalid = true;
            }
        } else {
            if (add_student($mysqli, $student_name, $student_address, $student_age, $student_email)) {
                if ($student_batch === "") {
                    header("Location:student_list.php");
                } else {
                    $current_student = get_last_student($mysqli);
                    $batch = get_last_batch_with_class_id($mysqli, $student_batch);
                    if (add_student_batch($mysqli, $current_student["student_id"], $batch["batch_id"])) {
                        header("Location:student_list.php");
                    } else {
                        $validation_message = "Internal server error!";
                    }
                }
            } else {
                if ($mysqli->errno === 1062) {
                    $validation_message = "Student is already register!";
                } else {
                    $validation_message = "Internal server error!";
                }
            }
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
                <label for="student_name" class="form-label">Student Name</label>
                <input type="text" name="student_name" class="form-control" id="student_name" value="<?= $student_name ?>">
                <div class="text-danger" style="font-size:12px;"><?= $student_name_err ?></div>
            </div>
            <div class="form-group my-3">
                <label for="student_email" class="form-label">Student Email</label>
                <input type="text" name="student_email" class="form-control" id="student_email" value="<?= $student_email ?>">
                <div class="text-danger" style="font-size:12px;"><?= $student_email_err ?></div>
            </div>
            <div class="row">
                <div class="form-group my-3 col-6">
                    <label for="student_age" class="form-label">Student Age</label>
                    <input type="text" name="student_age" class="form-control" id="student_age" value="<?= $student_age ?>">
                    <div class="text-danger" style="font-size:12px;"><?= $student_age_err ?></div>
                </div>
                <div class="form-group my-3 col-6">
                    <label for="student_batch" class="form-label">Class</label>
                    <select name="student_batch" class="form-select" id="student_batch">
                        <option value="" selected >Select Class</option>
                            <?php $class_list = get_all_class($mysqli); ?>
                            <?php while ($class = $class_list->fetch_assoc()) { ?>
                                
                                <option value="<?= $class['class_id']?>" <?php if ($class['class_id'] === $student_batch) {
                                    echo "selected";
                                }?> ><?= $class['class_name']?></option>
                            <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group my-3">
                <label for="student_address" class="form-label">Address</label>
                <textarea name="student_address" id="student_address" class="form-control" style="height: 100px;"><?= $student_address ?></textarea>
                <div class="text-danger" style="font-size:12px;"><?= $student_address_err ?></div>
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>
            </div>
        </div>
            
    </div>
</div>
<?php require_once ("./layout/footer.php") ?>