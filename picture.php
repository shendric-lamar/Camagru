<?php
    require "header.php";
    require "includes/dbh.php";
    $filename = $_GET['photo'];
    $sql = "SELECT users.idUsers, users.firstName, users.lastName, photos.likes, photos.dateOfUpload FROM photos INNER JOIN users ON users.idUsers = photos.userId WHERE photos.fileName = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: picture.php?error=sqlerror");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $filename);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $name = $row['firstName'].' '.$row['lastName'];
    }
    if (empty($row)){
        header("Location: index.php");
    }
?>
<html>
    <head>
        <title>Contact Camagru!</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <body>
        <h1>Photo by <?= $name ?></h1>
        <div id="gallery-box" style="height: 530px;">
            <div class="content-gallery">
                <?php
                    if ($row['idUsers'] == $_SESSION['userId']) {
                ?>
                        <button id="remove-photo"><i class="material-icons">remove_circle</i></button>
                <?php
                    }
                ?>
                <img class="gallery" src="<?= $filename ?>" alt="img">
                <button id="like-icon" class="material-icons" style="float:left">thumb_up</button><p class="likes"><?= $row['likes'] ?></p>
                <p class="comments"><?= $row['dateOfUpload'] ?></p>
            </div>
        </div>
    </body>
    <script src="js/picture.js">
    </script>
