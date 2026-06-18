<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>


<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Services</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Contact</a>
        </li>
        
        
        
      </ul>

       <!-- Login Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Login</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Login form -->
        <form action="/Language_learning_platform/pages/login.php" method="POST">
          <div class="mb-3">
            <label for="loginUsername" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" id="loginUsername" placeholder="Enter username">
          </div>
            <div class="mb-3">
            <label for="email" class="form-label">Email Id</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Id">
          </div>
          <div class="mb-3">
            <label for="loginPassword" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="loginPassword" placeholder="Enter password">
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="registerModalLabel">Register</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Registration form -->
        <form action="/Language_learning_platform/pages/register.php" method="POST">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email Id</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Id">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
          </div>
          <button type="submit" class="btn btn-primary">Register</button>
        </form>
      </div>
    </div>
  </div>
</div>


      <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>

    <a href="/Language_learning_platform/pages/logout.php"
       class="btn btn-danger btn-sm">
        Logout
    </a>

<?php else: ?>

    <button class="btn btn-success btn-sm m-2"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal">
        Login
    </button>

    <button class="btn btn-primary btn-sm m-2"
            data-bs-toggle="modal"
            data-bs-target="#registerModal">
        Register
    </button>

<?php endif; ?>
    </div>
  </div>
</nav>





