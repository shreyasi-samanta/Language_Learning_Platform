<?php
session_start();
include '../includes/db.php';

$query = mysqli_query($con,
"SELECT leaderboard.total_score,
        users.name
 FROM leaderboard
 INNER JOIN users
 ON leaderboard.user_id = users.user_id
 ORDER BY leaderboard.total_score DESC");
?>

<!DOCTYPE html>
<html>
<head>

<title>Leaderboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2 class="mb-4">
Leaderboard
</h2>

<a href="user_dashboard.php"
class="btn btn-secondary mb-3">
Back Dashboard
</a>

<table class="table table-bordered table-hover">

<tr>

<th>Rank</th>
<th>Name</th>
<th>Total Score</th>

</tr>

<?php

$rank = 1;

if(mysqli_num_rows($query) > 0)
{
    while($row = mysqli_fetch_assoc($query))
    {
?>

<tr>

<td>
<?php echo $rank++; ?>
</td>

<td>
<?php echo htmlspecialchars($row['name']); ?>
</td>

<td>
<?php echo $row['total_score']; ?>
</td>

</tr>

<?php
    }
}
else
{
?>

<tr>

<td colspan="3"
class="text-center">

No Records Found

</td>

</tr>

<?php
}
?>

</table>

</div>

</body>
</html>