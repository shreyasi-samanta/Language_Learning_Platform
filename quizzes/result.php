<?php
session_start();

if(!isset($_SESSION['quiz_score']))
{
    header("Location: ../index.php");
    exit();
}

$score = $_SESSION['quiz_score'];

$total = $_SESSION['total_questions'];

$percentage = ($score / $total) * 100;
?>

<!DOCTYPE html>
<html>
<head>

<title>Quiz Result</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>
Quiz Result
</h3>

</div>

<div class="card-body text-center">

<h2>
Your Score
</h2>

<h1 class="display-3">
<?php echo $score; ?>/<?php echo $total; ?>
</h1>

<h3>
Percentage:
<?php echo round($percentage,2); ?>%
</h3>

<?php

if($percentage >= 50)
{
    echo "<h4 class='text-success mt-3'>Passed 🎉</h4>";
}
else
{
    echo "<h4 class='text-danger mt-3'>Failed ❌</h4>";
}

?>

<a href="../user/user_dashboard.php"
class="btn btn-success mt-4">

Back To Dashboard

</a>

</div>

</div>

</div>

</body>
</html>