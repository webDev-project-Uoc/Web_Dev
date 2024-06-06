<?php
include('config.php');
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $userid = $_POST['user_id'];
        $firstname = $_POST['first_name'];
        $lastname = $_POST['last_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];

        $query = "UPDATE user SET first_name='$firstname', last_name='$lastname', username='$username', email='$email' WHERE user_id='$userid'";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('User updated successfully');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    } elseif (isset($_POST['delete'])) {
        $userid = $_POST['user_id'];
        $query = "DELETE FROM user WHERE user_id='$userid'";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('User deleted successfully');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
}

$query = "SELECT * FROM user";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Manage Users - Library Management System</title>
    <style>
        body { background-color: #ffffff; }
        .container { padding-top: 50px; }
        table { width: 100%; }
        .btn { margin-top: 5px; }
        .btn-group { display: inline-flex; }
        .btn-group .btn { margin-right: 5px; }
        
    </style>
</head>
<body>
    <div class="container">
        <h2>Manage Users</h2> 
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <form method="POST" action="">
                        <td><?php echo $row['user_id']; ?></td>
                        <td><input type="text" name="first_name" value="<?php echo $row['first_name']; ?>"></td>
                        <td><input type="text" name="last_name" value="<?php echo $row['last_name']; ?>"></td>
                        <td><input type="text" name="username" value="<?php echo $row['username']; ?>" disabled></td>
                        <td><input type="password" name="password" value="<?php echo $row['password']; ?>" disabled></td>
                        <td><input type="email" name="email" value="<?php echo $row['email']; ?>"></td>
                        <td class="btn-group">
                            <button type="submit" name="update" class="btn btn-warning btn-sm">Update</button>
                            <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </form>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button class="btn btn-outline-info " onclick="location.href='dashboard.php'">Dashboard</button>
    </div>
</body>
</html>