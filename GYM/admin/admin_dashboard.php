<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin_dashboard.css">
    <!-- Link the new profile modal CSS -->
    <link rel="stylesheet" href="css/update_admin_profile.css">
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar open" id="sidebar">
            <div class="logo">
                <h2>Gym Admin</h2>
            </div>
            <nav class="nav">
                <ul>
                    <li><a href="attendance_tracking.php">🕒 Attendance Tracking</a></li>
                    <li><a href="manage_users.php">👥 Manage Users</a></li>
                    <li><a href="manage_equipment.php">🏋️ Equipment</a></li>
                </ul>
            </nav>

            <!-- Logout Link Styled Like Sidebar Items -->
            <div class="sidebar-logout">
                <a href="admin_logout.php">🚪 Logout</a>
            </div>
        </aside>

        <!-- Hamburger Icon -->
        <button class="sidebar-toggle" id="hamburger-icon">☰</button>

        <!-- Profile Icon -->
        <div class="profile-icon" onclick="toggleProfileModal()">👤</div>

        <!-- Profile Modal -->
        <div class="profile-modal" id="profileModal">
            <div class="modal-content">
                <span class="close" onclick="toggleProfileModal()">&times;</span>
                <h2>Edit Profile</h2>
                <form action="update_admin_profile.php" method="POST">
                    <label for="admin_name">Name:</label>
                    <input type="text" id="admin_name" name="admin_name" required>

                    <label for="admin_email">Email:</label>
                    <input type="email" id="admin_email" name="admin_email" required>

                    <label for="admin_password">New Password:</label>
                    <input type="password" id="admin_password" name="admin_password" required>

                    <button type="submit">Update Profile</button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <h1>Welcome to Admin Dashboard</h1>
            </header>

            <section class="dashboard-cards">
                <div class="card">
                    <h3>Attendance Tracking</h3>
                    <p>Track user attendance and gym check-ins.</p>
                    <a href="attendance_tracking.php" class="card-btn">View Attendance</a>
                </div>

                <div class="card">
                    <h3>Manage Users</h3>
                    <p>View and manage all users of the gym.</p>
                    <a href="manage_users.php" class="card-btn">Go to Users</a>
                </div>

                <div class="card">
                    <h3>Equipment</h3>
                    <p>View and manage the gym equipment.</p>
                    <a href="manage_equipment.php" class="card-btn">Go to Equipment</a>
                </div>
            </section>
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const hamburgerIcon = document.getElementById('hamburger-icon');

        hamburgerIcon.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });

        function toggleProfileModal() {
            const modal = document.getElementById('profileModal');
            modal.style.display = modal.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>
