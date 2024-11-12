<?php


function add_batch($mysqli, $batch_name, $start_date, $end_date, $fees, $description, $teacher_id, $class_id)
{
    $sql = "INSERT INTO `batch` (`batch_name`,`start_date`,`end_date`,`fees`,`description`,`teacher_id`,`class_id`) 
    VALUES ('$batch_name','$start_date','$end_date','$fees','$description','$teacher_id','$class_id')";
    return $mysqli->query($sql);
}

function get_all_batch($mysqli)
{
    $sql = "SELECT * FROM `batch`";
    return $mysqli->query($sql);
}

function get_last_batch_with_class_id($mysqli, $class_id)
{
    $sql = "SELECT * FROM `batch` b INNER JOIN `class` c ON b.class_id = c.class_id WHERE c.class_id=$class_id ORDER BY b.batch_id DESC LIMIT 1";
    $resule = $mysqli->query($sql);
    return $resule->fetch_assoc();
}
function get_all_batch_join($mysqli)
{
    $sql = "SELECT t1.*,t2.teacher_name ,t3.class_name  FROM `batch` t1 INNER JOIN `teacher` t2 ON  t1.teacher_id = t2.teacher_id INNER JOIN `class` t3 ON t1.class_id = t3.class_id";
    return $mysqli->query($sql);
}

function get_batch_with_student_id($mysqli, $student_id)
{
    $sql = "SELECT t.teacher_name,b.batch_name,c.class_name,sb.student_id,sb.student_batch_id FROM `batch` b INNER JOIN `student_batch` sb ON sb.batch_id = b.batch_id INNER JOIN `class` c ON c.class_id=b.class_id INNER JOIN `teacher` t ON t.teacher_id=b.teacher_id WHERE sb.student_id=$student_id";
    return $mysqli->query($sql);
}

function get_batch_id($mysqli, $batch_id)
{
    $sql = "SELECT * FROM `batch` WHERE `batch_id`=$batch_id";
    $resule = $mysqli->query($sql);
    return $resule->fetch_assoc();
}

function get_batch_end_date_id($mysqli, $batch_id)
{
    $sql = "SELECT `end_date` FROM `batch` WHERE `batch_id`=$batch_id";
    $resule = $mysqli->query($sql);
    return $resule->fetch_assoc()["end_date"];
}

function update_batch($mysqli, $batch_id, $batch_name, $start_date, $end_date, $fees, $description, $teacher_id, $class_id)
{
    $sql = "UPDATE  `batch` SET `batch_name`='$batch_name', `start_date`='$start_date', `end_date`='$end_date', `fees`='$fees',`description`='$description',`teacher_id`=$teacher_id,`class_id`=$class_id  WHERE `batch_id`=$batch_id";
    $resule = $mysqli->query($sql);
    return $resule->fetch_assoc();
}

function delete_batch($mysqli, $batch_id)
{
    $sql = "DELETE  FROM `batch` WHERE `batch_id`=$batch_id";
    return $mysqli->query($sql);
}

function search_batch_with_filter($mysqli, $search) {
    $sql = "SELECT * FROM `batch` WHERE teacher_name LIKE '%$search%'";
    return $mysqli->query($sql);
}