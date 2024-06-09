<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']);

    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit();
    } else {
        echo "<script>alert('Invalid login credentials');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Login - Library Management System</title>
    <style>
        .divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}
        .body{background-color: #ffffff}

    </style>
</head>
<body class="body" >
    <section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="https://i.ibb.co/nkG1Kzj/20547283-6310507.jpg" class="img-fluid" alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <form method="POST" action="" >
          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
              <label class="form-label" for="username">Email address</label>
            <input type="text" id="username" class="form-control form-control-lg" name="username" required />
            
          </div>

          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-4">
              <label class="form-label" for="password">Password</label>
            <input type="password" id="password" class="form-control form-control-lg" name="password" required />
            
          </div>


          <!-- Submit button -->
          <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-lg btn-block">Sign in</button>



        </form>
      </div>
    </div>
  </div>
</section>

</body>
</html>
