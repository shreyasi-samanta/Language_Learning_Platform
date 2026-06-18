<?php
session_start();
include '../includes/db.php';
include '../includes/sidebar.php';

/*
if(!isset($_SESSION['user_id'])){
    header("Location: ../index.php");
    exit();
}

if($_SESSION['role'] != 'user'){
    header("Location: ../admin/admin_dashboard.php");
    exit();
}
*/

$user_name = $_SESSION['name'] ?? "Student";

/* Total Languages */
$lang_query = mysqli_query($con,
"SELECT COUNT(*) AS total FROM languages");
$lang_data = mysqli_fetch_assoc($lang_query);

/* Total Lessons */
$lesson_query = mysqli_query($con,
"SELECT COUNT(*) AS total FROM lessons");
$lesson_data = mysqli_fetch_assoc($lesson_query);

/* Quiz Attempts */
$user_id = $_SESSION['user_id'] ?? 0;

$quiz_query = mysqli_query($con,
"SELECT COUNT(*) AS total
 FROM quiz_results
 WHERE user_id='$user_id'");

$quiz_data = mysqli_fetch_assoc($quiz_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>User Dashboard</title>
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f7fc;
    font-family:'Segoe UI',sans-serif;
}

/* Sidebar Space */
.main-content{
    margin-left:260px;
}

/* Welcome Banner */

.welcome-banner{
    background:linear-gradient(135deg,#0d6efd,#5b9cff);
    color:white;
    padding:40px;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

/* Stats Cards */

.stats-card{
    border:none;
    border-radius:18px;
    overflow:hidden;
    transition:.3s;
}

.stats-card:hover{
    transform:translateY(-8px);
}

.stats-icon{
    font-size:35px;
    margin-bottom:10px;
}

/* Feature Cards */

.feature-card{
    border:none;
    border-radius:18px;
    transition:.3s;
}

.feature-card:hover{
    transform:translateY(-8px);
    box-shadow:0 8px 25px rgba(0,0,0,0.1);
}

.feature-icon{
    font-size:45px;
    margin-bottom:15px;
    color:#0d6efd;
}

/* Progress Section */

.progress-card{
    border:none;
    border-radius:18px;
}

/* Footer */

footer{
    margin-top:50px;
}
</style>

</head>
<body>
    <?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<div class="container-fluid p-4">

    <!-- Top Navbar -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>
            Welcome,
            <?php echo htmlspecialchars($user_name); ?>
        </h3>

        <a href="../pages/logout.php"
           class="btn btn-danger">
            Logout
        </a>

    </div>

    <!-- Welcome Banner -->

    <div class="welcome-banner mb-5">

        <h1>Continue Your Learning Journey 🚀</h1>

        <p class="mb-0">
            Learn new languages, practice quizzes, and track your achievements.
        </p>

    </div>

    <!-- Statistics -->

    <div class="row mb-5">

        <div class="col-md-4">

            <div class="card stats-card shadow">

                <div class="card-body text-center">

                    <div class="stats-icon">
                        <i class="bi bi-translate"></i>
                    </div>

                    <h5>Total Languages</h5>

                    <h2>
                        <?php echo $lang_data['total']; ?>
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card stats-card shadow">

                <div class="card-body text-center">

                    <div class="stats-icon">
                        <i class="bi bi-book"></i>
                    </div>

                    <h5>Total Lessons</h5>

                    <h2>
                        <?php echo $lesson_data['total']; ?>
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card stats-card shadow">

                <div class="card-body text-center">

                    <div class="stats-icon">
                        <i class="bi bi-patch-question"></i>
                    </div>

                    <h5>Quiz Attempts</h5>

                    <h2>
                        <?php echo $quiz_data['total']; ?>
                    </h2>

                </div>

            </div>

        </div>

    </div>

    <!-- Learning Center -->

    <h3 class="mb-4">
        Learning Center
    </h3>

    <div class="row">

        <div class="col-md-3 mb-4">

            <div class="card feature-card shadow h-100">

                <div class="card-body text-center">

                    <div class="feature-icon">
                        <i class="bi bi-globe"></i>
                    </div>

                    <h4>Languages</h4>

                    <p>
                        Explore available languages and start learning.
                    </p>

                    <a href="languages.php"
                       class="btn btn-primary">
                        Explore
                    </a>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card feature-card shadow h-100">

                <div class="card-body text-center">

                    <div class="feature-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>

                    <h4>Progress</h4>

                    <p>
                        Monitor lesson completion and quiz performance.
                    </p>

                    <a href="progress.php"
                       class="btn btn-success">
                        View
                    </a>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card feature-card shadow h-100">

                <div class="card-body text-center">

                    <div class="feature-icon">
                        <i class="bi bi-trophy"></i>
                    </div>

                    <h4>Leaderboard</h4>

                    <p>
                        Compare your performance with other learners.
                    </p>

                    <a href="leaderboard.php"
                       class="btn btn-warning">
                        View
                    </a>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card feature-card shadow h-100">

                <div class="card-body text-center">

                    <div class="feature-icon">
                        <i class="bi bi-clipboard-check"></i>
                    </div>

                    <h4>Assessment Quiz</h4>

                    <p>
                        Take the final assessment and test your skills.
                    </p>

                    <a href="../quizzes/assesment_quiz.php"
                       class="btn btn-danger">

                        Start Quiz

                    </a>

                </div>

            </div>

        </div>

    </div>

    <!-- Progress Overview -->

    <div class="card progress-card shadow mt-4">

        <div class="card-body">

            <h4 class="mb-3">
                Learning Progress
            </h4>

            <p>Overall Completion</p>

            <div class="progress">

                <div class="progress-bar progress-bar-striped progress-bar-animated"
                     style="width:70%">

                    70%

                </div>

            </div>

        </div>

    </div>

</div>

<footer class="bg-dark text-white text-center p-3">

    © <?php echo date("Y"); ?>
    Language Learning Platform

</footer>

</div>
</body>
</html>