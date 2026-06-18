<?php 
include '../includes/db.php';

if($_SERVER['REQUEST_METHOD']==='POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $hashedpassword = password_hash($password,PASSWORD_DEFAULT);

    $verifyquery = "SELECT * FROM users WHERE email = '$email' ";
    $querycon = mysqli_query($con,$verifyquery);

    if(mysqli_num_rows($querycon)>0){
        header ("Location: /Language_learning_platform/index.php?Exist Username or Password");
        exit();
    } else {
        $insertquery = "INSERT INTO users(name, password, email) VALUES('$username','$hashedpassword','$email')";
           if(mysqli_query($con,$insertquery)){
            header("Location: /Language_learning_platform/index.php?message=Registration Successful! You can now log in");
            exit();
           } else {
            header("Location: /Language_learning_platform/index.php?error= error occured during Registration ");
            exit();
           }
    }


}
?>
