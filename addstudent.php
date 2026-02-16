<?php

session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}


$host = 'localhost';
$db   = 'student_db';
$user = 'root';
$pass = ''; 

$message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $sql = "INSERT INTO students (first_name, last_name, phone_number, id_number, course, department, birthday, age) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['Phone_Number'], 
            $_POST['ID_Number'],    
            $_POST['Course'],       
            $_POST['Department'],   
            $_POST['Birthday'],     
            $_POST['Age']           
        ]);

        $message = "<script>alert('Student added successfully!');</script>";
    } catch (PDOException $e) {
        $message = "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webprogramming</title>
    <?php echo $message; ?>
    <style>
        
        :root {
            --color-background: #ffffff; 
            --color-foreground: #f8f9fa; 
            --color-text: #333333;       
            --color-primary: #007bff;    
            --color-primary-hover: #0056b3;
            --color-border-subtle: #e9ecef;
            --main-bg: #2c3e50;
            --main-heading-color: #ffffff;
            --main-text-color: #ecf0f1;
            --bottom-bg: #233140;
            --bottom-text-color: #bdc3c7;
            --bottom-link-hover: #ffffff;
            --form-button-bg: #3498db;
            --form-button-text: #ffffff;
            --font-family-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            --font-weight-normal: 400;
            --font-weight-bold: 700;
            --navbar-height: 70px;
            --navbar-padding: 1rem;
            --container-width: 1140px;
            --transition-speed: 0.2s;
        }

        *, *::before, *::after { box-sizing: border-box; }
        
        .registration-container { max-width: 700px; margin: 30px auto; font-family: sans-serif; }
        .registration-form fieldset { border: 1px solid #ddd; border-radius: 6px; padding: 20px; margin-bottom: 25px; }
        .registration-form legend { font-size: 1.2rem; font-weight: 600; padding: 0 10px; }
        .form-row { display: flex; gap: 20px; margin-bottom: 15px; }
        .form-group { flex: 1; }
        .form-group:only-child { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 500; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 1rem; box-sizing: border-box; }
        
        body {
            margin: 0;
            font-family: var(--font-family-sans-serif);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-image: url("https://images.template.net/435560/Education-Background-Template-edit-online.png");
            background-size: cover;        
            background-position: center;   
            background-repeat: no-repeat;  
            background-attachment: fixed; 
        }
        
        main { flex-grow: 1; }
        .container { width: 90%; max-width: 1140px; margin: 0 auto; }
        ul { list-style: none; margin: 0; padding: 0; }
        a { text-decoration: none; color: var(--color-text); }

        .navbar {
            background-color: #ffffff; 
            height: var(--navbar-height);
            display: flex;
            align-items: center;
            border-bottom: 1px solid var(--color-border-subtle);
        }

        .navbar__container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: var(--container-width);
            margin: 0 auto;
            padding: 0 var(--navbar-padding);
        }
        
        .navbar__brand { font-size: 1.5rem; font-weight: var(--font-weight-bold); }
        .navbar__toggle { display: block; background: transparent; border: none; cursor: pointer; }
        .navbar__toggle .bar { display: block; width: 25px; height: 3px; margin: 5px auto; background-color: var(--color-text); transition: 0.2s; }

        .navbar__menu {
            display: none; 
            flex-direction: column;
            width: 100%;
            position: absolute;
            top: var(--navbar-height);
            left: 0;
            background-color: #fff;
            z-index: 1000;
        }
        
        .navbar__menu.is-active { display: flex; }
        .navbar__link { display: block; padding: 1.5rem; }
        .navbar__link--cta { color: var(--color-primary); font-weight: bold; }

        @media (min-width: 768px) {
            .navbar__toggle { display: none; }
            .navbar__menu { display: flex; position: static; width: auto; flex-direction: row; }
            .navbar__list { display: flex; }
            .navbar__link { padding: 0.5rem 1rem; }
        }

        .content { text-align: center; padding: 2rem 0; color: #13120b; }
        .submit-btn { width: 100%; padding: 15px; background: #28a745; color: white; border: none; border-radius: 5px; font-size: 1.2rem; font-weight: bold; cursor: pointer; }
        .footer-newsletter__bottom { background-color: var(--bottom-bg); color: var(--bottom-text-color); padding: 1.5rem 0; font-size: 0.875rem; }
    </style>
</head>
<body>

    <header class="navbar">
        <div class="navbar__container">
            <a href="#" class="navbar__brand">ABC School</a>
            <button class="navbar__toggle" id="navbarToggle"><span class="bar"></span><span class="bar"></span><span class="bar"></span></button>
            <nav id="navbarMenu" class="navbar__menu">
                <ul class="navbar__list">
                    <li class="navbar__item"><a href="add_student.php" class="navbar__link">Add students</a></li>
                    <li class="navbar__item"><a href="update_student.php" class="navbar__link">Update students</a></li>
                    <li class="navbar__item"><a href="view_students.php" class="navbar__link">View students</a></li>
                    <li class="navbar__item"><a href="logout.php" class="navbar__link--cta">Sign out</a></li>
                </ul>
            </nav>
        </div>    
    </header>
    
    <main class="content">
        <h1>Add Student</h1>
        <div class="registration-container">
            <h2 style="text-align: center;">Student DATA</h2>
            <form id="checkoutForm" action="add_student.php" method="post">
                <fieldset>
                    <legend>Information</legend>
                    <div class="form-group"><label>First Name</label><input type="text" name="first_name" required></div>
                    <div class="form-group"><label>Last Name</label><input type="text" name="last_name" required></div>
                    <div class="form-group"><label>Phone Number</label><input type="text" name="Phone_Number" required></div>
                    <div class="form-group"><label>ID Number</label><input type="text" name="ID_Number" required></div>
                    <div class="form-group"><label>Course</label><input type="text" id="Course" name="Course" required></div>
                    <div class="form-group"><label>Confirm Course</label><input type="text" id="ConfirmCourse" required></div>
                    <div class="form-group"><label>Department</label><input type="text" name="Department" required></div>   
                    <div class="form-row">
                        <div class="form-group"><label>Birthday (MM/YY/DD)</label><input type="text" name="Birthday" placeholder="MM/YY/DD" required></div>
                        <div class="form-group"><label>Age</label><input type="text" name="Age" required></div>
                    </div>
                </fieldset>
                <button type="submit" class="submit-btn">Add Student</button>
            </form>
        </div>
    </main>

    <footer class="footer-newsletter">
        <div class="footer-newsletter__bottom">
            <div class="container">
                <p>&copy; 2026 Webprogramming Subject All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Navbar Toggle Script
        document.getElementById('navbarToggle').addEventListener('click', function () {
            this.classList.toggle('is-active');
            document.getElementById('navbarMenu').classList.toggle('is-active');
        });

        // Validation Script
        document.getElementById("checkoutForm").addEventListener("submit", function (e) {
            const course = document.getElementById("Course").value;
            const confirmCourse = document.getElementById("ConfirmCourse").value;

            if (course !== confirmCourse) {
                e.preventDefault(); 
                alert("Courses do not match!");
            }
        });
    </script>
</body>
</html>