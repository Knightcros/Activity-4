<?php
session_start();

// 1. Database Connection
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

        // 2. Check for user (Assuming a 'teachers' or 'users' table)
        $stmt = $pdo->prepare("SELECT * FROM teachers WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $teacher = $stmt->fetch();

        // 3. Verify Password (In production, use password_verify with hashed passwords!)
        if ($teacher && $password === $teacher['password']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['teacher_name'] = $teacher['name'];
            
            // Redirect to the View Students page
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
    <title>Webprogramming - Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url("https://images.template.net/435560/Education-Background-Template-edit-online.png");
            background-size: cover;        
            background-position: center;   
            background-repeat: no-repeat;  
            background-attachment: fixed; 
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .login-form-container {
            max-width: 400px;
            width: 90%;
            padding: 30px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .login-form-header h2 { margin: 0 0 10px; text-align: center; color: #333; }
        .login-form-header p { text-align: center; color: #666; margin: 0 0 30px; font-size: 0.95rem; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; }
        .form-group input { 
            width: 100%; 
            padding: 12px; 
            border: 1px solid #ccc; 
            border-radius: 5px; 
            box-sizing: border-box;
        }

        .error-msg {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
        }
        
        .submit-btn:hover { background-color: #0056b3; }

        .form-options {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
    </style>
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

</body>
</html>