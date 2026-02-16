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
            --font-family-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            --font-weight-normal: 400;
            --font-weight-bold: 700;
            --navbar-height: 70px;
            --navbar-padding: 1rem;
            --container-width: 1140px;
            --transition-speed: 0.2s;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: var(--font-family-sans-serif);
            line-height: 1.5;
            color: var(--color-text);
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

        .navbar__toggle {
            display: block; 
            padding: 0.5rem;
            border: none;
            background: transparent;
            cursor: pointer;
        }

        .navbar__toggle .bar {
            display: block;
            width: 25px;
            height: 3px;
            margin: 5px auto;
            background-color: var(--color-text);
            transition: all var(--transition-speed) ease-in-out;
        }

        .navbar__menu {
            display: none; 
            flex-direction: column;
            width: 100%;
            position: absolute;
            top: var(--navbar-height);
            left: 0;
            background-color: var(--color-background);
            z-index: 1000;
        }
        
        .navbar__menu.is-active { display: flex; }
        .navbar__list { list-style: none; margin: 0; padding: 0; }
        .navbar__link { display: block; padding: 1.5rem; text-decoration: none; color: var(--color-text); }
        .navbar__link--cta { color: var(--color-primary); font-weight: var(--font-weight-bold); }

        @media (min-width: 768px) {
            .navbar__toggle { display: none; }
            .navbar__menu { display: flex; position: static; width: auto; background-color: transparent; }
            .navbar__list { display: flex; align-items: center; }
            .navbar__link { padding: 0.5rem 1rem; }
        }

        .content { text-align: center; padding: 5rem 0; color: #070706; }

        table.GeneratedTable {
            width: 75%;
            margin-left: auto;
            margin-right: auto;
            background-color: #fff5f5;
            border-collapse: collapse;
            border: 2px solid #ffcc00;
            color: #000000;
        }

        table.GeneratedTable td, table.GeneratedTable th {
            border: 2px solid #ffcc00;
            padding: 10px;
        }

        table.GeneratedTable thead { background-color: #ffcc00; }

        .footer-newsletter__bottom {
            background-color: var(--bottom-bg);
            color: var(--bottom-text-color);
            padding: 1.5rem 0;
            font-size: 0.875rem;
            margin-top: auto;
        }
    </style>
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