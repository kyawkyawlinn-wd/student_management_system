<?php require_once ("./layout/header.php") ?>
<?php
$teacher_name  = $teacher_name_err = $teacher_email = $teacher_email_err = $exp = $exp_err = "";
$invalid = false;

if (isset($_GET["teacher_id"])) {
    $teacher_id = $_GET["teacher_id"];
    $teacher = get_teacher_id($mysqli, $teacher_id);
    $teacher_name = $teacher["teacher_name"];
    $teacher_email = $teacher["teacher_email"];
    $exp = $teacher["exp"];
}


if (isset($_POST['teacher_name'])) {
    $teacher_name =  $_POST['teacher_name'];
    $teacher_email = $_POST['teacher_email'];
    $exp = $_POST['exp'];
    if ($teacher_name === "") {
        $teacher_name_err = "Teacher name can not be blank!";
    }
    if ($teacher_email === "") {
        $teacher_email_err = "Teacher email can not be blank!";
    }
    if ($exp === "") {
        $exp_err = "Teacher EXP can not be blank!";
    }


    if ($teacher_name_err === "" && $teacher_email_err === "" && $exp_err === "") {
        if (isset($_GET["teacher_id"])) {
            if (update_teacher($mysqli, $teacher_id, $teacher_name, $teacher_email, $exp)) {
                header("Location:teacher_list.php");
            } else {
                $invalid = true;
            }
        } else {
            if (add_teacher($mysqli, $teacher_name, $teacher_email, $exp)) {
                header("Location:teacher_list.php");
            } else {
                $invalid = true;
            }
        }
    }
}
?>
<?php if (isset($_GET["teacher_id"])) {
    echo "<h2>Update Teacher</h2>";
} else {
    echo "<h2>Teacher Registeration</h2>";
}
?>
<div class="card">
    <div class="card-body">
        <div class="card col-4">
            <div class="card-body">
            <form method="post">
                <?php if ($invalid) { ?>
                    <div class="alert alert-danger">
                    <?php if (isset($_GET["teacher_id"])) {
                        echo "Teacher can't be update!";
                    } else {
                        echo "Teacher can't be register!";
                    }
                    ?>
                    
                </div>
                <?php } ?>
            <div class="form-group my-3">
                <label for="teacher_name" class="form-label">Teacher Name</label>
                <input type="text" name="teacher_name" class="form-control" id="teacher_name" value="<?= $teacher_name ?>">
                <div class="text-danger" style="font-size:12px;"><?= $teacher_name_err ?></div>
            </div>
            <div class="form-group my-3">
                <label for="teacher_email" class="form-label">Teacher Email</label>
                <input type="text" name="teacher_email" class="form-control" id="teacher_email" value="<?= $teacher_email ?>">
                <div class="text-danger" style="font-size:12px;"><?= $teacher_email_err ?></div>
            </div>
            <div class="form-group my-3">
                <label for="exp" class="form-label">Teacher EXP</label>
                <input type="text" name="exp" class="form-control" id="exp" value="<?= $exp ?>">
                <div class="text-danger" style="font-size:12px;"><?= $exp_err ?></div>
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>
            </div>
        </div>
            
    </div>
</div>
<?php require_once ("./layout/footer.php") ?>