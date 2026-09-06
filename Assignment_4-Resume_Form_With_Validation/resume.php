<?php

session_start();

$errors = [];

function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}

function isRequired($field, $fieldName)
{
    if (empty(trim($field))) {
        return "$fieldName is required";
    }
    return null;
}

function validateEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format";
    }
    return null;
}

function validatePhone($phone)
{
    $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
    if (strlen($cleanPhone) >= 10 && strlen($cleanPhone) <= 13) {
        return null;
    }
    return "Invalid phone number";
}

$fullname = isset($_GET['fullname']) ? sanitizeInput($_GET['fullname']) : '';
$email = isset($_GET['email']) ? sanitizeInput($_GET['email']) : '';
$address = isset($_GET['address']) ? sanitizeInput($_GET['address']) : '';
$phone = isset($_GET['phone']) ? sanitizeInput($_GET['phone']) : '';
$parentsname = isset($_GET['parentsname']) ? sanitizeInput($_GET['parentsname']) : '';
$parentscontact = isset($_GET['parentscontact']) ? sanitizeInput($_GET['parentscontact']) : '';
$objective = isset($_GET['obj']) ? sanitizeInput($_GET['obj']) : '';
$technical_skills = isset($_GET['techSkill']) ? sanitizeInput($_GET['techSkill']) : '';
$soft_skills = isset($_GET['softSkill']) ? sanitizeInput($_GET['softSkill']) : '';
$program = isset($_GET['program']) ? sanitizeInput($_GET['program']) : '';
$school = isset($_GET['school']) ? sanitizeInput($_GET['school']) : '';
$year = isset($_GET['year']) ? sanitizeInput($_GET['year']) : '';
$cert_name = isset($_GET['certName']) ? sanitizeInput($_GET['certName']) : '';
$cert_institute = isset($_GET['certInstitute']) ? sanitizeInput($_GET['certInstitute']) : '';
$cert_year = isset($_GET['certYear']) ? sanitizeInput($_GET['certYear']) : '';
$languages = isset($_GET['languages']) ? sanitizeInput($_GET['languages']) : '';
$exp_title = isset($_GET['exp_title']) ? sanitizeInput($_GET['exp_title']) : '';
$exp_company = isset($_GET['exp_company']) ? sanitizeInput($_GET['exp_company']) : '';
$exp_duration = isset($_GET['exp_duration']) ? sanitizeInput($_GET['exp_duration']) : '';
$exp_responsibilities = isset($_GET['exp_responsibilities']) ? sanitizeInput($_GET['exp_responsibilities']) : '';

$error = isRequired($fullname, 'Full Name');
if ($error) {
    $errors['fullname'] = $error;
} elseif (strlen($fullname) < 2) {
    $errors['fullname'] = "Full Name must be at least 2 characters";
} elseif (strlen($fullname) > 100) {
    $errors['fullname'] = "Full Name must not exceed 100 characters";
} elseif (!preg_match("/^[a-zA-Z\s\.\-'ñÑáéíóúÁÉÍÓÚ]+$/", $fullname)) {
    $errors['fullname'] = "Name should only contain letters, spaces, dots, dashes, and apostrophes";
}

$error = isRequired($email, 'Email');
if ($error) {
    $errors['email'] = $error;
} else {
    $error = validateEmail($email);
    if ($error) {
        $errors['email'] = $error;
    }
}

$error = isRequired($address, 'Address');
if ($error) {
    $errors['address'] = $error;
} elseif (strlen($address) < 5) {
    $errors['address'] = "Address must be at least 5 characters";
}

$error = isRequired($phone, 'Phone Number');
if ($error) {
    $errors['phone'] = $error;
} else {
    $error = validatePhone($phone);
    if ($error) {
        $errors['phone'] = $error;
    }
}

$error = isRequired($parentsname, "Parent's Name");
if ($error) {
    $errors['parentsname'] = $error;
} elseif (!preg_match("/^[a-zA-Z\s\.\-'ñÑáéíóúÁÉÍÓÚ]+$/", $parentsname)) {
    $errors['parentsname'] = "Parent's Name should only contain letters, spaces, dots, dashes, and apostrophes";
}

