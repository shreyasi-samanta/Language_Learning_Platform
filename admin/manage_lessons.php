<?php
session_start();
include '../includes/db.php';

/*
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: ../index.php");
    exit();
}
*/

/* ADD LESSON */

if(isset($_POST['add_lesson']))
{
    $language_id = $_POST['language_id'];
    $lesson_title = mysqli_real_escape_string($con, $_POST['lesson_title']);
    $lesson_type = mysqli_real_escape_string($con, $_POST['lesson_type']);
    $content = mysqli_real_escape_string($con, $_POST['content']);

    $sql = "INSERT INTO lessons
            (language_id, lesson_title, lesson_type, content)
            VALUES
            ('$language_id', '$lesson_title', '$lesson_type', '$content')";

    mysqli_query($con, $sql);
}

/* DELETE LESSON */

if(isset($_GET['delete']))
{
    $lesson_id = (int)$_GET['delete'];

    mysqli_query($conn,
        "DELETE FROM lessons WHERE lesson_id = $lesson_id");
}

/* FETCH LANGUAGES */

$languages = mysqli_query($con,
            "SELECT * FROM languages");

/* FETCH LESSONS */

$lessons = mysqli_query($con,
"
SELECT lessons.*,
       languages.language_name
FROM lessons
INNER JOIN languages
ON lessons.language_id = languages.language_id
ORDER BY lesson_id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Lessons</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f4f6f9;
}
</style>

</head>
<body>

<!-- NAVBAR -->

<nav class="navbar navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand"
           href="admin_dashboard.php">
            Admin Panel
        </a>

        <a href="../logout.php"
           class="btn btn-danger">
            Logout
        </a>

    </div>
</nav>

<div class="container mt-5">

    <h2 class="mb-4">
        Manage Lessons
    </h2>

    <!-- ADD LESSON FORM -->

    <div class="card shadow mb-5">

        <div class="card-header bg-primary text-white">
            Add New Lesson
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Select Language
                    </label>

                    <select name="language_id"
                            class="form-control"
                            required>

                        <option value="">
                            Choose Language
                        </option>

                        <?php
                        mysqli_data_seek($languages,0);

                        while($lang = mysqli_fetch_assoc($languages))
                        {
                        ?>

                        <option value="<?php echo $lang['language_id']; ?>">
                            <?php echo $lang['language_name']; ?>
                        </option>

                        <?php
                        }
                        ?>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Lesson Title
                    </label>

                    <input type="text"
                           name="lesson_title"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Lesson Type
                    </label>

                    <select name="lesson_type"
                            class="form-control"
                            required>

                        <option value="">
                            Select Type
                        </option>

                        <option value="Vocabulary">
                            Vocabulary
                        </option>

                        <option value="Grammar">
                            Grammar
                        </option>

                        <option value="Reading">
                            Reading
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Lesson Content
                    </label>

                    <textarea
                        name="content"
                        rows="6"
                        class="form-control"
                        required></textarea>

                </div>

                <button type="submit"
                        name="add_lesson"
                        class="btn btn-success">

                    Add Lesson

                </button>

            </form>

        </div>

    </div>

    <!-- LESSON TABLE -->

    <div class="card shadow">

        <div class="card-header bg-secondary text-white">
            All Lessons
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead>

                <tr>
                    <th>ID</th>
                    <th>Language</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Content</th>
                    <th>Action</th>
                </tr>

                </thead>

                <tbody>

                <?php
                if(mysqli_num_rows($lessons) > 0)
                {
                    while($row = mysqli_fetch_assoc($lessons))
                    {
                ?>

                <tr>

                    <td>
                        <?php echo $row['lesson_id']; ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['language_name']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['lesson_title']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['lesson_type']); ?>
                    </td>

                    <td>
                        <?php echo substr(
                            htmlspecialchars($row['content']),
                            0,
                            80
                        ); ?>...
                    </td>

                    <td>
                 <a href="edit_lesson.php?id=<?php echo $row['lesson_id']; ?>"
       class="btn btn-warning btn-sm">
        Edit
    </a>
                        <a href="?delete=<?php echo $row['lesson_id']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Delete this lesson?')">

                            Delete

                        </a>

                    </td>

                </tr>

                <?php
                    }
                }
                else
                {
                    echo "
                    <tr>
                        <td colspan='6' class='text-center'>
                            No Lessons Found
                        </td>
                    </tr>";
                }
                ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>