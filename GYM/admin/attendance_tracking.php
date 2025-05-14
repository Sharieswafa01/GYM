<?php
session_start();
include('../user/db_connection.php'); // Adjusted DB path

if (!isset($conn)) {
    die("Database connection not established.");
}

// Ensure admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch attendance records (latest first)
$query = "
    SELECT 
        a.id, 
        CONCAT(u.first_name, ' ', u.last_name) AS full_name, 
        u.role, 
        a.status, 
        a.login_time, 
        a.logout_time 
    FROM attendance a
    JOIN users u ON a.user_id = u.id
    ORDER BY a.timestamp DESC
";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance Tracking - Admin Panel</title>
    <link rel="stylesheet" href="../styles.css"> <!-- Optional global styles -->
    <link rel="stylesheet" href="css/attendance_tracking.css"> <!-- External CSS file -->
    <style>
        .folder-section {
            margin-top: 40px;
            padding: 20px;
            background:rgb(9, 9, 9);
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        .folder-section h3 a {
            text-decoration: none;
            color:rgb(246, 247, 249);
            font-weight: bold;
        }

        .folder-section h3 a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Back Arrow Link -->
    <a href="admin_dashboard.php" class="back-arrow" title="Go back">&#8592; Back</a>

    <div class="container">
        <h2>Attendance Tracking</h2>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Full Name</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Login Time</th>
                    <th>Logout Time</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['full_name']) ?></td>
                            <td><?= htmlspecialchars($row['role']) ?></td>
                            <td class="<?= $row['status'] === 'Login' ? 'status-login' : 'status-logout' ?>">
                                <?= htmlspecialchars($row['status']) ?>
                            </td>
                            <td><?= $row['login_time'] ? htmlspecialchars($row['login_time']) : '—' ?></td>
                            <td><?= $row['logout_time'] ? htmlspecialchars($row['logout_time']) : '—' ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6">No attendance records found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Space between sections -->
    <br><br>

    <!-- Folder-like Attendance Record Section -->
    <div class="container folder-section">
        <h3><a href="daily_folders.php">📁 Daily Attendance Records</a></h3>
    </div>

    <div class="container folder-section">
        <h3><a href="monthly_folders.php">📁 Monthly Attendance Records</a></h3>
    </div>

    <div class="container folder-section">
        <h3><a href="yearly_folders.php">📁 Yearly Attendance Records</a></h3>
    </div>
</body>
</html>
