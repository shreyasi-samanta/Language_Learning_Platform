<?php
session_start();
include '../includes/db.php';

/* DELETE USER */

if(isset($_GET['delete']))
{
    $id = (int)$_GET['delete'];

    mysqli_query($con,
    "DELETE FROM users WHERE user_id = $id");
}

/* FETCH USERS */

$users = mysqli_query($con,
"SELECT * FROM users ORDER BY user_id DESC");
?>

<!DOCTYPE html>
<html>
<head>

<title>Manage Users</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

<h2>Manage Users</h2>

<table class="table table-bordered table-hover">

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Created At</th>
<th>Action</th>
</tr>

<?php

if(mysqli_num_rows($users)>0)
{
    while($row=mysqli_fetch_assoc($users))
    {
?>

<tr>

<td>
<?= $row['user_id']; ?>
</td>

<td>
<?= $row['name']; ?>
</td>

<td>
<?= $row['email']; ?>
</td>

<td>
<?= $row['role']; ?>
</td>

<td>
<?= $row['created_at']; ?>
</td>

<td>

<a href="?delete=<?= $row['user_id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete User?')">

Delete

</a>

</td>

</tr>

<?php
    }
}
else
{
?>

<tr>
<td colspan="6" class="text-center">
No Users Found
</td>
</tr>

<?php
}
?>

</table>

</div>

</body>
</html>