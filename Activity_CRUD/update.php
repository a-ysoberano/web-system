<?php
require 'config/config.php';
/** @var mysqli $mysqli */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = (int)$_POST['user_id'];
    $firstname = mysqli_real_escape_string($mysqli, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($mysqli, $_POST['lastname']);
    $middlename = mysqli_real_escape_string($mysqli, $_POST['middlename']);
    $birthdate = mysqli_real_escape_string($mysqli, $_POST['birthdate']);
    $gender = mysqli_real_escape_string($mysqli, $_POST['gender']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $course_id = (int)$_POST['course_id'];

    $check = mysqli_query($mysqli, "SELECT * FROM user WHERE Email = '$email' AND user_ID != $user_id");
    if (mysqli_num_rows($check) > 0) {
        die("Error: This email is already used by another user. <a href='edit.php?id=$user_id'>Go back</a>");
    }

    $sql = "UPDATE user SET 
            Firstname = '$firstname', 
            Lastname = '$lastname', 
            Middlename = '$middlename', 
            Birthdate = '$birthdate', 
            Gender = '$gender', 
            Email = '$email' 
            WHERE user_ID = $user_id";

    if (mysqli_query($mysqli, $sql)) {

        mysqli_query($mysqli, "DELETE FROM user_course WHERE user_ID = $user_id");
        if ($course_id > 0) {
            mysqli_query($mysqli, "INSERT INTO user_course (user_ID, course_ID) VALUES ($user_id, $course_id)");
        }

        header('Location: index.php');
        exit();
    } else {
        die("Database Error: " . mysqli_error($mysqli));
    }
}
