<?php
session_start();

$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$old_input = isset($_SESSION['old_input']) ? $_SESSION['old_input'] : [];

unset($_SESSION['errors']);
unset($_SESSION['old_input']);

function old($field)
{
    global $old_input;
    if (isset($old_input[$field])) {
        return htmlspecialchars($old_input[$field]);
    }
    return '';
}

function error($field)
{
    global $errors;
    if (isset($errors[$field])) {
        return '<span class="error-message">' . htmlspecialchars($errors[$field]) . '</span>';
    }
    return '';
}

function errorClass($field)
{
    global $errors;
    if (isset($errors[$field])) {
        return ' has-error';
    }
    return '';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Generator</title>
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
            min-height: 100vh;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            max-width: 780px;
            width: 100%;
            background: #ffffff;
            border-radius: 20px;
            padding: 50px 60px;
            box-shadow: 0 20px 60px rgba(26, 54, 93, 0.12), 0 8px 24px rgba(26, 54, 93, 0.05);
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #1a365d, #2b6cb0, #1a365d);
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

        .header {
            text-align: center;
            margin-bottom: 35px;
        }

        .header-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #1a365d, #2b6cb0);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            color: white;
            font-size: 28px;
            box-shadow: 0 8px 24px rgba(26, 54, 93, 0.25);
        }

        .header h1 {
            font-size: 30px;
            font-weight: 800;
            color: #1a2e3e;
            letter-spacing: -0.5px;
        }

        .header p {
            color: #4a6b8a;
            font-size: 15px;
            font-weight: 400;
            margin-top: 6px;
        }

        .error-summary {
            background: #fef2f2;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 28px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .error-summary i {
            color: #dc3545;
            font-size: 18px;
            margin-top: 2px;
        }

        .error-summary h4 {
            color: #991b1b;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .error-summary ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .error-summary ul li {
            color: #7f1d1d;
            font-size: 13px;
            padding: 2px 0;
        }

        .error-summary ul li::before {
            content: '• ';
            color: #dc3545;
        }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: #1a2e3e;
            padding-bottom: 10px;
            margin-top: 32px;
            margin-bottom: 20px;
            border-bottom: 2px solid #e8f0f8;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: #2b6cb0;
            font-size: 18px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 24px;
        }

        .form-group {
            margin-bottom: 4px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #1a2e3e;
            margin-bottom: 5px;
        }

        .required {
            color: #dc3545;
            font-weight: 700;
            margin-left: 2px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #dce8f0;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s ease;
            background: #f8fafc;
            color: #1a2e3e;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2b6cb0;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(43, 108, 176, 0.08);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #94a3b8;
            font-size: 13px;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .has-error input,
        .has-error textarea {
            border-color: #dc3545 !important;
            background: #fef2f2 !important;
        }

        .has-error input:focus,
        .has-error textarea:focus {
            box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.08) !important;
        }

        .error-message {
            display: block;
            color: #dc3545;
            font-size: 12px;
            font-weight: 500;
            margin-top: 5px;
        }

        .error-message::before {
            content: '⚠ ';
        }

        small {
            display: block;
            color: #6b8a9a;
            font-size: 12px;
            margin-top: 4px;
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #1a365d, #2b6cb0);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(43, 108, 176, 0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit i {
            font-size: 18px;
        }

        @media (max-width: 640px) {
            .container {
                padding: 30px 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .header h1 {
                font-size: 24px;
            }

            .header-icon {
                width: 52px;
                height: 52px;
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="header">
            <div class="header-icon">
                <i class="fas fa-file-pen"></i>
            </div>
            <h1>Resume Generator</h1>
            <p>Fill in your details to generate a professional resume</p>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="error-summary">
                <i class="fas fa-circle-exclamation"></i>
                <div>
                    <h4>Please fix the following errors:</h4>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <form action="resume.php" method="get">

            <div class="section-title">
                <i class="fas fa-user"></i> Personal Information
            </div>

            <div class="form-row">
                <div class="form-group full-width <?php echo errorClass('fullname'); ?>">
                    <label>Full Name <span class="required">*</span></label>
                    <input type="text" name="fullname" placeholder="Enter your full name" value="<?php echo old('fullname'); ?>">
                    <?php echo error('fullname'); ?>
                </div>

                <div class="form-group <?php echo errorClass('email'); ?>">
                    <label>Email Address <span class="required">*</span></label>
                    <input type="email" name="email" placeholder="you@example.com" value="<?php echo old('email'); ?>">
                    <?php echo error('email'); ?>
                </div>

                <div class="form-group <?php echo errorClass('phone'); ?>">
                    <label>Phone Number <span class="required">*</span></label>
                    <input type="text" name="phone" placeholder="09123456789" value="<?php echo old('phone'); ?>">
                    <small>Format: 09XXXXXXXXX or +639XXXXXXXXX</small>
                    <?php echo error('phone'); ?>
                </div>

                <div class="form-group full-width <?php echo errorClass('address'); ?>">
                    <label>Address <span class="required">*</span></label>
                    <input type="text" name="address" placeholder="Enter your complete address" value="<?php echo old('address'); ?>">
                    <?php echo error('address'); ?>
                </div>

                <div class="form-group <?php echo errorClass('parentsname'); ?>">
                    <label>Parent's Name <span class="required">*</span></label>
                    <input type="text" name="parentsname" placeholder="Parent's full name" value="<?php echo old('parentsname'); ?>">
                    <?php echo error('parentsname'); ?>
                </div>

                <div class="form-group <?php echo errorClass('parentscontact'); ?>">
                    <label>Parent's Contact <span class="required">*</span></label>
                    <input type="text" name="parentscontact" placeholder="09123456789" value="<?php echo old('parentscontact'); ?>">
                    <small>Format: 09XXXXXXXXX or +639XXXXXXXXX</small>
                    <?php echo error('parentscontact'); ?>
                </div>
            </div>

            <div class="section-title">
                <i class="fas fa-bullseye"></i> Career Objective
            </div>

            <div class="form-group <?php echo errorClass('obj'); ?>">
                <label>Objective <span class="required">*</span></label>
                <textarea name="obj" placeholder="Write your career objective..." rows="4"><?php echo old('obj'); ?></textarea>
                <small>Minimum 20 characters</small>
                <?php echo error('obj'); ?>
            </div>

            <div class="section-title">
                <i class="fas fa-code"></i> Skills
            </div>

            <div class="form-row">
                <div class="form-group <?php echo errorClass('techSkill'); ?>">
                    <label>Technical Skills <span class="required">*</span></label>
                    <input type="text" name="techSkill" placeholder="HTML, CSS, PHP, MySQL" value="<?php echo old('techSkill'); ?>">
                    <small>Separate skills with commas</small>
                    <?php echo error('techSkill'); ?>
                </div>

                <div class="form-group <?php echo errorClass('softSkill'); ?>">
                    <label>Soft Skills <span class="required">*</span></label>
                    <input type="text" name="softSkill" placeholder="Communication, Teamwork" value="<?php echo old('softSkill'); ?>">
                    <small>Separate skills with commas</small>
                    <?php echo error('softSkill'); ?>
                </div>
            </div>

            <div class="section-title">
                <i class="fas fa-certificate"></i> Certifications
            </div>

            <div class="form-row">
                <div class="form-group full-width <?php echo errorClass('certName'); ?>">
                    <label>Certification Name <span class="required">*</span></label>
                    <input type="text" name="certName" placeholder="Introduction to Cybersecurity" value="<?php echo old('certName'); ?>">
                    <?php echo error('certName'); ?>
                </div>

                <div class="form-group <?php echo errorClass('certInstitute'); ?>">
                    <label>Organization <span class="required">*</span></label>
                    <input type="text" name="certInstitute" placeholder="Cisco, Microsoft" value="<?php echo old('certInstitute'); ?>">
                    <?php echo error('certInstitute'); ?>
                </div>

                <div class="form-group <?php echo errorClass('certYear'); ?>">
                    <label>Year <span class="required">*</span></label>
                    <input type="text" name="certYear" placeholder="2026" value="<?php echo old('certYear'); ?>">
                    <?php echo error('certYear'); ?>
                </div>
            </div>

            <div class="section-title">
                <i class="fas fa-language"></i> Languages
            </div>

            <div class="form-group <?php echo errorClass('languages'); ?>">
                <label>Languages <span class="required">*</span></label>
                <input type="text" name="languages" placeholder="English, Filipino, Ilocano" value="<?php echo old('languages'); ?>">
                <small>Separate each language with a comma</small>
                <?php echo error('languages'); ?>
            </div>

            <div class="section-title">
                <i class="fas fa-briefcase"></i> Work Experience
            </div>

            <div class="form-row">
                <div class="form-group <?php echo errorClass('exp_title'); ?>">
                    <label>Job Title <span class="required">*</span></label>
                    <input type="text" name="exp_title" placeholder="IT Support Intern" value="<?php echo old('exp_title'); ?>">
                    <?php echo error('exp_title'); ?>
                </div>

                <div class="form-group <?php echo errorClass('exp_company'); ?>">
                    <label>Company <span class="required">*</span></label>
                    <input type="text" name="exp_company" placeholder="ABC Technologies" value="<?php echo old('exp_company'); ?>">
                    <?php echo error('exp_company'); ?>
                </div>

                <div class="form-group <?php echo errorClass('exp_duration'); ?>">
                    <label>Duration <span class="required">*</span></label>
                    <input type="text" name="exp_duration" placeholder="June 2025 - August 2025" value="<?php echo old('exp_duration'); ?>">
                    <?php echo error('exp_duration'); ?>
                </div>

                <div class="form-group full-width <?php echo errorClass('exp_responsibilities'); ?>">
                    <label>Responsibilities <span class="required">*</span></label>
                    <input type="text" name="exp_responsibilities" placeholder="Assisted users, Maintained computers" value="<?php echo old('exp_responsibilities'); ?>">
                    <small>Separate each responsibility with a comma</small>
                    <?php echo error('exp_responsibilities'); ?>
                </div>
            </div>

            <div class="section-title">
                <i class="fas fa-graduation-cap"></i> Education
            </div>

            <div class="form-row">
                <div class="form-group <?php echo errorClass('program'); ?>">
                    <label>Program <span class="required">*</span></label>
                    <input type="text" name="program" placeholder="BS Information Technology" value="<?php echo old('program'); ?>">
                    <?php echo error('program'); ?>
                </div>

                <div class="form-group <?php echo errorClass('school'); ?>">
                    <label>School <span class="required">*</span></label>
                    <input type="text" name="school" placeholder="Pangasinan State University" value="<?php echo old('school'); ?>">
                    <?php echo error('school'); ?>
                </div>

                <div class="form-group full-width <?php echo errorClass('year'); ?>">
                    <label>Year <span class="required">*</span></label>
                    <input type="text" name="year" placeholder="2024 - 2028" value="<?php echo old('year'); ?>">
                    <small>Format: YYYY or YYYY - YYYY</small>
                    <?php echo error('year'); ?>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-file-export"></i> Generate Resume
            </button>

        </form>

    </div>
</body>

</html>