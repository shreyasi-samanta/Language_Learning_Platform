<?php
session_start();
include '../includes/db.php';

$languages = mysqli_query($con,
"SELECT * FROM languages ORDER BY language_name ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>All Lessons</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.language-card{
    margin-bottom:25px;
}

.lesson-item{
    padding:10px;
    border-bottom:1px solid #eee;
}
</style>

</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4 text-center">
        Available Lessons
    </h2>

    <?php
    while($language = mysqli_fetch_assoc($languages))
    {
    ?>

    <div class="card language-card shadow">

        <div class="card-header bg-primary text-white">

            <h4 class="mb-0">
                <?php echo htmlspecialchars($language['language_name']); ?>
            </h4>

        </div>

        <div class="card-body">

        <?php

        $language_id = $language['language_id'];

        $lessons = mysqli_query($con,
        "SELECT *
         FROM lessons
         WHERE language_id = $language_id
         ORDER BY lesson_id ASC");

        if(mysqli_num_rows($lessons) > 0)
        {
            while($lesson = mysqli_fetch_assoc($lessons))
            {
        ?>

            <div class="lesson-item">

                <h5>
                    <?php echo htmlspecialchars($lesson['lesson_title']); ?>
                </h5>

                <span class="badge bg-success">
                    <?php echo htmlspecialchars($lesson['lesson_type']); ?>
                </span>

            </div>

        <?php
            }
        }
        else
        {
            echo "<p>No lessons available.</p>";
        }
        ?>

        <div class="mt-3">

            <a href="lesson_details.php?language_id=<?php echo $language_id; ?>"
               class="btn btn-primary">

               View Full Lessons

            </a>

        </div>

        </div>

    </div>

    <?php
    }
    ?>

</div>

</body>
</html>