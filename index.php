<?php
    require "header.php";
    require "includes/dbh.php";
    $sql = "SELECT users.firstName, users.lastName, photos.fileName, photos.likes, photos.comments, photos.dateOfUpload FROM photos INNER JOIN users ON users.idUsers = photos.userId ORDER BY photos.dateOfUpload DESC";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: index.php?error=sqlerror");
        exit();
    }
    else {
        $pictures = array();
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['firstName'].' '.$row['lastName'];
            ?>
            <div id="feed-box">
                <div class="content-gallery">
                    <h2><?= $name ?></h2>
                    <p class="feed-date"><?= $row['dateOfUpload'] ?></p>
                    <a href="picture.php?photo=<?= $row["fileName"] ?>"><img class="gallery" src="<?= $row["fileName"] ?>" alt="img"></a>
                    <i id="like-icon" class="material-icons" style="float:left">thumb_up</i><p class="likes"><?= $row['likes'] ?> likes</p>
                    <i class="chat-icon material-icons" style="float:right">chat_bubble_outline</i><p class="comments"><?= $row['comments'] ?> comments</p>
                </div>
            </div>
            <?php
        }
    }
