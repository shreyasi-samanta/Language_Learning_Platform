<?php
include '../includes/db.php';

$id = $_GET['id'];

$result = mysqli_query($con,
"SELECT * FROM lessons WHERE lesson_id = $id");

$lesson = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $title = $_POST['lesson_title'];
    $content = $_POST['content'];

    mysqli_query($con,
    "UPDATE lessons
     SET lesson_title='$title',
         content='$content'
     WHERE lesson_id=$id");

    header("Location: manage_lessons.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Lesson</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Edit Lesson</h2>

<form method="POST">

    <div class="mb-3">
        <label>Lesson Title</label>
        <input type="text"
               name="lesson_title"
               class="form-control"
               value="<?php echo $lesson['lesson_title']; ?>">
    </div>

    <div class="mb-3">
        <label>Content</label>
        <textarea
            name="content"
            class="form-control"
            rows="6"><?php echo $lesson['content']; ?></textarea>
    </div>

    <button type="submit"
            name="update"
            class="btn btn-success">
        Update Lesson
    </button>

</form>

</div>

</body>
</html>