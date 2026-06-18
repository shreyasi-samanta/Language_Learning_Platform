<?php
include "../includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check user by email
    $query = "SELECT * FROM users WHERE email = '$email'";

    // Correct function
    $result = mysqli_query($con, $query);

    // Check if user exists
    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $user['password'])) {

            session_start();

            $_SESSION['email'] = $user['email'];
            $_SESSION['logged_in'] = true;
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'admin') {

                header("Location: /Language_learning_platform/admin/admin_dashboard.php");
                exit();

            } else {

                header("Location: /Language_learning_platform/user/user_dashboard.php?message=Login Successful!");
                exit();
            }

        } else {

            header("Location: /Language_learning_platform/index.php?error=Invalid Email or Password!");
            exit();
        }

    } else {

        header("Location: /Language_learning_platform/index.php?error=Invalid Email or Password!");
        exit();
    }
}
?>