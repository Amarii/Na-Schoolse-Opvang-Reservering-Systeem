<?php
include "connect.php";
session_start();
$name = $_SESSION['name'];


if(isset($_POST['monday'])){
    $monday = $_POST['monday'];
    $sql = "UPDATE `begeleiders` SET `monday`='$monday' WHERE `name` = '$name'";
    $result = $database->query($sql);
}
if(isset($_POST['tuesday'])){
    $tuesday = $_POST['tuesday'];
    $sql = "UPDATE `begeleiders` SET `tuesday`='$tuesday' WHERE `name` = '$name'";
    $result = $database->query($sql);
}
if(isset($_POST['wednesday'])){
    $wednesday = $_POST['wednesday'];
    $sql = "UPDATE `begeleiders` SET `wednesday`='$wednesday' WHERE `name` = '$name'";
    $result = $database->query($sql);
}
if(isset($_POST['thursday'])){
    $thursday = $_POST['thursday'];
    $sql = "UPDATE `begeleiders` SET `thursday`='$thursday' WHERE `name` = '$name'";
    $result = $database->query($sql);
}
if(isset($_POST['friday'])){
    $friday = $_POST['friday'];
    $sql = "UPDATE `begeleiders` SET `friday`='$friday' WHERE `name` = '$name'";
    $result = $database->query($sql);
}