$error = isRequired($parentscontact, "Parent's Contact");
if ($error) {
    $errors['parentscontact'] = $error;
} else {
    $error = validatePhone($parentscontact);
    if ($error) {
        $errors['parentscontact'] = "Invalid parent's contact number";
    }
}

$error = isRequired($objective, 'Career Objective');
if ($error) {
    $errors['obj'] = $error;
} elseif (strlen($objective) < 20) {
    $errors['obj'] = "Career Objective must be at least 20 characters";
} elseif (strlen($objective) > 500) {
    $errors['obj'] = "Career Objective must not exceed 500 characters";
}

$error = isRequired($technical_skills, 'Technical Skills');
if ($error) {
    $errors['techSkill'] = $error;
} elseif (strlen($technical_skills) < 3) {
    $errors['techSkill'] = "Technical Skills must be at least 3 characters";
}

$error = isRequired($soft_skills, 'Soft Skills');
if ($error) {
    $errors['softSkill'] = $error;
} elseif (strlen($soft_skills) < 3) {
    $errors['softSkill'] = "Soft Skills must be at least 3 characters";
}

$error = isRequired($cert_name, 'Certification Name');
if ($error) {
    $errors['certName'] = $error;
} elseif (strlen($cert_name) < 2) {
    $errors['certName'] = "Certification Name must be at least 2 characters";
}

$error = isRequired($cert_institute, 'Organization');
if ($error) {
    $errors['certInstitute'] = $error;
} elseif (strlen($cert_institute) < 2) {
    $errors['certInstitute'] = "Organization must be at least 2 characters";
}

$error = isRequired($cert_year, 'Certification Year');
if ($error) {
    $errors['certYear'] = $error;
} elseif (!preg_match('/^[0-9]{4}$/', $cert_year)) {
    $errors['certYear'] = "Certification Year must be a valid year (YYYY)";
}

$error = isRequired($languages, 'Languages');
if ($error) {
    $errors['languages'] = $error;
} elseif (strlen($languages) < 2) {
    $errors['languages'] = "Languages must be at least 2 characters";
}

$error = isRequired($exp_title, 'Job Title');
if ($error) {
    $errors['exp_title'] = $error;
}

$error = isRequired($exp_company, 'Company Name');
if ($error) {
    $errors['exp_company'] = $error;
}

$error = isRequired($exp_duration, 'Duration');
if ($error) {
    $errors['exp_duration'] = $error;
}

$error = isRequired($exp_responsibilities, 'Responsibilities');
if ($error) {
    $errors['exp_responsibilities'] = $error;
} elseif (strlen($exp_responsibilities) < 3) {
    $errors['exp_responsibilities'] = "Responsibilities must be at least 3 characters";
}

$error = isRequired($program, 'Program');
if ($error) {
    $errors['program'] = $error;
}

$error = isRequired($school, 'School');
if ($error) {
    $errors['school'] = $error;
}

