<?php
// login.php - Enhanced Admin Login
session_start();
require_once 'config.php';

// If already logged in, redirect to admin
if (isset($_SESSION['admin_logged_in'])) {
    header('Location: admin.php');
    exit();
}

$error = '';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Validate input
    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password';
    } else {
        $stmt = $conn->prepare("SELECT id, username, password_hash, status FROM admin_users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $admin = $result->fetch_assoc();
            
            // Check if account is active
            if ($admin['status'] === 'inactive') {
                $error = 'Your account has been deactivated. Please contact the administrator.';
            } elseif (password_verify($password, $admin['password_hash'])) {
                // Login successful
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                
                // Update last login time
                $updateStmt = $conn->prepare("UPDATE admin_users SET last_login = NOW() WHERE id = ?");
                $updateStmt->bind_param("i", $admin['id']);
                $updateStmt->execute();
                
                // Redirect to admin panel or previous page
                $redirect_to = $_SESSION['redirect_to'] ?? 'admin.php';
                unset($_SESSION['redirect_to']);
                header('Location: ' . $redirect_to);
                exit();
            } else {
                $error = 'Invalid username or password';
            }
        } else {
            $error = 'Invalid username or password';
        }
        
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Fanuel Masuka Portfolio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #E8F5E9 0%, #C8E6C9 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            border-top: 5px solid #2E8B57;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo h1 {
            color: #1A5D3A;
            font-size: 2rem;
            margin-bottom: 5px;
        }
        
        .logo p {
            color: #666;
            font-size: 0.9rem;
        }
        
        h2 {
            color: #1A5D3A;
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.8rem;
        }
        
        .alert {
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }
        
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        input:focus {
            outline: none;
            border-color: #2E8B57;
            box-shadow: 0 0 0 3px rgba(46, 139, 87, 0.1);
        }
        
        .btn {
            width: 100%;
            padding: 14px;
            background-color: #2E8B57;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }
        
        .btn:hover {
            background-color: #1A5D3A;
        }
        
        .btn:active {
            transform: translateY(1px);
        }
        
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #2E8B57;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
        
        .demo-credentials {
            background-color: #E8F5E9;
            padding: 15px;
            border-radius: 8px;
            margin-top: 25px;
            border-left: 4px solid #2E8B57;
        }
        
        .demo-credentials h4 {
            color: #1A5D3A;
            margin-bottom: 10px;
            font-size: 0.9rem;
        }
        
        .demo-credentials p {
            color: #555;
            font-size: 0.85rem;
            line-height: 1.5;
        }
        
        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }
            
            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <h1><i class="fas fa-user-shield"></i> Portfolio Admin</h1>
            <p>Fanuel Masuka - Secure Access</p>
        </div>
        
        <h2>Admin Login</h2>
        
        <?php if ($error): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-with-icon">
                    <i class="fas fa-user"></i>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required autofocus>
                </div>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-with-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
            </div>
            
            <button type="submit" class="btn">
                <i class="fas fa-sign-in-alt"></i> Login to Dashboard
            </button>
        </form>
        
        <a href="index.php" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Portfolio
        </a>
        
        <div class="demo-credentials">
            <h4><i class="fas fa-info-circle"></i> Demo Credentials:</h4>
            <p><strong>Username:</strong> fanny</p>
            <p><strong>Password:</strong> masuka@2022</p>
            <p style="margin-top: 8px; font-size: 0.8rem; color: #777;">
                <i class="fas fa-exclamation-triangle"></i> Change these credentials in production!
            </p>
        </div>
    </div>
    
    <script>
        // Simple password visibility toggle
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const lockIcon = document.querySelector('.fa-lock');
            
            lockIcon.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    lockIcon.classList.remove('fa-lock');
                    lockIcon.classList.add('fa-unlock');
                } else {
                    passwordInput.type = 'password';
                    lockIcon.classList.remove('fa-unlock');
                    lockIcon.classList.add('fa-lock');
                }
            });
            
            // Auto-focus on username field
            document.getElementById('username').focus();
        });
    </script>
</body>
</html>