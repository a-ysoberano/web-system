<?php
require 'config/config.php';
/** @var mysqli $mysqli */

$courses_query = mysqli_query($mysqli, "SELECT * FROM course WHERE status = 'on'");
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Add User</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="form-container">
    <h1>Register User</h1>
    <form action="add.php" method="post">
      <div class="form-group">
        <label>First Name</label>
        <input type="text" name="firstname" required />
      </div>
      <div class="form-group">
        <label>Last Name</label>
        <input type="text" name="lastname" required />
      </div>
      <div class="form-group">
        <label>Middle Name</label>
        <input type="text" name="middlename" />
      </div>
      <div class="form-group">
        <label>Birthdate</label>
        <input type="date" name="birthdate" required />
      </div>
      <div class="form-group">
        <label>Gender</label>
        <select name="gender" required>
          <option value="">-- Select --</option>
          <option value="M">Male</option>
          <option value="F">Female</option>
        </select>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" required />
      </div>

      <div class="form-group">
        <label>Course</label>
        <select name="course_id" required>
          <option value="">-- Select Course --</option>
          <?php while ($row = mysqli_fetch_assoc($courses_query)): ?>
            <option value="<?= $row['course_ID'] ?>">
              <?= htmlspecialchars($row['course_code']) ?> - <?= htmlspecialchars($row['name']) ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <div
        style="
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
          ">
        <a href="index.php" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</body>

</html>