$error = isRequired($year, 'Year');
if ($error) {
    $errors['year'] = $error;
} elseif (!preg_match('/^[0-9]{4}(\s*-\s*[0-9]{4})?$/', $year)) {
    $errors['year'] = "Year must be in format: YYYY or YYYY - YYYY";
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old_input'] = $_GET;
    header('Location: form.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your Resume</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #ebf4ff;
            padding: 40px 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .resume-container {
            max-width: 1000px;
            width: 100%;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(26, 54, 93, 0.08), 0 8px 24px rgba(26, 54, 93, 0.04);
            overflow: hidden;
        }

        .toolbar {
            background: #f7fafc;
            padding: 16px 30px;
            display: flex;
            justify-content: flex-end;
            border-bottom: 1px solid #e2e8f0;
        }

        .btn-print {
            padding: 10px 24px;
            background: #1a365d;
            color: white;
            border: none;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-print:hover {
            background: #2b6cb0;
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(43, 108, 176, 0.25);
        }

        .btn-print i {
            font-size: 16px;
        }

        .header {
            background: linear-gradient(135deg, #1a365d 0%, #2b6cb0 100%);
            padding: 50px 60px;
            text-align: center;
            position: relative;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4299e1, #63b3ed, #4299e1);
            background-size: 200% 100%;
            animation: gradientMove 3s ease infinite;
        }

        @keyframes gradientMove {
            0% {
                background-position: 0% 0%;
            }

            50% {
                background-position: 100% 0%;
            }

            100% {
                background-position: 0% 0%;
            }
        }

        .header h1 {
            color: #ffffff;
            font-size: 38px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            position: relative;
        }

        .header h1::after {
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background: #63b3ed;
            margin: 12px auto 0;
            border-radius: 2px;
        }

        .flex-container {
            display: flex;
            min-height: 500px;
        }

        .sidebar {
            width: 280px;
            background: #f7fafc;
            padding: 35px 30px;
            flex-shrink: 0;
            border-right: 1px solid #e2e8f0;
        }

        .sidebar .section {
            margin-bottom: 28px;
        }

        .sidebar .section:last-child {
            margin-bottom: 0;
        }

        .sidebar .section-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #4a6b8a;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 8px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sidebar .section-title i {
            color: #3182ce;
            font-size: 13px;
        }

        .sidebar p {
            font-size: 13px;
            color: #1a2e3e;
            line-height: 1.6;
            margin-bottom: 6px;
            padding: 4px 8px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .sidebar p:hover {
            background: #ebf4ff;
        }

        .sidebar p strong {
            font-weight: 600;
            color: #1a2e3e;
            display: block;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #4a6b8a;
            margin-bottom: 2px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            font-size: 13px;
            color: #1a2e3e;
            padding: 4px 0;
            padding-left: 16px;
            position: relative;
            transition: all 0.2s ease;
            border-radius: 4px;
            padding: 4px 8px 4px 24px;
        }

        .sidebar ul li:hover {
            background: #ebf4ff;
        }

        .sidebar ul li::before {
            content: '▸';
            position: absolute;
            left: 8px;
            color: #3182ce;
            font-weight: 700;
        }

        .main-content {
            flex: 1;
            padding: 40px 50px;
            background: #ffffff;
        }

        .main-content .section {
            margin-bottom: 28px;
        }

        .main-content .section:last-child {
            margin-bottom: 0;
        }

        .main-content .section-title {
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #1a2e3e;
            border-bottom: 3px solid #3182ce;
            padding-bottom: 8px;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .main-content .section-title::before {
            content: '';
            width: 4px;
            height: 20px;
            background: #3182ce;
            border-radius: 2px;
            display: inline-block;
        }

        .main-content .section-title i {
            color: #3182ce;
            font-size: 16px;
        }

        .main-content p {
            font-size: 14px;
            color: #2d4a5a;
            line-height: 1.7;
        }

        .main-content ul {
            list-style: none;
            padding: 0;
        }

        .main-content ul li {
            font-size: 14px;
            color: #2d4a5a;
            padding: 4px 0;
            padding-left: 20px;
            position: relative;
            line-height: 1.6;
        }

        .main-content ul li::before {
            content: '•';
            position: absolute;
            left: 0;
            color: #3182ce;
            font-weight: 700;
        }

        .main-content .exp-title {
            font-size: 15px;
            font-weight: 700;
            color: #1a2e3e;
            margin-bottom: 4px;
        }

        .main-content .exp-sub {
            font-size: 13px;
            color: #4a6b8a;
            margin-bottom: 8px;
        }

        .main-content .exp-sub strong {
            color: #1a2e3e;
        }

        .skill-tag {
            display: inline;
            font-size: 14px;
            color: #2d4a5a;
        }

        .skill-tag::after {
            content: ', ';
        }

        .skill-tag:last-child::after {
            content: '';
        }

        .skill-section {
            margin-bottom: 6px;
        }

        .skill-label {
            font-weight: 600;
            color: #1a2e3e;
        }

        @media print {
            .toolbar {
                display: none !important;
            }

            .flex-container {
                flex-direction: row !important;
            }

            .sidebar {
                width: 280px !important;
                border-right: 1px solid #e2e8f0 !important;
                border-bottom: none !important;
            }

            body {
                padding: 0;
                background: white;
            }

            .resume-container {
                box-shadow: none;
                border-radius: 0;
            }
        }

        @media (max-width: 768px) {
            .flex-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #e2e8f0;
            }

            .header {
                padding: 35px 30px;
            }

            .header h1 {
                font-size: 28px;
            }

            .main-content {
                padding: 30px 25px;
            }

            .sidebar {
                padding: 25px;
            }

            .header h1::after {
                width: 60px;
            }
        }
    </style>
</head>

<body>
    <div class="resume-container">

        <div class="toolbar">
            <button class="btn-print" onclick="window.print()">
                <i class="fas fa-print"></i> Print Resume
            </button>
        </div>

        <div class="header">
            <h1><?php echo htmlspecialchars($fullname); ?></h1>
        </div>

        <div class="flex-container">

            <div class="sidebar">
                <div class="section">
                    <div class="section-title"><i class="fas fa-address-card"></i> Contact</div>
                    <p><strong>Phone</strong><?php echo htmlspecialchars($phone); ?></p>
                    <p><strong>Email</strong><?php echo htmlspecialchars($email); ?></p>
                    <p><strong>Address</strong><?php echo htmlspecialchars($address); ?></p>
                </div>

                <div class="section">
                    <div class="section-title"><i class="fas fa-users"></i> Parents</div>
                    <p><strong>Name</strong><?php echo htmlspecialchars($parentsname); ?></p>
                    <p><strong>Contact</strong><?php echo htmlspecialchars($parentscontact); ?></p>
                </div>

                <div class="section">
                    <div class="section-title"><i class="fas fa-certificate"></i> Certifications</div>
                    <p>
                        <strong><?php echo htmlspecialchars($cert_name); ?></strong>
                        <?php echo htmlspecialchars($cert_institute); ?>, <?php echo htmlspecialchars($cert_year); ?>
                    </p>
                </div>

                <div class="section">
                    <div class="section-title"><i class="fas fa-language"></i> Languages</div>
                    <ul>
                        <?php
                        $language_array = array_map('trim', explode(',', $languages));
                        foreach ($language_array as $lang): ?>
                            <li><?php echo htmlspecialchars($lang); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="main-content">
                <div class="section">
                    <div class="section-title"><i class="fas fa-bullseye"></i> Career Objective</div>
                    <p><?php echo nl2br(htmlspecialchars($objective)); ?></p>
                </div>

                <div class="section">
                    <div class="section-title"><i class="fas fa-code"></i> Key Skills</div>
                    <div class="skill-section">
                        <span class="skill-label">Technical:</span>
                        <?php
                        $tech_skills = array_map('trim', explode(',', $technical_skills));
                        foreach ($tech_skills as $skill): ?>
                            <span class="skill-tag"><?php echo htmlspecialchars($skill); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="skill-section">
                        <span class="skill-label">Soft Skills:</span>
                        <?php
                        $soft_skills_array = array_map('trim', explode(',', $soft_skills));
                        foreach ($soft_skills_array as $skill): ?>
                            <span class="skill-tag"><?php echo htmlspecialchars($skill); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="section">
                    <div class="section-title"><i class="fas fa-briefcase"></i> Experience</div>
                    <div class="exp-title"><?php echo htmlspecialchars($exp_title); ?></div>
                    <div class="exp-sub">
                        <strong><?php echo htmlspecialchars($exp_company); ?></strong> |
                        <?php echo htmlspecialchars($exp_duration); ?>
                    </div>
                    <ul>
                        <?php
                        $responsibilities = array_map('trim', explode(',', $exp_responsibilities));
                        foreach ($responsibilities as $resp): ?>
                            <li><?php echo htmlspecialchars($resp); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="section">
                    <div class="section-title"><i class="fas fa-graduation-cap"></i> Education</div>
                    <div class="exp-title"><?php echo htmlspecialchars($program); ?></div>
                    <div class="exp-sub">
                        <strong><?php echo htmlspecialchars($school); ?></strong><br>
                        <?php echo htmlspecialchars($year); ?>
                    </div>
                </div>
            </div>

        </div>

    </div>
</body>

</html>