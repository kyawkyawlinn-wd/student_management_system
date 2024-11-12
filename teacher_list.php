<?php require_once ("./layout/header.php") ?>
<?php
$message = "";
if (isset($_GET["delete_id"])) {
    $teacher_id = $_GET["delete_id"];
    if (delete_teacher($mysqli, $teacher_id)) {
        $message = "Teacher is deleted!";
    } else {
        if ($mysqli->errno === 1146) {
            $message = "Your sql sentence is wrong!";
        } elseif ($mysqli->errno === 1451) {
            $message = "Teacher is teaching class,so can't delete, if you want to delete, fire first!";
        } else {
            $message = $mysqli->error;
        }
    }
}
?>
<h2>Teacher List</h2>
<?php if ($message) { ?>
<div class="alert alert-danger"><?= $message ?></div>
<?php } ?>
<div class="card">
    <div class="card-header d-flex justify-content-end">
        <a href="./add_teacher.php" class="btn btn-secondary"> Add New Teacher</a>
    </div>
    <div class="card-body">
        <table class="table table-border">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>EXP</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $teacher_list = get_all_teacher($mysqli); ?>
            <?php 
                if(isset($_POST['search'])) {
                    $search = $_POST['search'];
                    $teacher_list = get_std_with_filter($mysqli, $search);
                }
            ?>
                <?php $i = 1;?>
                <?php while ($teacher = $teacher_list->fetch_assoc()) { ?>             
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $teacher['teacher_name'] ?></td>
                    <td><?= $teacher['teacher_email'] ?></td>
                    <td><?= $teacher['exp'] ?> years</td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="./add_teacher.php?teacher_id=<?= $teacher["teacher_id"] ?>"><i class="bi bi-pen"></i></a>
                        <button class="btn btn-sm btn-danger ms-2 confirmDelete" data-id="<?= $teacher["teacher_id"] ?>" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>                  
                <?php $i++;
                } ?>  
            </tbody>
        </table>
    </div>
</div>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade modal-sm" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure!</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Do you want to delete this class?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="deleted">Delete</button>
      </div>
    </div>
  </div>
</div>
<script>
    let deleteId =undefined;
    let confirmBtn = document.querySelectorAll(".confirmDelete");
    let deleted = document.querySelector("#deleted");
    confirmBtn.forEach(element => {
    element.addEventListener("click",()=>{
          deleteId = element.getAttribute('data-id')
    })
});
deleted.addEventListener("click",()=>{
    location.replace("./teacher_list.php?delete_id="+deleteId);
})
</script>
<?php require_once ("./layout/footer.php") ?>