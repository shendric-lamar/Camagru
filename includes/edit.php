<?php
require "dbh.php";

    $username = $_POST['uid'];
    $email = $_POST['email'];
    $name = explode(" ", $_POST['fName']);
    $dob = $_POST['dob'];
    if (empty($_POST['pwd']) || empty($username) || empty($email) || empty($name) || empty($dob)) {
        header("Location: ../edit.php?error=fieldsleftblank");
        exit();
    }
    $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
    $sql = "SELECT * FROM users WHERE uidUsers=? OR mailUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../edit.php?error=sqlerror");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if ($resultCheck > 1) {
            header("Location: ../edit.php?error=useremailtaken");
            exit();
        }
        else {
            $sql = "UPDATE users SET uidUsers=?, mailUsers=?, firstName=?, lastName=?, dateOfBirth=?, pwdUsers=? WHERE mailUsers=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../edit.php?error=sqlerror");
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, "sssssss", $username, $email, $name[0], $name[1], $dob, $pwd, $email);
                mysqli_stmt_execute($stmt);
                header("Location: ../profile.php");
            }
        }
    }
