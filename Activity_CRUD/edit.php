<?php
require 'config/config.php';
/** @var mysqli $mysqli */

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = (int)$_GET['id'];

// 1. Get the user's current data
$user_result = mysqli_query($mysqli, "SELECT * FROM user WHERE user_ID = $id");
$user = mysqli_fetch_assoc($user_result);

if (!$user) {
    die("User not found.");
}

// 2. Get the user's current course (assuming 1 course per user based on our simple dropdown)
$uc_result = mysqli_query($mysqli, "SELECT course_ID FROM user_course WHERE user_ID = $id");
$uc = mysqli_fetch_assoc($uc_result);
$current_course_id = $uc ? $uc['course_ID'] : 0;

// 3. Get all available courses
$courses_query = mysqli_query($mysqli, "SELECT * FROM course WHERE status = 'on'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="form-container">
        <h1>Edit User</h1>

        <form action="update.php" method="post">
            <input type="hidden" name="user_id" value="<?= $id ?>">

            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="firstname" value="<?= htmlspecialchars($user['Firstname']) ?>" required>
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastname" value="<?= htmlspecialchars($user['Lastname']) ?>" required>
            </div>
            <div class="form-group">
                <label>Middle Name</label>
                <input type="text" name="middlename" value="<?= htmlspecialchars($user['Middlename']) ?>">
            </div>
            <div class="form-group">
                <label>Birthdate</label>
                <input type="date" name="birthdate" value="<?= htmlspecialchars($user['Birthdate']) ?>" required>
            </div>
            <div class="form-group">
                <label>Gender</label>
                <select name="gender" required>
                    <option value="M" <?= $user['Gender'] == 'M' ? 'selected' : '' ?>>Male</option>
                    <option value="F" <?= $user['Gender'] == 'F' ? 'selected' : '' ?>>Female</option>
                </select>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['Email']) ?>" required>
            </div>

            <div class="form-group">
                <label>Course</label>
                <select name="course_id" required>
                    <option value="">-- Select Course --</option>
                    <?php while ($row = mysqli_fetch_assoc($courses_query)): ?>
                        <option value="<?= $row['course_ID'] ?>" <?= $current_course_id == $row['course_ID'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($row['course_code']) ?> - <?= htmlspecialchars($row['name']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
                <a href="index.php" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary" style="background:#f59e0b;">Save Changes</button>
            </div>
        </form>
    </div>

</body>

</html>