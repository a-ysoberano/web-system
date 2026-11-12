<?php
require 'config/config.php';
/** @var mysqli $mysqli */

if (isset($_GET['toggle'])) {
    $id = (int)$_GET['toggle'];
    $res = mysqli_query($mysqli, "SELECT status FROM course WHERE course_ID = $id");
    if ($row = mysqli_fetch_assoc($res)) {
        $new_status = ($row['status'] == 'on') ? 'off' : 'on';
        mysqli_query($mysqli, "UPDATE course SET status = '$new_status' WHERE course_ID = $id");
    }
    header('Location: course_list.php');
    exit();
}

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($mysqli, "DELETE FROM course WHERE course_ID = $id");
    header('Location: course_list.php');
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $code = mysqli_real_escape_string($mysqli, $_POST['course_code']);
    $name = mysqli_real_escape_string($mysqli, $_POST['name']);
    $desc = mysqli_real_escape_string($mysqli, $_POST['description']);
    $status = $_POST['status'] == 'on' ? 'on' : 'off';

    $check = mysqli_query($mysqli, "SELECT * FROM course WHERE course_code = '$code'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Error: Course code '$code' already exists.";
    } else {
        mysqli_query($mysqli, "INSERT INTO course (course_code, name, description, status) VALUES ('$code', '$name', '$desc', '$status')");
        header('Location: course_list.php');
        exit();
    }
}

$result = mysqli_query($mysqli, "SELECT * FROM course ORDER BY course_ID DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Courses</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="dashboard-container">
        <h1>Manage Courses</h1>

        <div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
            <a href="index.php" class="btn btn-secondary">Back to Users</a>
        </div>

        <div class="filter-box" style="background: #f8fafc; padding: 20px; border-radius: 6px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
            <h3 style="margin-top: 0; margin-bottom: 15px; font-size: 16px;">Add New Course</h3>
            <?php if ($error): ?>
                <p style="color: red; font-weight: bold; margin-top: 0;"><?= $error ?></p>
            <?php endif; ?>

            <form action="course_list.php" method="post" style="display: flex; gap: 10px; align-items: flex-end; flex-wrap: wrap;">
                <div>
                    <label style="display: block; font-size: 12px; margin-bottom: 5px;">Code</label>
                    <input type="text" name="course_code" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; margin-bottom: 5px;">Course Name</label>
                    <input type="text" name="name" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; margin-bottom: 5px;">Description</label>
                    <input type="text" name="description" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; margin-bottom: 5px;">Status</label>
                    <input type="hidden" name="status" value="off">
                    <label style="display: flex; align-items: center; gap: 5px; padding: 8px 0; cursor: pointer;">
                        <input type="checkbox" name="status" value="on" checked> Active
                    </label>
                </div>
                <button type="submit" class="btn btn-primary" style="height: 38px;">Add Course</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Course Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($row['course_code']) ?></strong></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['description']) ?></td>
                            <td>
                                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                    <input type="checkbox"
                                        <?= $row['status'] == 'on' ? 'checked' : '' ?>
                                        onclick="window.location.href='course_list.php?toggle=<?= $row['course_ID'] ?>'"
                                        style="width: 16px; height: 16px; cursor: pointer;">
                                    <span style="color: <?= $row['status'] == 'on' ? '#10b981' : '#ef4444' ?>; font-weight: bold;">
                                        <?= $row['status'] == 'on' ? 'Active' : 'Inactive' ?>
                                    </span>
                                </label>
                            </td>
                            <td style="white-space: nowrap;">
                                <a href="course_list.php?delete=<?= $row['course_ID'] ?>" class="action-btn action-delete" onclick="return confirm('Delete this course? Users enrolled in it will lose their connection.');" style="padding: 5px 10px; font-size: 12px;">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">No courses found. Add one above!</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>

</html>