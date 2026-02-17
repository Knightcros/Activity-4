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
    <link rel="stylesheet" href="style.css">
    <?php echo $message; ?>
    
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

<script src="script.js"></script>
</body>

</html>

