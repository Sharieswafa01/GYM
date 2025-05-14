<?php
session_start();
$loggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login - CTU Danao Gym</title>
    <link rel="stylesheet" href="css/user_login.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .notification {
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            font-weight: bold;
            text-align: center;
        }
        .login-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .logout-success {
            background-color: #cce5ff;
            color: #004085;
            border: 1px solid #b8daff;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .container {
            display: flex;
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .left-section, .right-section {
            width: 50%;
            padding: 20px;
        }
        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .logo-text {
            font-weight: bold;
            font-size: 20px;
        }
        form label {
            display: block;
            margin-top: 10px;
        }
        form input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        .form-buttons button {
            flex: 1;
            padding: 10px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .login-btn {
            background-color: #28a745;
            color: white;
        }
        .logout-btn {
            background-color:rgb(252, 1, 1);
            color: white;
        }
        .signup-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
            color: #333;
        }
        .signup-link:hover {
            text-decoration: underline;
        }
        .user-info p {
            margin: 5px 0;
        }
        .right-section h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Left Section -->
    <div class="left-section">
        <div class="logo-container">
            <img src="images/ctu_logo.png" alt="CTU Logo" style="max-width: 40px; max-height: 40px; border: 1px solid #ccc;">
            <span class="logo-text">CTU GYMTECH</span>
        </div>

        <!-- Combined Login/Logout Form -->
        <form method="POST">
            <label for="user_id">ID NO:</label>
            <input type="text" name="user_id" id="user_id" required autocomplete="off">

            <div class="form-buttons">
                <button type="submit" formaction="process_login.php" class="login-btn">Login</button>
                <button type="submit" formaction="process_logout.php" class="logout-btn">Logout</button>
            </div>
        </form>

        <!-- Sign Up Link -->
        <a href="signup.php" class="signup-link">Register</a>
    </div>

    <!-- Right Section -->
    <div class="right-section">
        <h2>User Information</h2>

        <!-- Notification Message -->
        <?php if (isset($_SESSION['notification'])): ?>
            <div class="notification <?= htmlspecialchars($_SESSION['notification_type']) ?>">
                <?= htmlspecialchars($_SESSION['notification']) ?>
            </div>
            <?php unset($_SESSION['notification'], $_SESSION['notification_type']); ?>
        <?php endif; ?>

        <!-- Error Message -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="notification <?= htmlspecialchars($_SESSION['message_type'] ?? 'error') ?>">
                <?= htmlspecialchars($_SESSION['message']) ?>
            </div>
            <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
        <?php endif; ?>

        <?php if ($loggedIn || isset($_SESSION['logout_time'])): ?>
            <div class="user-info">
                <p><strong>Name:</strong> <?= htmlspecialchars($_SESSION['name'] ?? 'N/A') ?></p>
                <p><strong>Age:</strong> <?= htmlspecialchars($_SESSION['age'] ?? 'N/A') ?></p>
                <p><strong>Gender:</strong> <?= htmlspecialchars($_SESSION['gender'] ?? 'N/A') ?></p>
                <p><strong>Role:</strong> <?= htmlspecialchars($_SESSION['type'] ?? 'N/A') ?></p>

                <?php if ($_SESSION['type'] == 'Student'): ?>
                    <p><strong>Course:</strong> <?= htmlspecialchars($_SESSION['course'] ?? 'N/A') ?></p>
                    <p><strong>Section:</strong> <?= htmlspecialchars($_SESSION['section'] ?? 'N/A') ?></p>
                <?php endif; ?>

                <?php if ($loggedIn): ?>
                    <p><strong>Login Time:</strong> <?= htmlspecialchars($_SESSION['login_time'] ?? '') ?></p>
                <?php elseif (isset($_SESSION['logout_time'])): ?>
                    <p><strong>Logout Time:</strong> <?= htmlspecialchars($_SESSION['logout_time']) ?></p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <p>Please login to view your information.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
