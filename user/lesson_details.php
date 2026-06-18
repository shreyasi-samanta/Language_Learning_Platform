<?php
session_start();
include '../includes/db.php';

if(!isset($_GET['language_id']))
{
    die("Language not selected");
}

$language_id = (int)$_GET['language_id'];

$language_query = mysqli_query($con,
"SELECT * FROM languages
 WHERE language_id = $language_id");

$language = mysqli_fetch_assoc($language_query);

$lessons = mysqli_query($con,
"SELECT *
 FROM lessons
 WHERE language_id = $language_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lesson Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>
        <?php echo $language['language_name']; ?> Lessons
    </h2>

    <hr>

    <?php

    if(mysqli_num_rows($lessons) > 0)
    {
        while($lesson = mysqli_fetch_assoc($lessons))
        {
    ?>

        <div class="card mb-4 shadow">

            <div class="card-body">

                <h4>
                    <?php echo $lesson['lesson_title']; ?>
                </h4>

                <span class="badge bg-primary">
                    <?php echo $lesson['lesson_type']; ?>
                </span>

                <hr>

                <p>
                    <?php echo nl2br($lesson['content']); ?>
                </p>

            </div>

        </div>

    <?php
        }
    }
    else
    {
        echo "<div class='alert alert-warning'>
                No lessons available.
              </div>";
    }
    ?>

    <div class="text-center">

        <a href="../quizzes/quiz.php?language_id=<?php echo $language_id; ?>"
           class="btn btn-success btn-lg">

            Start Quiz

        </a>

    </div>

</div>

</body>
</html>