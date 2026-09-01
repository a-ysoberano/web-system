<?php
$fullname = $_GET['fullname'];
$phone = $_GET['phone'];
$email = $_GET['email'];
$address = $_GET['address'];
$parentsname = $_GET['parentsname'];
$parentscontact = $_GET['parentscontact'];

$cert_name = $_GET['certName'];
$cert_institute = $_GET['certInstitute'];
$cert_year = $_GET['certYear'];

$languages = $_GET['languages'];

$objective = $_GET['obj'];
$technical_skills = $_GET['techSkill'];
$soft_skills = $_GET['softSkill'];

$exp_title = $_GET['exp_title'];
$exp_company = $_GET['exp_company'];
$exp_duration = $_GET['exp_duration'];
$exp_responsibilities = $_GET['exp_responsibilities'];

$program = $_GET['program'];
$school = $_GET['school'];
$year = $_GET['year'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Resume</title>
    <style>
        body {
            margin: 0;
            padding: 30px;
            background-color: #DDE8D5;
            font-family: Arial, Helvetica, sans-serif;
        }

        .resume-container {
            max-width: 1000px;
            margin: auto;
            background-color: #FFFFFF;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .header {
            background-color: #3F5B45;
            padding: 45px;
            text-align: center;
        }

        .header h1 {
            color: #FFFFFF;
            margin: 0;
            font-size: 38px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .flex-container {
            display: flex;
        }

        .sidebar {
            width: 270px;
            background-color: #E8EFE4;
            padding: 30px;
            box-sizing: border-box;
        }

        .sidebar h2 {
            color: #3F5B45;
            font-size: 20px;
            border-bottom: 2px solid #3F5B45;
            padding-bottom: 8px;
            margin-top: 0;
        }

        .sidebar h2.margin-top {
            margin-top: 40px;
        }

        .sidebar p {
            color: #29332B;
        }

        .sidebar ul {
            color: #29332B;
            padding-left: 20px;
        }

        .main-content {
            flex: 1;
            padding: 35px 45px;
            box-sizing: border-box;
        }

        .main-content h2 {
            color: #3F5B45;
            font-size: 22px;
            border-bottom: 2px solid #3F5B45;
            padding-bottom: 8px;
        }

        .main-content h2.margin-top {
            margin-top: 35px;
        }

        .main-content p {
            font-size: 16px;
            color: #29332B;
            line-height: 1.6;
        }

        .main-content ul {
            font-size: 16px;
            color: #29332B;
            line-height: 1.8;
            padding-left: 20px;
        }

        .main-content .exp-title {
            font-size: 16px;
            color: #29332B;
        }

        .main-content .exp-title strong {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="resume-container">

        <div class="header">
            <h1><?php echo $fullname; ?></h1>
        </div>

        <div class="flex-container">

            <div class="sidebar">
                <h2>CONTACT</h2>
                <p><strong>Phone:</strong><br><?php echo $phone; ?></p>
                <p><strong>Email:</strong><br><?php echo $email; ?></p>
                <p><strong>Address:</strong><br><?php echo $address; ?></p>
                <p><strong>Parents:</strong><br><?php echo $parentsname; ?></p>
                <p><strong>Parents Contact:</strong><br><?php echo $parentscontact; ?></p>

                <h2 class="margin-top">CERTIFICATIONS</h2>
                <p>
                    <strong><?php echo $cert_name; ?></strong><br>
                    <?php echo $cert_institute; ?><?php if ($cert_year != "") {
                                                        echo ", " . $cert_year;
                                                    } ?>
                </p>

                <h2 class="margin-top">LANGUAGES</h2>
                <ul>
                    <?php
                    $lang_display = str_replace(',', ', ', $languages);
                    echo "<li>" . $lang_display . "</li>";
                    ?>
                </ul>

            </div>

            <div class="main-content">
                <h2>CAREER OBJECTIVE</h2>
                <p><?php echo nl2br($objective); ?></p>

                <h2 class="margin-top">KEY SKILLS</h2>
                <ul>
                    <li><strong>Technical:</strong> <?php echo $technical_skills; ?></li>
                    <li><strong>Soft Skills:</strong> <?php echo $soft_skills; ?></li>
                </ul>

                <?php if ($exp_title != "") { ?>
                    <h2 class="margin-top">EXPERIENCE</h2>
                    <p class="exp-title">
                        <strong><?php echo $exp_title; ?></strong>
                        <?php
                        if ($exp_company != "") {
                            echo " - " . $exp_company;
                        }
                        if ($exp_duration != "") {
                            echo " | " . $exp_duration;
                        }
                        ?>
                    </p>
                    <ul>
                        <li><?php echo $exp_responsibilities; ?></li>
                    </ul>
                <?php } ?>

                <h2 class="margin-top">EDUCATION</h2>
                <ul>
                    <li>
                        <strong><?php echo $program; ?></strong><br>
                        <?php echo $school; ?><br>
                        <?php echo $year; ?>
                    </li>
                </ul>

            </div>

        </div>

    </div>
</body>

</html>