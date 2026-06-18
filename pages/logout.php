<?php
session_start();

session_unset();
session_destroy();

header("Location: /Language_learning_platform/index.php");
exit();
?>