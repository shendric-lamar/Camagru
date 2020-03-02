<?php
if (isset($_POST['reset-submit'])) {

    require 'dbh.php';
    $uid = $_POST['uid'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];
    $sql = "SELECT pwdUsers FROM users WHERE uidUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: login.php?error=sqlerror");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, 's', $uid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (!($row = mysqli_fetch_assoc($result))) {
            header("Location: ../reset.php?error=unf");
            exit();
        }
        $oldPassword = $row['pwdUsers'];
    }
    if (empty($passwordRepeat) || empty($password)) {
        header("Location: ../reset.php?error=emptyfields");
        exit();
    }
    if ($passwordRepeat !== $password) {
        header("Location: ../reset.php?error=pdm");
        exit();
    }
    $pwdCheck = password_verify($password, $oldPassword);
    if ($pwdCheck == true) {
        header("Location: ../reset.php?error=opmnp");
        exit();
    }
    else {
        $password = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET pwdUsers=? WHERE uidUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../reset.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $password, $uid);
            mysqli_stmt_execute($stmt);
            header("Location: ../index.php?pwdchange=success");
        }
    }
}
else {
    header("Location: ../reset.php");
    exit();
}
