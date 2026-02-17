<?php
session_start();

$host = 'localhost';
$db   = 'student_db';
$user = 'root';
$pass = ''; 

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM teachers WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $teacher = $stmt->fetch();

        if ($teacher && $password === $teacher['password']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['teacher_name'] = $teacher['name'];
            
            header("Location: view_students.php");
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Webprogramming - Login</title>
    
    
</head>
<body>

<div class="login-form-container">
    <div class="login-form-header">
        <h2>Hello Teacher</h2>
        <p>Please enter your Username and Password</p>
    </div>

    <?php if ($error): ?>
        <div class="error-msg"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="login.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div class="form-options">
            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me</label>
            </div>
            <a href="#" style="text-decoration: none; color: #007bff;">Forgot password?</a>    
        </div>
        
        <button type="submit" class="submit-btn">Log In</button>
    </form>
</div>

<script src="script.js"></script>
</body>

</html>

