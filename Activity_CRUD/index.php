<?php
require 'config/config.php';
/** @var mysqli $mysqli */

$search = $_GET['search'] ?? '';
$filter_gender = $_GET['gender'] ?? '';
$filter_date = $_GET['date_created'] ?? '';

$sql = "SELECT 
            u.user_ID, u.Firstname, u.Lastname, u.Middlename, u.Birthdate, u.Gender, u.Email, u.date_created,
            GROUP_CONCAT(CONCAT(c.course_code, ' (', c.name, ')') SEPARATOR '<br>') as courses
        FROM user u
        LEFT JOIN user_course uc ON u.user_ID = uc.user_ID
        LEFT JOIN course c ON uc.course_ID = c.course_ID
        WHERE 1=1";

if ($search !== '') {
    $s = mysqli_real_escape_string($mysqli, $search);
    $sql .= " AND (u.Firstname LIKE '%$s%' OR u.Lastname LIKE '%$s%' OR u.Middlename LIKE '%$s%' OR c.description LIKE '%$s%' OR c.course_code LIKE '%$s%')";
}

if ($filter_gender !== '') {
    $g = mysqli_real_escape_string($mysqli, $filter_gender);
    $sql .= " AND u.Gender = '$g'";
}

if ($filter_date !== '') {
    $d = mysqli_real_escape_string($mysqli, $filter_date);
    $sql .= " AND u.date_created = '$d'";
}

$sql .= " GROUP BY u.user_ID ORDER BY u.user_ID DESC";
$result = mysqli_query($mysqli, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="dashboard-container">
        <h1>User Details & Courses</h1>
        <div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
            <a href="form.php" class="btn btn-primary">+ Add New User</a>
            <a href="course_list.php" class="btn btn-secondary">Manage Courses</a>
        </div>

        <div class="filter-box">
            <form action="index.php" method="get">
                <input type="text" name="search" placeholder="Search name, code, desc..." value="<?= htmlspecialchars($search) ?>">

                <select name="gender">
                    <option value="">Gender</option>
                    <option value="M" <?= $filter_gender == 'M' ? 'selected' : '' ?>>Male</option>
                    <option value="F" <?= $filter_gender == 'F' ? 'selected' : '' ?>>Female</option>
                </select>

                <input type="date" name="date_created" value="<?= htmlspecialchars($filter_date) ?>">

                <button type="submit" class="btn btn-primary">Search</button>
                <a href="index.php" class="btn btn-secondary">Clear</a>
            </form>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Birthdate</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Courses</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td>
                                    <strong><?= htmlspecialchars($row['Lastname'] . ', ' . $row['Firstname']) ?></strong><br>
                                    <small><?= htmlspecialchars($row['Middlename']) ?></small>
                                </td>
                                <td><?= htmlspecialchars($row['Birthdate']) ?></td>
                                <td><?= $row['Gender'] == 'M' ? 'Male' : 'Female' ?></td>
                                <td><?= htmlspecialchars($row['Email']) ?></td>
                                <td><?= $row['courses'] ? $row['courses'] : '<em>None</em>' ?></td>
                                <td><?= htmlspecialchars($row['date_created']) ?></td>
                                <td style="white-space: nowrap;">
                                    <a href="edit.php?id=<?= $row['user_ID'] ?>" class="action-btn action-edit">Edit</a>
                                    <a href="delete.php?id=<?= $row['user_ID'] ?>" class="action-btn action-delete" onclick="return confirm('Delete this user?');">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align: center;">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>