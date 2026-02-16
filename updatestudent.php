<?php

$host = 'localhost';
$db   = 'student_db';
$user = 'root';
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $message = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $sql = "UPDATE students SET 
                subject = :subject, 
                grade = :grade, 
                course = :course, 
                department = :dept 
                WHERE id_number = :id"; 
        
        $stmt = $pdo->prepare($sql);
      
        $stmt->execute([
            ':subject' => $_POST['ChangeSubject'],
            ':grade'   => $_POST['ChangeGrade'],
            ':course'  => $_POST['ChangeCourse'],
            ':dept'    => $_POST['ChangeDepartment'],
            ':id'      => '123456' 
        ]);
        $message = "Student updated successfully!";
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webprogramming - Update Students</title>
    <style>
       
        :root {
            --color-background: #ffffff; 
            --color-foreground: #f8f9fa; 
            --color-text: #333333;       
            --color-primary: #007bff;    
            --color-primary-hover: #0056b3;
            --color-border-subtle: #e9ecef;
            --main-bg: #2c3e50;
            --bottom-bg: #233140;
            --bottom-text-color: #bdc3c7;
            --form-button-bg: #3498db;
            --form-button-text: #ffffff;
            --font-family-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            --navbar-height: 70px;
            --transition-speed: 0.2s;
        }

        *, *::before, *::after { box-sizing: border-box; }
        
        body {
            margin: 0;
            font-family: var(--font-family-sans-serif);
            background-image: url("https://images.template.net/435560/Education-Background-Template-edit-online.png");
            background-size: cover;        
            background-attachment: fixed; 
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

      
        .registration-container { max-width: 700px; margin: 30px auto; background: rgba(255,255,255,0.9); padding: 20px; border-radius: 8px; }
        .registration-form fieldset { border: 1px solid #ddd; border-radius: 6px; padding: 20px; margin-bottom: 25px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 500; color: #333; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        
        .navbar { background-color: #ffffff; height: var(--navbar-height); display: flex; align-items: center; border-bottom: 1px solid var(--color-border-subtle); }
        .navbar__container { display: flex; justify-content: space-between; align-items: center; width: 90%; max-width: 1140px; margin: 0 auto; }
        .navbar__brand { font-size: 1.5rem; font-weight: 700; text-decoration: none; color: #333; }
        
        .navbar__list { list-style: none; display: flex; gap: 10px; }
        .navbar__link--cta { color: var(--color-primary); font-weight: bold; text-decoration: none; padding: 0.5rem 1rem; }

        .content { text-align: center; padding: 2rem 0; color: #13120b; }
        .submit-btn { width: 100%; padding: 15px; background: #28a745; color: white; border: none; border-radius: 5px; font-size: 1.2rem; font-weight: bold; cursor: pointer; }
        
        .alert { padding: 10px; margin-bottom: 20px; border-radius: 4px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }

        .footer-newsletter__bottom { background-color: var(--bottom-bg); color: var(--bottom-text-color); padding: 1.5rem 0; text-align: center; margin-top: auto; }
    </style>
</head>
<body>

    <header class="navbar">
        <div class="navbar__container">
            <a href="#" class="navbar__brand">ABC School</a>
            <nav class="navbar__menu">
                <ul class="navbar__list">
                    <li><a href="add_student.php" class="navbar__link--cta">Add students</a></li>
                    <li><a href="update_student.php" class="navbar__link--cta">Update students</a></li>
                    <li><a href="view_students.php" class="navbar__link--cta">View students</a></li>
                    <li><a href="logout.php" class="navbar__link--cta">Sign out</a></li>
                </ul>
            </nav>
        </div>    
    </header>
    
    <main class="content">
        <h1>Update Student</h1>

        <div class="registration-container">
            <?php if ($message): ?>
                <div class="alert"><?php echo $message; ?></div>
            <?php endif; ?>

            <h2 style="text-align: center;">Student Data</h2>
            <form id="checkoutForm" action="update_student.php" method="post">
                <fieldset>
                    <legend>Information</legend>
                    
                    <div class="form-group">
                        <label for="Subject">Current Subject</label>
                        <input type="text" id="Subject" name="Subject" value="Web Programming" readonly>
                    </div>

                    <div class="form-group">
                        <label for="ChangeSubject">Change Subject (Only Admins)</label>
                        <input type="text" id="ChangeSubject" name="ChangeSubject" placeholder="Enter new subject" required>
                    </div>

                    <div class="form-group">
                        <label for="Grade">Current Grade</label>
                        <input type="text" id="Grade" name="Grade" value="1.0" readonly>
                    </div>

                    <div class="form-group">
                        <label for="ChangeGrade">Change Grade (Only Admins)</label>
                        <input type="text" id="ChangeGrade" name="ChangeGrade" placeholder="Enter new grade" required>
                    </div>

                    <div class="form-group">
                        <label for="Course">Current Course</label>
                        <input type="text" id="Course" name="Course" value="BSIT" readonly>
                    </div>

                    <div class="form-group">
                        <label for="ChangeCourse">Change Course (Only Admins)</label>
                        <input type="text" id="ChangeCourse" name="ChangeCourse" placeholder="Enter new course" required>
                    </div>

                    <div class="form-group">
                        <label for="Department">Current Department</label>
                        <input type="text" id="Department" name="Department" value="CICS" readonly>
                    </div> 

                    <div class="form-group">
                        <label for="ChangeDepartment">Change Department (Only Admins)</label>
                        <input type="text" id="ChangeDepartment" name="ChangeDepartment" placeholder="Enter new department" required>
                    </div> 
                </fieldset>
                <button type="submit" class="submit-btn">Update Student</button>
            </form>
        </div>
    </main>

    <footer class="footer-newsletter">
        <div class="footer-newsletter__bottom">
            <p>&copy; 2026 Webprogramming Subject All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('success')) {
            alert("Student details updated successfully!");
        }
    </script>
</body>
</html>