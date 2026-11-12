<?php
require 'config/config.php';
/** @var mysqli $mysqli */

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = (int)$_GET['id'];

$sql = "SELECT * FROM student WHERE student_id = $id";
$result = mysqli_query($mysqli, $sql);
$student = mysqli_fetch_assoc($result);

if (!$student) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="form-container">
        <h1>Edit Student</h1>

        <form action="update.php" method="post">

            <input type="hidden" name="student_id" value="<?= $id ?>" />

            <div class="form-group">
                <label for="fullname">Full Name:</label>
                <input type="text" id="fullname" name="fullname" maxlength="100" required
                    value="<?= htmlspecialchars($student['fullname']) ?>" />
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" maxlength="150" required
                    value="<?= htmlspecialchars($student['email']) ?>" />
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="M" <?= $student['gender'] == 'M' ? 'selected' : '' ?>>Male</option>
                    <option value="F" <?= $student['gender'] == 'F' ? 'selected' : '' ?>>Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="course">Course:</label>
                <select id="course" name="course" required>
                    <option value="BSIT" <?= $student['course'] == 'BSIT' ? 'selected' : '' ?>>BSIT</option>
                    <option value="BSMATH" <?= $student['course'] == 'BSMATH' ? 'selected' : '' ?>>BSMATH</option>
                </select>
            </div>

            <div>
                <button type="submit" class="btn-save">Save Changes</button>
                <a href="index.php" class="btn-cancel">Cancel</a>
            </div>

        </form>
    </div>

</body>

</html>