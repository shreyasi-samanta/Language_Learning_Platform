<?php
session_start();
include '../includes/db.php';

$answers = $_POST['answer'];

$score = 0;
$total_questions = 0;

foreach($answers as $question_id => $user_answer)
{
    $question_id = (int)$question_id;

    $query = mysqli_query($con,
    "SELECT correct_answer
     FROM assessment_questions
     WHERE question_id = $question_id");

    $row = mysqli_fetch_assoc($query);

    $total_questions++;

    if($user_answer == $row['correct_answer'])
    {
        $score++;
    }
}

$_SESSION['quiz_score'] = $score;
$_SESSION['total_questions'] = $total_questions;

header("Location: result.php");
exit();
?>