<?php
session_start();
include '../includes/db.php';

/*
if(!isset($_SESSION['user_id'])){
    header("Location: ../index.php");
    exit();
}
*/

$user_id = $_SESSION['user_id'] ?? 0;

/* User Details */

$user_query = mysqli_query($con,
"SELECT * FROM users WHERE user_id = '$user_id'");

$user = mysqli_fetch_assoc($user_query);

/* Upload Photo */

if(isset($_POST['upload_photo']))
{
    if(!empty($_FILES['profile_image']['name']))
    {
        $filename = time() . "_" . $_FILES['profile_image']['name'];

        $target =
        "../uploads/profiles/" . $filename;

        move_uploaded_file(
            $_FILES['profile_image']['tmp_name'],
            $target
        );

        mysqli_query($con,
        "UPDATE users
         SET profile_image='$filename'
         WHERE user_id='$user_id'");

        header("Location: profile.php");
        exit();
    }
}

/* Quiz Attempts */

$quiz_query = mysqli_query($con,
"SELECT COUNT(*) AS total
 FROM quiz_results
 WHERE user_id='$user_id'");

$quiz_data = mysqli_fetch_assoc($quiz_query);

/* Lessons */

$lesson_query = mysqli_query($con,
"SELECT COUNT(*) AS total
 FROM lessons");

$lesson_data = mysqli_fetch_assoc($lesson_query);

/* Progress Percentage */

$progress = 0;

if($lesson_data['total'] > 0)
{
    $progress =
    min(
        round(($quiz_data['total'] / $lesson_data['total']) * 100),
        100
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f7fc;
}

.profile-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
}

.profile-img{
    width:150px;
    height:150px;
    object-fit:cover;
    border-radius:50%;
    border:5px solid #0d6efd;
}

</style>

</head>
<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card profile-card shadow">

                <div class="card-body text-center p-5">

                    <?php

                    $image =
                    !empty($user['profile_image'])
                    ? "../uploads/profiles/" . $user['profile_image']
                    : "https://via.placeholder.com/150";

                    ?>

                    <img src="<?php echo $image; ?>"
                         class="profile-img mb-3">

                    <h2>
                        <?php echo htmlspecialchars($user['name'] ?? 'Student'); ?>
                    </h2>

                    <p class="text-muted">
                        <?php echo htmlspecialchars($user['email'] ?? 'No Email'); ?>
                    </p>

                    <hr>

                    <!-- Upload Form -->

                    <form method="POST"
                          enctype="multipart/form-data">

                        <input type="file"
                               name="profile_image"
                               class="form-control mb-3">

                        <button type="submit"
                                name="upload_photo"
                                class="btn btn-primary">

                            Upload Photo

                        </button>

                    </form>

                    <hr>

                    <!-- Statistics -->

                    <div class="row mt-4">

                        <div class="col-md-4">

                            <h4>
                                <?php echo $quiz_data['total']; ?>
                            </h4>

                            <p>Quiz Attempts</p>

                        </div>

                        <div class="col-md-4">

                            <h4>
                                <?php echo $lesson_data['total']; ?>
                            </h4>

                            <p>Total Lessons</p>

                        </div>

                        <div class="col-md-4">

                            <h4>
                                <?php echo $progress; ?>%
                            </h4>

                            <p>Progress</p>

                        </div>

                    </div>

                    <hr>

                    <!-- Progress Bar -->

                    <h5 class="mb-3">
                        Learning Progress
                    </h5>

                    <div class="progress">

                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                             style="width:<?php echo $progress; ?>%">

                            <?php echo $progress; ?>%

                        </div>

                    </div>

                    <div class="mt-4">

                        <a href="../user/user_dashboard.php"
                           class="btn btn-secondary">

                            Back to Dashboard

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>