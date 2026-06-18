<?php
session_start();
include '../includes/db.php';

$user_id = $_SESSION['user_id'] ?? 0;

$query = mysqli_query($con,
"SELECT progress.*,
        lessons.lesson_title
 FROM progress
 INNER JOIN lessons
 ON progress.lesson_id = lessons.lesson_id
 WHERE progress.user_id = '$user_id'
 ORDER BY progress.progress_id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>My Progress</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<h2 class="mb-4">My Learning Progress</h2>

<a href="user_dashboard.php"
class="btn btn-secondary mb-3">
Back Dashboard
</a>

<table class="table table-bordered table-hover">

<tr>
<th>Lesson</th>
<th>Status</th>
<th>Completion Date</th>
</tr>

<?php

if(mysqli_num_rows($query) > 0)
{
    while($row = mysqli_fetch_assoc($query))
    {
?>

<tr>

<td>
<?php echo $row['lesson_title']; ?>
</td>

<td>

<?php
if($row['status']=="Completed")
{
    echo "<span class='badge bg-success'>Completed</span>";
}
else
{
    echo "<span class='badge bg-warning'>Pending</span>";
}
?>

</td>

<td>
<?php echo $row['completion_date']; ?>
</td>

</tr>

<?php
    }
}
else
{
?>

<tr>
<td colspan="3" class="text-center">
No Progress Found
</td>
</tr>

<?php
}
?>

</table>

</div>

</body>
</html>