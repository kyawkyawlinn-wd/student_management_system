<?php


$mysqli = new mysqli("localhost", "root", "");


if ($mysqli->connect_error) {
    echo "Cann't connect to DB!";
} else {
    $sql = "CREATE DATABASE IF NOT EXISTS `student_management_system`";
    if ($mysqli->query($sql)) {
        if ($mysqli->select_db("student_management_system")) {
            if (!create_tables($mysqli)) {
                echo "Can not create Tables!";
                die();
            }
        }
    }
}


function create_tables($mysqli)
{
    $sql = "CREATE TABLE IF NOT EXISTS `student`(`student_id` INT AUTO_INCREMENT,`student_name` VARCHAR(45) NOT NULL,`student_address` VARCHAR(45),`student_age` INT NOT NULL,`student_email`  VARCHAR(100) NOT NULL,PRIMARY KEY(`student_id`))";
    if (!$mysqli->query($sql)) {
        return false;
    }
    $sql = "CREATE TABLE IF NOT EXISTS `class`(`class_id` INT AUTO_INCREMENT,`description` VARCHAR(225) NOT NULL,`class_name` VARCHAR(150),PRIMARY KEY(`class_id`))";
    if (!$mysqli->query($sql)) {
        return false;
    }
    $sql = "CREATE TABLE IF NOT EXISTS `teacher`(`teacher_id` INT AUTO_INCREMENT,`teacher_name` VARCHAR(45) NOT NULL,`teacher_email` VARCHAR(105)  NOT NULL,`exp` INT NOT NULL,PRIMARY KEY(`teacher_id`))";
    if (!$mysqli->query($sql)) {
        return false;
    }
    $sql = "CREATE TABLE IF NOT EXISTS `batch`(`batch_id` INT AUTO_INCREMENT,`batch_name` VARCHAR(80), `fees` INT NOT NULL, `description` VARCHAR(225) NOT NULL, `start_date` DATETIME NOT NULL , `end_date` DATETIME NOT NULL,`teacher_id` INT NOT NULL,`class_id` INT NOT NULL,PRIMARY KEY(`batch_id`),FOREIGN KEY (`class_id`) references `class`(`class_id`),FOREIGN KEY (`teacher_id`) references `teacher`(`teacher_id`))";
    if (!$mysqli->query($sql)) {
        return false;
    }
    $sql = "CREATE TABLE IF NOT EXISTS `student_batch`(`student_batch_id` INT AUTO_INCREMENT,`student_id` INT NOT NULL,`batch_id` INT NOT NULL,PRIMARY KEY(`student_batch_id`),FOREIGN KEY (`batch_id`) references `batch`(`batch_id`),FOREIGN KEY (`student_id`) references `student`(`student_id`))";
    if (!$mysqli->query($sql)) {
        return false;
    }
    $sql = "CREATE TABLE IF NOT EXISTS `attendence`(`attendence_id` INT AUTO_INCREMENT,`date` DATE,`present` BOOLEAN NOT NULL DEFAULT FALSE ,`leave` BOOLEAN NOT NULL DEFAULT FALSE,`student_batch_id` INT NOT NULL,PRIMARY KEY(`attendence_id`),FOREIGN KEY (`student_batch_id`) references `student_batch`(`student_batch_id`))";

    if (!$mysqli->query($sql)) {
        return false;
    }
    return true;
}
