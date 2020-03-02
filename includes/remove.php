<?php
    require "dbh.php";
    $filename = $_POST['photo'];
    $sql = "DELETE FROM photos WHERE fileName = ?";
    $stmt = mysqli_stmt_init($conn);
    $sql = "SELECT photoId FROM photos WHERE fileName = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $filename);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $photoId = $row['photoId'];
        $sql = "DELETE FROM photos WHERE fileName = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: picture.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $filename);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $sql = "DELETE FROM likes WHERE photoId = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: picture.php?error=sqlerror");
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, "s", $photoId);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                unlink("../".$filename);
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../index.php");
