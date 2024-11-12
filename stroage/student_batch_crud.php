<?php


function add_student_batch($mysqli, $student_id, $batch_id)
{
    $sql = "INSERT INTO `student_batch` (`student_id`,`batch_id`) VALUES ($student_id,$batch_id)";
    return $mysqli->query($sql);
}

function get_all_student_batch($mysqli)
{
    $sql = "SELECT * FROM `student_batch`";
    return $mysqli->query($sql);
}

function get_student_batch_id($mysqli, $student_batch_id)
{
    $sql = "SELECT * FROM `student_batch` WHERE `student_batch_id`=$student_batch_id";
    $resule = $mysqli->query($sql);
    return $resule->fetch_assoc();
}

function update_student_batch($mysqli, $student_batch_id, $student_id, $batch_id)
{
    $sql = "UPDATE  `student_batch` SET `student_id`='$student_id', `batch_id`='$batch_id'  WHERE `student_batch_id`=$student_batch_id";
    return $mysqli->query($sql);
}

function delete_student_batch($mysqli, $student_batch_id)
{
    $sql = "DELETE  FROM `student_batch` WHERE `student_batch_id`=$student_batch_id";
    return $mysqli->query($sql);
}


