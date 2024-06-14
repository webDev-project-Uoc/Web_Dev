<?php
include('config.php');
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $categoryid = $_POST['category_id'];
        $categoryname = $_POST['category_name'];
        $datemodified = date('Y-m-d H:i:s');

        if (!preg_match('/^C\d+$/', $categoryid)) {
            echo "<script>alert('Invalid Category ID format');</script>";
        } else {
            $query = "INSERT INTO bookcategory (category_id, category_name, date_modified) VALUES ('$categoryid', '$categoryname', '$datemodified')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Category added successfully');</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }
        }
    } elseif (isset($_POST['update'])) {
        $categoryid = $_POST['category_id'];
        $categoryname = $_POST['category_name'];
        $datemodified = date('Y-m-d H:i:s');

        $query = "UPDATE bookcategory SET category_name='$categoryname', date_modified='$datemodified' WHERE category_id='$categoryid'";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Category updated successfully');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    } elseif (isset($_POST['delete'])) {
        $categoryid = $_POST['category_id'];
        $query = "DELETE FROM bookcategory WHERE category_id='$categoryid'";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Category deleted successfully');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
}

$query = "SELECT * FROM bookcategory";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Manage Categories - Library Management System</title>
    <style>
        body { background-color: #ffffff; }
        .container { padding-top: 50px; }
        table { width: 100%; }
        .btn { margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Manage Categories</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="category_id">Category ID</label>
                <input type="text" class="form-control" id="category_id" name="category_id" required>
            </div>
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" required>
            </div>
            <button type="submit" name="add" class="btn btn-primary">Add Category</button>
        </form>
        
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Date Modified</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <form method="POST" action="">
                        <td><input type="text" name="category_id" value="<?php echo $row['category_id']; ?>" readonly></td>
                        <td><input type="text" name="category_name" value="<?php echo isset($row['category_Name']) ? $row['category_Name'] : ''; ?>"></td>
                        <td><?php echo $row['date_modified']; ?></td>
                        <td>
                            <button type="submit" name="update" class="btn btn-warning btn-sm">Update</button>
                            <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </form>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button class="btn btn-outline-info" onclick="location.href='dashboard.php'">Dashboard</button>
    </div>
</body>
</html>
