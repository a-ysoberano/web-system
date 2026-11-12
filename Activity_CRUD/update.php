<?php
require 'config/config.php';
/** @var mysqli $mysqli */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

$id = (int)$_POST['student_id'];

$fullname = mysqli_real_escape_string($mysqli, trim($_POST['fullname']));
$email    = mysqli_real_escape_string($mysqli, trim($_POST['email']));
$gender   = mysqli_real_escape_string($mysqli, trim($_POST['gender']));
$course   = mysqli_real_escape_string($mysqli, trim($_POST['course']));

$sql = "UPDATE student 
        SET fullname = '$fullname', 
            email = '$email', 
            gender = '$gender', 
            course = '$course' 
        WHERE student_id = $id";

if (mysqli_query($mysqli, $sql)) {
    header('Location: index.php');
    exit();
} else {
    echo "Error updating record: " . mysqli_error($mysqli);
}
