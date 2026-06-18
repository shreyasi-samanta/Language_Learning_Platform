<?php
session_start();
include '../includes/db.php';

/* ADD QUESTION */

if(isset($_POST['add_question']))
{
    $question = mysqli_real_escape_string($conn,$_POST['question']);

    $option_a = mysqli_real_escape_string($conn,$_POST['option_a']);
    $option_b = mysqli_real_escape_string($conn,$_POST['option_b']);
    $option_c = mysqli_real_escape_string($conn,$_POST['option_c']);
    $option_d = mysqli_real_escape_string($conn,$_POST['option_d']);

    $correct_answer = $_POST['correct_answer'];

    mysqli_query($conn,
    "INSERT INTO assessment_questions
    (question,option_a,option_b,option_c,option_d,correct_answer)
    VALUES
    ('$question','$option_a','$option_b','$option_c','$option_d','$correct_answer')");
}

/* DELETE QUESTION */

if(isset($_GET['delete']))
{
    $id = (int)$_GET['delete'];

    mysqli_query($conn,
    "DELETE FROM assessment_questions
     WHERE question_id = $id");
}

$questions = mysqli_query($conn,
"SELECT * FROM assessment_questions
 ORDER BY question_id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Assessment Questions</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4">
        Manage Assessment Questions
    </h2>

    <!-- Add Question Form -->

    <div class="card mb-4">

        <div class="card-header">
            Add Assessment Question
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label>Question</label>
                    <textarea
                    name="question"
                    class="form-control"
                    required></textarea>
                </div>

                <div class="mb-3">
                    <label>Option A</label>
                    <input type="text"
                           name="option_a"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Option B</label>
                    <input type="text"
                           name="option_b"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Option C</label>
                    <input type="text"
                           name="option_c"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Option D</label>
                    <input type="text"
                           name="option_d"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Correct Answer</label>

                    <select
                    name="correct_answer"
                    class="form-control">

                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>

                    </select>
                </div>

                <button
                type="submit"
                name="add_question"
                class="btn btn-primary">

                    Add Question

                </button>

            </form>

        </div>

    </div>

    <!-- Question List -->

    <table class="table table-bordered">

        <thead class="table-dark">

            <tr>

                <th>ID</th>
                <th>Question</th>
                <th>Correct Answer</th>
                <th>Action</th>

            </tr>

        </thead>

        <tbody>

        <?php while($row = mysqli_fetch_assoc($questions)){ ?>

            <tr>

                <td>
                    <?php echo $row['question_id']; ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['question']); ?>
                </td>

                <td>
                    <?php echo $row['correct_answer']; ?>
                </td>

                <td>

                    <a href="?delete=<?php echo $row['question_id']; ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete this question?')">

                        Delete

                    </a>

                </td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

</body>
</html>