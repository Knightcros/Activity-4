<?php

session_start();

$host = 'localhost';
$db   = 'student_db';
$user = 'root';
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $stmt = $pdo->query("SELECT first_name, last_name, id_number, course FROM students");
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Webprogramming - View Students</title>
    
</head>
<body>

    <header class="navbar">
        <div class="navbar__container">
            <a href="#" class="navbar__brand">ABC School</a>
            <button class="navbar__toggle" id="navbarToggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
            <nav id="navbarMenu" class="navbar__menu">
                <ul class="navbar__list">
                    <li class="navbar__item"><a href="add_student.php" class="navbar__link">Add students</a></li>
                    <li class="navbar__item"><a href="update_student.php" class="navbar__link">Update students</a></li>
                    <li class="navbar__item"><a href="view_students.php" class="navbar__link">View students</a></li>
                    <li class="navbar__item"><a href="logout.php" class="navbar__link navbar__link--cta">Sign out</a></li>
                </ul>
            </nav>
        </div>    
    </header>
    
    <main class="content">
        <h1>View Students</h1>

        <table class="GeneratedTable">
          <thead>
            <tr>
              <th>Students (Full Name)</th>         
              <th>ID Number</th>
              <th>Course</th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($students) > 0): ?>
                <?php foreach ($students as $row): ?>
                    <tr>
                      <td><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
                      <td><?php echo htmlspecialchars($row['id_number']); ?></td>
                      <td><?php echo htmlspecialchars($row['course']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No students found in the database.</td>
                </tr>
            <?php endif; ?>
          </tbody>
        </table>
    </main>

    <footer class="footer-newsletter">
        <div class="footer-newsletter__bottom">
            <div style="text-align: center;">
                <p>&copy; 2026 Webprogramming Subject All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const navbarToggle = document.getElementById('navbarToggle');
            const navbarMenu = document.getElementById('navbarMenu');

            if (navbarToggle && navbarMenu) {
                navbarToggle.addEventListener('click', function () {
                    navbarToggle.classList.toggle('is-active');
                    navbarMenu.classList.toggle('is-active');
                });
            }
        });
    </script>
</body>

</html>
