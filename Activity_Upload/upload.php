<?php
if (isset($_POST['upload'])) {

    $target_dir = "uploads/";

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_name   = basename($_FILES["myfile"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk    = 1;

    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (file_exists($target_file)) {
        echo "Sorry, file already exists.<br>";
        $uploadOk = 0;
    }

    if ($_FILES["myfile"]["size"] > 300 * 1024 * 1024) {
        echo "Sorry, your file is too large (max 300MB).<br>";
        $uploadOk = 0;
    }

    $allowed_types = ["xlsx", "xls", "csv"];
    if (!in_array($fileType, $allowed_types)) {
        echo "Sorry, only Excel files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Your file was not uploaded.<br>";
    } else {
        if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars($file_name) . " has been uploaded successfully.<br>";
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }
} else {
    echo "No file uploaded.";
}
