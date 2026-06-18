<?php
session_start();
include '../includes/db.php';

$user_id = $_SESSION['user_id'];

$language_id = $_POST['language_id'];

$answers = $_POST['answer'];

$score = 0;
$total_questions = 0;

foreach($answers as $question_id => $user_answer)
{
    $question_id = (int)$question_id;

    $query = mysqli_query($con,
    "SELECT correct_answer
     FROM quiz_questions
     WHERE question_id = $question_id");

    $row = mysqli_fetch_assoc($query);

    $correct_answer = $row['correct_answer'];

    $total_questions++;

    if($user_answer == $correct_answer)
    {
        $score++;
    }
}

/* SAVE QUIZ RESULT */

mysqli_query($con,
"INSERT INTO quiz_results
(user_id, language_id, score, total_questions)
VALUES
('$user_id','$language_id','$score','$total_questions')");

/* UPDATE LEADERBOARD */

$check = mysqli_query($con,
"SELECT * FROM leaderboard
 WHERE user_id = '$user_id'");

if(mysqli_num_rows($check) > 0)
{
    mysqli_query($con,
    "UPDATE leaderboard
     SET total_score = total_score + $score
     WHERE user_id = '$user_id'");
}
else
{
    mysqli_query($con,
    "INSERT INTO leaderboard(user_id,total_score)
     VALUES('$user_id','$score')");
}

/* STORE RESULT IN SESSION */

$_SESSION['quiz_score'] = $score;
$_SESSION['total_questions'] = $total_questions;

header("Location: result.php");
exit();
?>