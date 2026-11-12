<?php
require 'config/config.php';
/** @var mysqli $mysqli */ // ewan ko bat di gumagana pag wala to, sa computer ni sir pwede naman

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $name_e = mysqli_real_escape_string($mysqli, $name);
    $email_e = mysqli_real_escape_string($mysqli, $email);
    $password_e = mysqli_real_escape_string($mysqli, $password);

    $sql = "INSERT INTO users (id, username, email, password, date_created) VALUES (NULL, '$name_e', '$email_e', MD5('$password_e'), NOW())";

    if (mysqli_query($mysqli, $sql)) {
        header('Location: index.php');
        // echo 'tapos na';
        exit();
    } else {
        // echo "Error: " . mysqli_error($mysqli);
        $errors[] =  'Insert failed' . mysqli_error($mysqli);
    }
}
