<?php
session_start();
include '../includes/db.php';

if(!isset($_GET['language_id']))
{
    die("Language not selected.");
}

$language_id = (int)$_GET['language_id'];

$language_query = mysqli_query($con,
"SELECT * FROM languages WHERE language_id = $language_id");

$language = mysqli_fetch_assoc($language_query);

$questions = mysqli_query($con,
"SELECT * FROM quiz_questions
 WHERE language_id = $language_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Quiz</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

<h2 class="mb-4">
<?php echo $language['language_name']; ?> Quiz
</h2>

<form action="submit_quiz.php" method="POST">

<input type="hidden"
       name="language_id"
       value="<?php echo $language_id; ?>">

<?php

$count = 1;

while($row = mysqli_fetch_assoc($questions))
{
?>

<div class="card mb-4">

<div class="card-body">

<h5>
Q<?php echo $count++; ?>.
<?php echo htmlspecialchars($row['question']); ?>
</h5>

<input type="hidden"
       name="question_ids[]"
       value="<?php echo $row['question_id']; ?>">

<div class="form-check mt-3">

<input class="form-check-input"
       type="radio"
       name="answer[<?php echo $row['question_id']; ?>]"
       value="A">

<label class="form-check-label">
A. <?php echo htmlspecialchars($row['option_a']); ?>
</label>

</div>

<div class="form-check">

<input class="form-check-input"
       type="radio"
       name="answer[<?php echo $row['question_id']; ?>]"
       value="B">

<label class="form-check-label">
B. <?php echo htmlspecialchars($row['option_b']); ?>
</label>

</div>

<div class="form-check">

<input class="form-check-input"
       type="radio"
       name="answer[<?php echo $row['question_id']; ?>]"
       value="C">

<label class="form-check-label">
C. <?php echo htmlspecialchars($row['option_c']); ?>
</label>

</div>

<div class="form-check">

<input class="form-check-input"
       type="radio"
       name="answer[<?php echo $row['question_id']; ?>]"
       value="D">

<label class="form-check-label">
D. <?php echo htmlspecialchars($row['option_d']); ?>
</label>

</div>

</div>
</div>

<?php
}
?>

<button type="submit"
        class="btn btn-success">
Submit Quiz
</button>

</form>

</div>

</body>
</html>