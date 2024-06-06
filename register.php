<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if (strlen($password) < 8) {
        echo "<script>alert('Password must be at least 8 characters long');</script>";
    } else {
        $password = hash('sha256', $password);

        $user_check_query = "SELECT * FROM user WHERE email='$email' OR username='$username' LIMIT 1";
        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            if ($user['email'] === $email) {
                echo "<script>alert('Email already exists');</script>";
            } elseif ($user['username'] === $username) {
                echo "<script>alert('Username already exists');</script>";
            }
        } else {
            // Correct user ID generation
            $result = mysqli_query($conn, "SELECT MAX(user_id) AS max_user_id FROM user");
            $row = mysqli_fetch_assoc($result);
            $max_user_id = $row ? intval(substr($row['max_user_id'], 1)) : 0;
            $user_id = 'U' . str_pad($max_user_id + 1, 3, '0', STR_PAD_LEFT);

            $query = "INSERT INTO user (user_id, first_name, last_name, username, password, email) 
                      VALUES('$user_id', '$firstname', '$lastname', '$username', '$password', '$email')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Registration successful');</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Register - Library Management System</title>
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
        .body { background-color: #f0f8ff; }
    </style>
</head>
<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="https://i.ibb.co/mbf7tmL/Business-people-writing-agreement-shaking-hands.jpg" class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <form method="POST" action="">
                        <!-- first name -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="first_name">First Name</label>
                            <input type="text" id="first_name" class="form-control form-control-lg" name="first_name" required />
                        </div>
                        <!-- last name -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="last_name">Last Name</label>
                            <input type="text" id="last_name" class="form-control form-control-lg" name="last_name" required />
                        </div>
                        <!-- user name -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="username">User Name</label>
                            <input type="text" id="username" class="form-control form-control-lg" name="username" required />
                        </div>
                        <!-- email -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" class="form-control form-control-lg" name="email" required />
                        </div>
                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" class="form-control form-control-lg" name="password" required />
                        </div>
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-info btn-lg btn-block">Register</button>
                        <button class="btn btn-outline-info btn-lg btn-block" onclick="location.href='login.php'">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
