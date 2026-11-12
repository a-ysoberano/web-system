<?php
require 'config/config.php';
/** @var mysqli $mysqli */

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    mysqli_query($mysqli, "DELETE FROM user WHERE user_ID = $id");
}

header('Location: index.php');
exit();
