<?php


function add_class($mysqli, $class_name, $description)
{
    $sql = "INSERT INTO `class` (`class_name`,`description`) VALUES ('$class_name','$description')";
    return $mysqli->query($sql);
}

function get_all_class($mysqli)
{
    $sql = "SELECT * FROM `class`";
    return $mysqli->query($sql);
}

function get_class_id($mysqli, $class_id)
{
    $sql = "SELECT * FROM `class` WHERE `class_id`=$class_id";
    $resule = $mysqli->query($sql);
    return $resule->fetch_assoc();
}

function update_class($mysqli, $class_id, $class_name, $description)
{
    $sql = "UPDATE  `class` SET `class_name`='$class_name', `description`='$description'  WHERE `class_id`=$class_id";
    return $mysqli->query($sql);
}

function delete_class($mysqli, $class_id)
{
    $sql = "DELETE  FROM `class` WHERE `class_id`=$class_id";
    return $mysqli->query($sql);
}
