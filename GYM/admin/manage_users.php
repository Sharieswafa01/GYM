<!-- manage_users.php -->

<?php
// Include your database connection or any necessary includes here
include('../user/db_connection.php');

// Example query to fetch users for management
$query = "SELECT * FROM users"; 
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="../css/styles.css"> <!-- Link to your global CSS file -->
    <link rel="stylesheet" href="css/manage_users.css"> <!-- Link to the manage users CSS file in the admin folder -->
</head>
<body>
    <header>
        <h1>Manage Users</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Back to Dashboard</a></li> <!-- Back link to admin dashboard -->
            </ul>
        </nav>
    </header>

    <section>
        <h2>User List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></td> <!-- Concatenate first and last name -->
                        <td><?php echo $user['role']; ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $user['id']; ?>">Edit</a>
                            <a href="delete_user.php?id=<?php echo $user['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>

    <footer>
        <p>&copy; 2025 Admin Panel</p>
    </footer>
</body>
</html>
