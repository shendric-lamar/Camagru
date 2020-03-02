<?php
    require "includes/dbh.php";
    $filename = "storage/shendric/shendric20200225164640.png";
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
    }
    $id = 1;
    $sql = "SELECT * FROM likes WHERE userId = ? AND photoId = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "ii", $id, $photoId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if ($resultCheck > 0) {
            $sql = "DELETE FROM likes INNER JOIN photos ON photos.photoId = likes.photoId WHERE likes.userId = ? AND photos.fileName = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../index.php?error=sqlerror");
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, "is", $id, $filename);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
            }
        }
    }
    //         $sql = "UPDATE photos SET likes = likes - 1 WHERE fileName = ?";
    //         $stmt = mysqli_stmt_init($conn);
    //         if (!mysqli_stmt_prepare($stmt, $sql)) {
    //             header("Location: ../index.php?error=sqlerror");
    //             exit();
    //         }
    //         else {
    //             mysqli_stmt_bind_param($stmt, "s", $filename);
    //             mysqli_stmt_execute($stmt);
    //             mysqli_stmt_store_result($stmt);
    //         }
    //     }
    // }
    //     else {
    //         $sql = "INSERT INTO likes (userId, photoId) VALUES (?, ?)";
    //         $stmt = mysqli_stmt_init($conn);
    //         if (!mysqli_stmt_prepare($stmt, $sql)) {
    //             header("Location: ../index.php?error=sqlerror");
    //             exit();
    //         }
    //         else {
    //             mysqli_stmt_bind_param($stmt, "ii", $id, $photoId);
    //             mysqli_stmt_execute($stmt);
    //             mysqli_stmt_store_result($stmt);
    //         }
    //         $sql = "UPDATE photos SET likes = likes + 1 WHERE photoId = ?";
    //         $stmt = mysqli_stmt_init($conn);
    //         if (!mysqli_stmt_prepare($stmt, $sql)) {
    //             header("Location: ../index.php?error=sqlerror");
    //             exit();
    //         }
    //         else {
    //             mysqli_stmt_bind_param($stmt, "i", $photoId);
    //             mysqli_stmt_execute($stmt);
    //             mysqli_stmt_store_result($stmt);
    //         }
    //     }
    // }
