<?php
session_start();
include '../includes/db.php';

/*
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: ../index.php");
    exit();
}
*/

/* ADD LANGUAGE */

if(isset($_POST['add_language']))
{
    $language_name = mysqli_real_escape_string($con, $_POST['language_name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);

    $sql = "INSERT INTO languages(language_name, description)
            VALUES('$language_name', '$description')";

    mysqli_query($con, $sql);
}

/* DELETE LANGUAGE */

if(isset($_GET['delete']))
{
    $id = (int)$_GET['delete'];

    mysqli_query($con,
        "DELETE FROM languages WHERE language_id = $id");
}

/* FETCH LANGUAGES */

$languages = mysqli_query($con,
            "SELECT * FROM languages ORDER BY language_id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Languages</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.card{
    border:none;
}

</style>

</head>
<body>

<!-- NAVBAR -->

<nav class="navbar navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand"
           href="admin_dashboard.php">
            Admin Panel
        </a>

        <a href="../logout.php"
           class="btn btn-danger">
            Logout
        </a>

    </div>
</nav>

<div class="container mt-5">

    <h2 class="mb-4">
        Manage Languages
    </h2>

    <!-- ADD FORM -->

    <div class="card shadow mb-5">

        <div class="card-header bg-primary text-white">
            Add New Language
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Language Name
                    </label>

                    <input type="text"
                           name="language_name"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="3"
                        required></textarea>

                </div>

                <button type="submit"
                        name="add_language"
                        class="btn btn-success">

                    Add Language

                </button>

            </form>

        </div>

    </div>

    <!-- LANGUAGE TABLE -->

    <div class="card shadow">

        <div class="card-header bg-secondary text-white">
            Available Languages
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead>

                <tr>
                    <th>ID</th>
                    <th>Language</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>

                </thead>

                <tbody>

                <?php
                if(mysqli_num_rows($languages) > 0)
                {
                    while($row = mysqli_fetch_assoc($languages))
                    {
                ?>

                <tr>

                    <td>
                        <?php echo $row['language_id']; ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['language_name']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['description']); ?>
                    </td>

                    <td>

                        <a href="?delete=<?php echo $row['language_id']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Delete this language?')">

                            Delete

                        </a>

                    </td>

                </tr>

                <?php
                    }
                }
                else
                {
                    echo "
                    <tr>
                        <td colspan='4' class='text-center'>
                            No Languages Found
                        </td>
                    </tr>";
                }
                ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>