<?php
session_start();
include '../includes/db.php';

/*
if(!isset($_SESSION['user_id'])){
    header("Location: ../index.php");
    exit();
}
*/

$query = mysqli_query($con, "SELECT * FROM languages");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Languages</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f8f9fa;
        }

        .language-card{
            transition:0.3s;
        }

        .language-card:hover{
            transform:translateY(-5px);
        }
    </style>
</head>
<body>

<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="../dashboard.php">
            Language Learning
        </a>

        <a href="../logout.php" class="btn btn-light">
            Logout
        </a>
    </div>
</nav>

<!-- Page Title -->

<div class="container mt-5">

    <h2 class="text-center mb-4">
        Select a Language
    </h2>

    <div class="row">

        <?php
        if(mysqli_num_rows($query) > 0)
        {
            while($language = mysqli_fetch_assoc($query))
            {
        ?>

        <div class="col-md-4 mb-4">

            <div class="card language-card shadow h-100">

                <div class="card-body text-center">

                    <h3>
                        <?php echo htmlspecialchars($language['language_name']); ?>
                    </h3>

                    <p>
                        <?php echo htmlspecialchars($language['description']); ?>
                    </p>

                    <a href="lesson_details.php?language_id=<?php echo $language['language_id']; ?>"
                       class="btn btn-primary">
                        Start Learning
                    </a>

                      <a href="lesson_list.php?language_id=<?php echo $language['language_id']; ?>"
   class="btn btn-info">
   View Lessons
</a>
                </div>

            </div>

        </div>

        <?php
            }
        }
        else
        {
            echo "<h4 class='text-center'>No Languages Found</h4>";
        }
        ?>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>