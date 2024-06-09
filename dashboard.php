<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Dashboard - Library Management System</title>
    <style>
        body { background-color:#ffffff; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .container { text-align: justify; }
        .btn { margin: 10px; }
        .row { display: flex; justify-content: center; align-items: center; height: 50vh; }
        .btn-logout { position: absolute; bottom: 20px; right: 20px; }
        .welcome{padding-bottom:6rem}
        
    </style>
</head>
<body>
   
   
    <div class="container">
        
        <div class="row">
            <div class="col-4 pe-5  text-start welcome">
                <h2>Welcome to the Library Management System Dashboard</h2>
                <p>Welcome to the Library Management System! Our platform streamlines the entire library experience, offering a seamless way to search, borrow, and manage books. Whether you're a student, researcher, or avid reader, our user-friendly interface ensures easy access to a vast collection of resources. Join our community and enjoy the convenience of staying organized with automated reminders, personalized recommendations, and efficient catalog management. Explore, discover, and immerse yourself in the world of knowledge with us!</p>
            
            </div>
        
<!-- first card-->
        
            <div class="col">
            <div class="card text-bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">Manage Users</div>
                <div class="card-body">
                <h5 class="card-title">User Management</h5>
                <p class="card-text">Add, update, or remove users easily.</p>
                 <a href="manage_users.php" class="btn btn-outline-dark">Manage Users</a>
                </div>
            </div>
            </div>
        
<!-- Second card-->
            <div class="col">
            <div class="card text-bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-header">Manage Books</div>
                <div class="card-body">
                <h5 class="card-title">Book Management</h5>
                <p class="card-text">Add new books, update book details, or remove titles.</p>
                 <a href="manage_books.php" class="btn btn-outline-dark">Manage Books</a>
                </div>
            </div>
            </div>
      
<!--third card-->
            <div class="col">
            <div class="card text-bg-info mb-3" style="max-width: 18rem;">
                <div class="card-header">Manage Categories</div>
                <div class="card-body">
                <h5 class="card-title">Category Management</h5>
                <p class="card-text">Create, update, or delete book categories.</p>
                 <a href="manage_categories.php" class="btn btn-outline-dark">Manage Categories</a>
            </div>
        </div>
        </div>
       
    </div>
</div>
        
        <button class="btn btn-danger btn-logout" onclick="if(confirm('Are you sure you want to log out?')) { location.href='logout.php'; }">Logout</button>
    
</body>
</html>
