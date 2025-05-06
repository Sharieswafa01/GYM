<?php
session_start();

// Check if user is already logged in
$loggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login - CTU Danao Gym</title>
    <link rel="stylesheet" href="css/user_login.css">
    <style>
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
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Center the 'User Information' text */
        .right-section h2 {
            text-align: center;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Left Section -->
    <div class="left-section">
        <div class="logo-container">
            <img src="images/ctu_logo.png"
                 alt="CTU Logo"
                 style="max-width: 40px; max-height: 40px; border: 1px solid #ccc;">
            <span class="logo-text">CTU GYMTECH</span>
        </div>

        <!-- Combined Form -->
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

        <!-- Success Notification -->
        <?php if (isset($_SESSION['notification'])): ?>
            <div class="notification <?= $_SESSION['notification_type'] ?>">
                <?= htmlspecialchars($_SESSION['notification']) ?>
            </div>
            <?php unset($_SESSION['notification'], $_SESSION['notification_type']); ?>
        <?php endif; ?>

        <!-- Error Message -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="notification <?= $_SESSION['message_type'] ?? 'error' ?>">
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
                <?php if ($loggedIn): ?>
                    <p><strong>Login Time:</strong> <?= htmlspecialchars($_SESSION['login_time']) ?></p>
                <?php elseif (isset($_SESSION['logout_time'])): ?>
                    <p><strong>Logout Time:</strong> <?= htmlspecialchars($_SESSION['logout_time']) ?></p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <p>Please log in to view your information.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
