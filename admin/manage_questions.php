<?php
session_start();
include '../includes/db.php';

/* ADD QUESTION */

if(isset($_POST['add_question']))
{
    $language_id = $_POST['language_id'];
    $question = mysqli_real_escape_string($con,$_POST['question']);
    $option_a = mysqli_real_escape_string($con,$_POST['option_a']);
    $option_b = mysqli_real_escape_string($con,$_POST['option_b']);
    $option_c = mysqli_real_escape_string($con,$_POST['option_c']);
    $option_d = mysqli_real_escape_string($con,$_POST['option_d']);
    $correct_answer = $_POST['correct_answer'];

    $sql = "INSERT INTO quiz_questions
    (language_id,question,option_a,option_b,option_c,option_d,correct_answer)
    VALUES
    ('$language_id','$question','$option_a','$option_b','$option_c','$option_d','$correct_answer')";

    mysqli_query($con,$sql);
}

/* DELETE QUESTION */

if(isset($_GET['delete']))
{
    $id = (int)$_GET['delete'];

    mysqli_query($con,
    "DELETE FROM quiz_questions WHERE question_id=$id");
}

/* FETCH LANGUAGES */

$languages = mysqli_query($con,
"SELECT * FROM languages");

/* FETCH QUESTIONS */

$questions = mysqli_query($con,
"SELECT quiz_questions.*,languages.language_name
FROM quiz_questions
INNER JOIN languages
ON quiz_questions.language_id = languages.language_id
ORDER BY question_id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Questions</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Manage Quiz Questions</h2>

<div class="card mt-4 mb-5">
<div class="card-header bg-primary text-white">
Add Question
</div>

<div class="card-body">

<form method="POST">

<select name="language_id" class="form-control mb-3" required>

<option value="">Select Language</option>

<?php
while($lang=mysqli_fetch_assoc($languages))
{
?>
<option value="<?= $lang['language_id']; ?>">
<?= $lang['language_name']; ?>
</option>
<?php
}
?>

</select>

<input type="text"
name="question"
class="form-control mb-3"
placeholder="Question"
required>

<input type="text"
name="option_a"
class="form-control mb-3"
placeholder="Option A"
required>

<input type="text"
name="option_b"
class="form-control mb-3"
placeholder="Option B"
required>

<input type="text"
name="option_c"
class="form-control mb-3"
placeholder="Option C"
required>

<input type="text"
name="option_d"
class="form-control mb-3"
placeholder="Option D"
required>

<select name="correct_answer"
class="form-control mb-3"
required>

<option value="">Correct Answer</option>
<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
<option value="D">D</option>

</select>

<button
type="submit"
name="add_question"
class="btn btn-success">
Add Question
</button>

</form>

</div>
</div>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Language</th>
<th>Question</th>
<th>Correct Answer</th>
<th>Action</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($questions))
{
?>

<tr>

<td><?= $row['question_id']; ?></td>

<td><?= $row['language_name']; ?></td>

<td><?= $row['question']; ?></td>

<td><?= $row['correct_answer']; ?></td>

<td>

<a href="?delete=<?= $row['question_id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete Question?')">

Delete

</a>

</td>

</tr>

<?php
}
?>

</table>

</div>

</body>
</html>