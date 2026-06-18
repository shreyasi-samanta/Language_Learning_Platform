<?php
session_start();
include '../includes/db.php';

/*
if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

if($_SESSION['role'] != 'admin'){
    header("Location: index.php");
    exit();
}
*/

$admin_name = $_SESSION['name'] ?? "Admin";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
       body{
    background: #eef2ff;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    overflow-x: hidden;
}

/* Navbar */

.navbar{
    background: rgba(15, 23, 42, 0.95) !important;
    backdrop-filter: blur(10px);
    padding: 14px 0;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}

.navbar-brand{
    font-size: 26px;
    font-weight: bold;
    letter-spacing: 1px;
}

.navbar .btn-danger{
    border-radius: 10px;
    padding: 8px 18px;
    transition: 0.3s;
}

.navbar .btn-danger:hover{
    transform: translateY(-2px);
}

/* Hero Section */

.hero-section{
    background: linear-gradient(135deg,#2563eb,#4f46e5,#7c3aed);
    color: white;
    padding: 90px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.hero-section::before{
    content:'';
    position:absolute;
    width:300px;
    height:300px;
    background: rgba(255,255,255,0.1);
    border-radius:50%;
    top:-100px;
    left:-100px;
}

.hero-section::after{
    content:'';
    position:absolute;
    width:400px;
    height:400px;
    background: rgba(255,255,255,0.08);
    border-radius:50%;
    bottom:-180px;
    right:-120px;
}

.hero-section h1{
    font-size: 55px;
    font-weight: 700;
    position: relative;
    z-index: 2;
}

.hero-section p{
    font-size: 20px;
    opacity: 0.95;
    position: relative;
    z-index: 2;
}

/* Dashboard Cards */

.card{
    border: none;
    border-radius: 22px;
    overflow: hidden;
    transition: all 0.35s ease;
    background: rgba(255,255,255,0.75);
    backdrop-filter: blur(14px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
}

.card:hover{
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 18px 40px rgba(0,0,0,0.15);
}

.card-body{
    padding: 30px 20px;
}

.card h4{
    font-weight: 700;
    margin-top: 10px;
    color: #111827;
}

.card p{
    color: #6b7280;
    margin-top: 10px;
    min-height: 50px;
}

/* Buttons */

.btn{
    border-radius: 12px;
    padding: 10px 22px;
    font-weight: 600;
    transition: 0.3s;
    border: none;
}

.btn:hover{
    transform: translateY(-3px);
}

/* Dashboard Icons */

.dashboard-icon{
    width: 85px;
    height: 85px;
    line-height: 85px;
    margin: auto;
    border-radius: 50%;
    font-size: 35px;
    color: white;
    margin-bottom: 15px;
}

.bg-blue{
    background: linear-gradient(135deg,#3b82f6,#2563eb);
}

.bg-green{
    background: linear-gradient(135deg,#10b981,#059669);
}

.bg-orange{
    background: linear-gradient(135deg,#f59e0b,#d97706);
}

.bg-cyan{
    background: linear-gradient(135deg,#06b6d4,#0891b2);
}

.bg-purple{
    background: linear-gradient(135deg,#8b5cf6,#7c3aed);
}

/* Statistics Section */

.stats-title{
    font-size: 32px;
    font-weight: bold;
    color: #111827;
}

.stats-card{
    border-radius: 22px;
    color: white;
    padding: 20px;
    transition: 0.3s;
}

.stats-card:hover{
    transform: translateY(-8px);
}

.stats-number{
    font-size: 48px;
    font-weight: 700;
}

.stats-label{
    font-size: 18px;
    opacity: 0.9;
}

/* Individual Stat Colors */

.stat-primary{
    background: linear-gradient(135deg,#2563eb,#1d4ed8);
}

.stat-success{
    background: linear-gradient(135deg,#10b981,#059669);
}

.stat-danger{
    background: linear-gradient(135deg,#ef4444,#dc2626);
}

/* Section Spacing */

.section-space{
    margin-top: 70px;
}

/* Responsive */

@media(max-width:768px){

    .hero-section h1{
        font-size: 38px;
    }

    .hero-section p{
        font-size: 16px;
    }

}
    </style>
</head>
<body>

<!-- Navbar -->
 <!-- Add This Inside Navbar -->

<div class="d-flex align-items-center gap-3">

    <!-- Search Bar -->

    <form class="d-flex">
        <input class="form-control me-2 search-box"
               type="search"
               placeholder="Search..."
               aria-label="Search">
    </form>

   

    <!-- Admin Profile -->

    <div class="dropdown">

        <a class="btn profile-btn dropdown-toggle"
           href="#"
           role="button"
           data-bs-toggle="dropdown"
           aria-expanded="false">

            <img src="admin.jpg"
                 class="profile-img">

            <?php echo $admin_name; ?>

        </a>

        <ul class="dropdown-menu dropdown-menu-end">

            <li>
                <a class="dropdown-item" href="#">
                    <i class="bi bi-person-circle"></i> Profile
                </a>
            </li>

            <li>
                <a class="dropdown-item" href="#">
                    <i class="bi bi-gear-fill"></i> Settings
                </a>
            </li>

            <li><hr class="dropdown-divider"></li>

            <li>
                <a class="dropdown-item text-danger"
                   href="../pages/logout.php">

                   <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>

        </ul>

    </div>

</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Admin Panel</a>

        <div class="ms-auto">
            <span class="text-white me-3">
                Welcome, <?php echo $admin_name; ?>
            </span>

            <a href="../pages/logout.php" class="btn btn-danger btn-sm">
                Logout
            </a>
        </div>
    </div>
</nav>

<!-- Dashboard Heading -->

<div class="hero-section">
    <div class="container">

        <h1 class="fw-bold">
            Admin Dashboard
        </h1>

        <p class="lead">
            Manage languages, lessons, quizzes and learners from one place.
        </p>

    </div>
</div>


<!-- Dashboard Cards -->

<div class="container mt-5">

    <div class="row">

        <div class="col-md-3 mb-4">
            <div class="card shadow">
              <div class="card-body text-center">

    <div class="dashboard-icon bg-blue">
        <i class="bi bi-translate"></i>
    </div>

    <h4>Languages</h4>

    <p>Manage available languages for learners.</p>

    <a href="manage_languages.php" class="btn btn-primary">
        Manage
    </a>

</div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <div class="dashboard-icon bg-green">
    <i class="bi bi-journal-bookmark-fill"></i>
</div>
                    <h4>Lessons</h4>
                    <p>Add and update lessons.</p>
                    <a href="manage_lessons.php" class="btn btn-success">
                        Manage
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <div class="dashboard-icon bg-orange">
    <i class="bi bi-patch-question-fill"></i>
</div>
                    <h4>Quiz Questions</h4>
                    <p>Manage quiz questions.</p>
                    <a href="manage_questions.php" class="btn btn-warning">
                        Manage
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <div class="dashboard-icon bg-cyan">
    <i class="bi bi-people-fill"></i>
</div>
                    <h4>Users</h4>
                    <p>View registered users.</p>
                    <a href="manage_users.php" class="btn btn-info">
                        Manage
                    </a>
                </div>
            </div>
        </div>
         <div class="col-md-3 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <div class="dashboard-icon bg-purple">
    <i class="bi bi-clipboard2-check-fill"></i>
</div>
                    <h4>Assessment Questions</h4>
                    <p>Add and manage final assessment quiz questions.</p>
                     <a href="manage_as_quest.php"
               class="btn btn-warning">

               Manage Assessment Questions

            </a>
                </div>
            </div>
        </div>
        

    </div>

  <!-- Statistics Section -->

<div class="section-space">

    <h2 class="stats-title text-center mb-5">
        Platform Statistics
    </h2>

    <div class="row g-4">

        <!-- Total Languages -->

        <div class="col-md-4">

            <?php
            $q = mysqli_query($con,"SELECT COUNT(*) AS total FROM languages");
            $data = mysqli_fetch_assoc($q);
            ?>

            <div class="stats-card stat-primary text-center shadow">

                <div class="mb-3">
                    <i class="bi bi-translate" style="font-size:50px;"></i>
                </div>

                <div class="stats-number">
                    <?php echo $data['total']; ?>
                </div>

                <div class="stats-label">
                    Total Languages
                </div>

            </div>

        </div>

        <!-- Total Lessons -->

        <div class="col-md-4">

            <?php
            $q = mysqli_query($con,"SELECT COUNT(*) AS total FROM lessons");
            $data = mysqli_fetch_assoc($q);
            ?>

            <div class="stats-card stat-success text-center shadow">

                <div class="mb-3">
                    <i class="bi bi-journal-bookmark-fill" style="font-size:50px;"></i>
                </div>

                <div class="stats-number">
                    <?php echo $data['total']; ?>
                </div>

                <div class="stats-label">
                    Total Lessons
                </div>

            </div>

        </div>

        <!-- Total Users -->

        <div class="col-md-4">

            <?php
            $q = mysqli_query($con,"SELECT COUNT(*) AS total FROM users");
            $data = mysqli_fetch_assoc($q);
            ?>

            <div class="stats-card stat-danger text-center shadow">

                <div class="mb-3">
                    <i class="bi bi-people-fill" style="font-size:50px;"></i>
                </div>

                <div class="stats-number">
                    <?php echo $data['total']; ?>
                </div>

                <div class="stats-label">
                    Total Users
                </div>

            </div>

        </div>

    </div>

</div>
<!-- Recent Activity -->


               


            </table>

        </div>

    </div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>