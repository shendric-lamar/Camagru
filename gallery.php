<?php
    require "header.php";
    require "includes/dbh.php";
    $user = $_SESSION["userUid"];
?>
<html>
    <head>
        <title>Contact Camagru!</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <body>
        <h1>Gallery</h1>
        <?php
            $arr = glob("storage/".$user."/*");
            if (empty($arr)) {
        ?>
            <div class="empty">
                <p class="error">You haven't uploaded any pictures yet</p>
                <a class="add material-icons" href="camera.php">add_photo_alternate</i>
            </div>
        <?php
            }
            else {
                foreach (glob("storage/".$user."/*") as $filename) {
                    $sql = "SELECT likes, comments, dateOfUpload FROM photos WHERE fileName = ?";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: index.php?error=sqlerror");
                        exit();
                    }
                    else {
                        mysqli_stmt_bind_param($stmt, 's', $filename);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $row = mysqli_fetch_assoc($result);
                        $likes = $row['likes'];
                        $comments = $row['comments'];
                        $date = $row['dateOfUpload'];
                    }
        ?>
            <div id="gallery-box">
                <div class="content-gallery">
                    <p class="feed-date"><?= $row['dateOfUpload'] ?></p>
                    <a href="picture.php?photo=<?= $filename ?>"><img class="gallery" src="<?= $filename ?>" alt="img"></a>
                    <i id="like-icon" class="material-icons" style="float:left">thumb_up</i><p class="likes"><?= $likes ?> likes</p>
                    <i class="chat-icon material-icons" style="float:right">chat_bubble_outline</i><p class="comments"><?= $comments ?> comments</p>
                </div>
            </div>
        <?php
                }
            }
        ?>
