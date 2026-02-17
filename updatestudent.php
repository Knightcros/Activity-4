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
    <link rel="stylesheet" href="css/style.css">
    
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

<script src="script.js"></script>
</body>

</html>

