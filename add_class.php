<?php require_once ("./layout/header.php") ?>
<?php
$class_name = $description = $class_name_err = $description_err =  "";
$invalid = false;

if (isset($_GET["class_id"])) {
    $class_id = $_GET["class_id"];
    $class = get_class_id($mysqli, $class_id);
    $class_name = $class["class_name"];
    $description = $class["description"];
}


if (isset($_POST['class_name'])) {
    $class_name =  $_POST['class_name'];
    $description = $_POST['description'];
    if ($class_name === "") {
        $class_name_err = "Class name can not be blank!";
    }
    if ($description === "") {
        $description_err = "Description can not be blank!";
    }
    if ($class_name_err === "" && $description_err === "") {
        if (isset($_GET["class_id"])) {
            if (update_class($mysqli, $class_id, $class_name, $description)) {
                header("Location:class_list.php");
            } else {
                $invalid = true;
            }
        } else {
            if (add_class($mysqli, $class_name, $description)) {
                header("Location:class_list.php");
            } else {
                $invalid = true;
            }
        }
    }
}
?>
<?php if (isset($_GET["class_id"])) {
    echo "<h2>Update Class</h2>";
} else {
    echo "<h2>Class Registeration</h2>";
}
?>
<div class="card">
    <div class="card-body">
        <div class="card col-4">
            <div class="card-body">
            <form method="post">
                <?php if ($invalid) { ?>
                    <div class="alert alert-danger">
                    <?php if (isset($_GET["class_id"])) {
                        echo "Class can't be update!";
                    } else {
                        echo "New class can't be register!";
                    }
                    ?>
                </div>
                <?php } ?>
            <div class="form-group my-3">
                <label for="class_name" class="form-label">Class Name</label>
                <input type="text" name="class_name" class="form-control" id="class_name" value="<?= $class_name ?>">
                <div class="text-danger" style="font-size:12px;"><?= $class_name_err ?></div>
            </div>
            <div class="form-group my-3">
                <label for="description" class="form-label">Class Name</label>
                <textarea name="description" id="description" class="form-control" style="height: 150px;"><?= $description ?></textarea>
                <div class="text-danger" style="font-size:12px;"><?= $description_err ?></div>
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>
            </div>
        </div>
            
    </div>
</div>
<?php require_once ("./layout/footer.php") ?>