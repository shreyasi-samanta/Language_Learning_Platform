<?php
include './includes/db.php';
include './includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Language Learning Platform</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .hero{
            background: #f8f9fa;
            padding: 100px 0;
        }

        .feature-card{
            transition: 0.3s;
        }

        .feature-card:hover{
            transform: translateY(-5px);
        }
    </style>
</head>
<body>

<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            Language Learning
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

       
    </div>
</nav> 

<!-- Hero Section -->

<section class="hero text-center">
    <div class="container">

        <h1 class="display-4 fw-bold">
            Learn Languages Easily
        </h1>

        <p class="lead mt-3">
            Improve your vocabulary, grammar, and communication skills through interactive lessons and quizzes.
        </p>

        <a href="register.php" class="btn btn-primary btn-lg mt-3">
            Get Started
        </a>

    </div>
</section>

<!-- Features -->

<section class="py-5">
    <div class="container">

        <h2 class="text-center mb-5">
            Platform Features
        </h2>

        <div class="row">

            <div class="col-md-3 mb-4">
                <div class="card feature-card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h4>Languages</h4>
                        <p>
                            Choose from multiple languages and start learning.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card feature-card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h4>Lessons</h4>
                        <p>
                            Study vocabulary and grammar lessons.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card feature-card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h4>Quizzes</h4>
                        <p>
                            Test your knowledge through interactive quizzes.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card feature-card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h4>Leaderboard</h4>
                        <p>
                            Compare scores and compete with other learners.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- About -->

<section class="bg-light py-5">
    <div class="container text-center">

        <h2>About Us</h2>

        <p class="mt-3">
            Our Language Learning Platform helps students learn new languages through structured lessons, vocabulary exercises, grammar practice, quizzes, and progress tracking.
        </p>

    </div>
</section>

<!-- Footer -->

<footer class="bg-dark text-white text-center py-3">
    <p class="mb-0">
        © <?php echo date("Y"); ?> Language Learning Platform. All Rights Reserved.
    </p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>