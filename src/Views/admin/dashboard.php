<?php

    session_start();
    if(!isset($_SESSION["id"]) && !isset($_SESSION["role"]) && $_SESSION["role"] != "admin"){
        header("Location: ../auth/login.php");
        exit();

    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>hello world admin</h2>
</body>
</html>