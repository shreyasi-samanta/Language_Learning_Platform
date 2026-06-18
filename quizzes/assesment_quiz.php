<?php
session_start();
include '../includes/db.php';

$questions = mysqli_query($con,
"SELECT * FROM assessment_questions ORDER BY question_id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Assessment Quiz</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4">Final Assessment Quiz</h2>

    <form action="submit_assessment.php" method="POST">

    <?php
    $count = 1;

    while($row = mysqli_fetch_assoc($questions))
    {
    ?>

    <div class="card mb-3">

        <div class="card-body">

            <h5>
                Q<?php echo $count++; ?>.
                <?php echo htmlspecialchars($row['question']); ?>
            </h5>

            <div class="form-check">
                <input class="form-check-input"
                       type="radio"
                       name="answer[<?php echo $row['question_id']; ?>]"
                       value="A">

                <label class="form-check-label">
                    <?php echo htmlspecialchars($row['option_a']); ?>
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input"
                       type="radio"
                       name="answer[<?php echo $row['question_id']; ?>]"
                       value="B">

                <label class="form-check-label">
                    <?php echo htmlspecialchars($row['option_b']); ?>
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input"
                       type="radio"
                       name="answer[<?php echo $row['question_id']; ?>]"
                       value="C">

                <label class="form-check-label">
                    <?php echo htmlspecialchars($row['option_c']); ?>
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input"
                       type="radio"
                       name="answer[<?php echo $row['question_id']; ?>]"
                       value="D">

                <label class="form-check-label">
                    <?php echo htmlspecialchars($row['option_d']); ?>
                </label>
            </div>

        </div>

    </div>

    <?php } ?>

    <button type="submit"
            class="btn btn-success">
        Submit Assessment
    </button>

    </form>

</div>

</body>
</html>