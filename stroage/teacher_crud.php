<?php


function add_teacher($mysqli, $teacher_name, $teacher_email, $teacher_exp)
{
    $sql = "INSERT INTO `teacher`(`teacher_name`, `teacher_email`, `exp`) VALUES ('$teacher_name','$teacher_email','$teacher_exp')";
    return $mysqli->query($sql);
}

function get_all_teacher($mysqli)
{
    $sql = "SELECT * FROM `teacher`";
    return $mysqli->query($sql);
}

function get_teacher_id($mysqli, $teacher_id)
{
    $sql = "SELECT * FROM `teacher` WHERE teacher_id=$teacher_id";
    $result = $mysqli->query($sql);
    return $result->fetch_assoc();
}

function delete_teacher($mysqli, $teacher_id)
{
    $sql = "DELETE FROM `teacher` WHERE teacher_id=$teacher_id";
    return $mysqli->query($sql);
}

function update_teacher($mysqli, $id, $teacher_name, $teacher_email, $teacher_exp)
{
    $sql = "UPDATE `teacher` SET `teacher_name`='$teacher_name',`teacher_email`='$teacher_email',`exp`='$teacher_exp' WHERE teacher_id=$id";
    return $mysqli->query($sql);
}

function get_std_with_filter($mysqli, $search)
{
    $sql = "SELECT * FROM `teacher` WHERE teacher_name LIKE '%$search%' ";
    return $mysqli->query($sql);
}