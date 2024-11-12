<?php require_once("./stroage/db.php") ?>
<?php require_once("./stroage/student_crud.php") ?>
<?php require_once("./stroage/class_crud.php") ?>
<?php require_once("./stroage/teacher_crud.php") ?>
<?php require_once("./stroage/student_batch_crud.php") ?>
<?php require_once("./stroage/batch_crud.php") ?>
<?php require_once("./stroage/attendence_crud.php") ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <script src="./assets/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="main">
      <?php require_once ("./layout/sidebar.php") ?>
      <div class="content">
        <nav class="bg-white d-flex p-3 px-4 justify-content-between align-items-center">
          <div>
            <form method="post">
              <div class="d-flex search">
                <i class="bi bi-search"></i>
                <input type="text" name="search" placeholder="Search" />
              </div>
            </form>
          </div>
          <div>
            <div class="dropdown">
              <div
                type="button"
                data-bs-toggle="dropdown"
              >
                <img class="profile" src="./assets/img/profile.png">
              </div>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
              </ul>
            </div>
          </div>
        </nav>
        <div class="page p-4">