<?php
include('config.php');
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$query = "SELECT * FROM bookcategory";
$category_result = mysqli_query($conn, $query);
$category_map = [];

while ($row = mysqli_fetch_assoc($category_result)) {
    $category_map[$row['category_id']] = $row['category_Name'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $bookid = $_POST['book_id'];
        $bookname = $_POST['book_name'];
        $categoryid = $_POST['category_id'];

        if (!preg_match('/^B\d+$/', $bookid)) {
            echo "<script>alert('Invalid Book ID format');</script>";
        } else {
            $query = "INSERT INTO book (book_id, book_name, category_id) VALUES ('$bookid', '$bookname', '$categoryid')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Book added successfully');</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }
        }
    } elseif (isset($_POST['update'])) {
        $bookid = $_POST['book_id'];
        $bookname = $_POST['book_name'];
        $categoryid = $_POST['category_id'];

        $query = "UPDATE book SET book_name='$bookname', category_id='$categoryid' WHERE book_id='$bookid'";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Book updated successfully');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    } elseif (isset($_POST['delete'])) {
        $bookid = $_POST['book_id'];
        $query = "DELETE FROM book WHERE book_id='$bookid'";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Book deleted successfully');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
}

$query = "SELECT * FROM book";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Manage Books - Library Management System</title>
    <style>
        body { background-color: #ffffff; }
        .container { padding-top: 50px; }
        table { width: 100%; }
        .btn { margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Manage Books</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="book_id">Book ID</label>
                <input type="text" class="form-control" id="book_id" name="book_id" required>
            </div>
            <div class="form-group">
                <label for="book_name">Book Name</label>
                <input type="text" class="form-control" id="book_name" name="book_name" required>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <?php foreach ($category_map as $category_id => $category_name): ?>
                        <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="add" class="btn btn-primary">Add Book</button>
        </form>
        
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <form method="POST" action="">
                        <td><input type="text" name="book_id" value="<?php echo $row['book_id']; ?>" readonly></td>
                        <td><input type="text" name="book_name" value="<?php echo $row['book_name']; ?>"></td>
                        <td>
                            <select class="form-control" name="category_id">
                                <?php foreach ($category_map as $category_id => $category_name): ?>
                                    <option value="<?php echo $category_id; ?>" <?php if ($row['category_id'] == $category_id) echo 'selected'; ?>>
                                        <?php echo $category_name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
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
