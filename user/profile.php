<?php
session_start();
include '../includes/db.php';

if(!isset($_SESSION['user_id']))
{
    header("Location: ../index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$user_query = mysqli_query($conn,
"SELECT * FROM users
 WHERE user_id = $user_id");

$user = mysqli_fetch_assoc($user_query);

/* Total Quiz Attempts */

$attempts_query = mysqli_query($conn,
"SELECT COUNT(*) AS total_attempts
 FROM quiz_results
 WHERE user_id = $user_id");

$attempts = mysqli_fetch_assoc($attempts_query);

/* Total Score */

$score_query = mysqli_query($conn,
"SELECT SUM(score) AS total_score
 FROM quiz_results
 WHERE user_id = $user_id");

$score = mysqli_fetch_assoc($score_query);
?>

<!DOCTYPE html>
<html>
<head>

<title>My Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>My Profile</h3>

</div>

<div class="card-body">

<table class="table">

<tr>
    <th>Username</th>
    <td><?php echo $user['username']; ?></td>
</tr>

<tr>
    <th>Email</th>
    <td><?php echo $user['email']; ?></td>
</tr>

<tr>
    <th>Role</th>
    <td><?php echo ucfirst($user['role']); ?></td>
</tr>

<tr>
    <th>Total Quiz Attempts</th>
    <td><?php echo $attempts['total_attempts']; ?></td>
</tr>

<tr>
    <th>Total Score</th>
    <td>
        <?php echo ($score['total_score'] ?? 0); ?>
    </td>
</tr>

</table>

<a href="user_dashboard.php"
   class="btn btn-secondary">

   Back Dashboard

</a>

</div>

</div>

</div>

</body>
</html>