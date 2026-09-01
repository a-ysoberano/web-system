<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Generator</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #DDE8D5;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #FFFFFF;
            border-radius: 10px;
            padding: 35px 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        h1 {
            color: #3F5B45;
            text-align: center;
            font-size: 28px;
            margin-bottom: 5px;
        }

        h3 {
            color: #3F5B45;
            border-bottom: 2px solid #3F5B45;
            padding-bottom: 6px;
            margin-top: 25px;
        }

        .subtitle {
            text-align: center;
            color: #555555;
            margin-top: 0;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 12px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #B8C9B5;
            border-radius: 5px;
            font-family: Arial, Helvetica, sans-serif;
        }

        textarea {
            resize: vertical;
        }

        small {
            color: #777777;
            display: block;
            margin-top: 4px;
        }

        button {
            width: 100%;
            margin-top: 30px;
            padding: 14px;
            background-color: #3F5B45;
            color: #FFFFFF;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #2F4535;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>Resume Generator</h1>
        <p class="subtitle">Enter your information to generate your resume</p>

        <form action="resume.php" method="get">

            <h3>General Information</h3>

            <label>Full Name</label>
            <input type="text" name="fullname" placeholder="Ex: JD Cruz" required>

            <label>Email</label>
            <input type="email" name="email" placeholder="Ex: jdcruz@gmail.com" required>

            <label>Address</label>
            <input type="text" name="address" placeholder="Ex: Brgy. Sumabnit, Binalonan, Pangasinan" required>

            <label>Phone Number</label>
            <input type="text" name="phone" placeholder="Ex: 0912-345-6789" required>

            <label>Parents Name</label>
            <input type="text" name="parentsname" placeholder="Ex: Pedro Cruz" required>

            <label>Parents Contact Number</label>
            <input type="text" name="parentscontact" placeholder="Ex: 0912-345-6789" required>


            <h3>Career Objective</h3>

            <label>Objective</label>
            <textarea name="obj" placeholder="Ex: Motivated IT student from Pangasinan State University seeking an entry-level position where I can apply my technical and problem-solving skills." rows="4" required></textarea>


            <h3>Key Skills</h3>

            <label>Technical Skill</label>
            <input type="text" name="techSkill" placeholder="Ex: HTML, CSS, PHP, MySQL, Java" required>

            <label>Soft Skill</label>
            <input type="text" name="softSkill" placeholder="Ex: Communication, Teamwork, Problem-Solving" required>


            <h3>Certifications</h3>

            <label>Certification Name</label>
            <input type="text" name="certName" placeholder="Ex: Introduction to Cybersecurity, HTML and CSS">
            <small>Separate multiple certifications with commas</small>

            <label>Organization</label>
            <input type="text" name="certInstitute" placeholder="Ex: Cisco, Microsoft, TESDA">

            <label>Year</label>
            <input type="text" name="certYear" placeholder="Ex: 2026, 2025">


            <h3>Languages</h3>

            <label>Languages</label>
            <input type="text" name="languages" placeholder="Ex: English, Filipino, Ilocano">
            <small>Separate each language with a comma</small>


            <h3>Work Experience</h3>

            <small>Leave blank if you are a fresher.</small>

            <label>Job Title</label>
            <input type="text" name="exp_title" placeholder="Ex: IT Support Intern">

            <label>Company Name</label>
            <input type="text" name="exp_company" placeholder="Ex: ABC Technologies, Dagupan City">

            <label>Duration</label>
            <input type="text" name="exp_duration" placeholder="Ex: June 2025 - August 2025">

            <label>Responsibilities / Achievements</label>
            <input type="text" name="exp_responsibilities" placeholder="Ex: Assisted users, Maintained computers, Troubleshot network issues">
            <small>Separate each responsibility with a comma</small>


            <h3>Education</h3>

            <label>Program</label>
            <input type="text" name="program" placeholder="Ex: BS Information Technology" required>

            <label>School</label>
            <input type="text" name="school" placeholder="Ex: Pangasinan State University - Urdaneta City Campus" required>

            <label>Year</label>
            <input type="text" name="year" placeholder="Ex: 2024 - 2028" required>

            <button type="submit">Generate Resume</button>

        </form>

    </div>

</body>

</html>