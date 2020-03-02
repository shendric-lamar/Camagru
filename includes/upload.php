<?php

require "dbh.php";
session_start();
date_default_timezone_set("Europe/Brussels");

function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
    // creating a cut resource
    $cut = imagecreatetruecolor($src_w, $src_h);

    // copying relevant section from background to the cut resource
    imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);

    // copying relevant section from watermark to the cut resource
    imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);

    // insert cut resource to destination image
    imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
}

$filter_name = $_POST['filter'];
$filter = imagecreatefrompng("../images/filters2/".$filter_name.".png");
imagealphablending($filter, false);
imagesavealpha($filter, true);
if (isset($_POST['data'])) {
    $encodedData = $_POST['data'];
    $encodedData = str_replace('data:image/png;base64,', '', $encodedData);
    $encodedData = str_replace(' ','+',$encodedData);
    $img = base64_decode($encodedData);
    file_put_contents("../storage/tmp.png", $img);
}
$new_img = imagecreatefrompng("../storage/tmp.png");
imagecopymerge_alpha($new_img, $filter, 150, 15, 0, 0, 320, 240, 100);

$user = $_SESSION['userUid'];
$id = $_SESSION['userId'];
if (!file_exists("../storage/".$user)) {
    mkdir("../storage/".$user);
    chmod("../storage/".$user, 0777);
}
$filename = "../storage/".$user."/".$user.date('YmdHis') . '.png';
$sql = "INSERT INTO photos (userId, fileName) VALUES (?, ?)";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../index.php?error=sqlerror");
    exit();
}
else {
    mysqli_stmt_bind_param($stmt, 'is', $id, $filename);
    mysqli_stmt_execute($stmt);
    imagepng($new_img, $filename);
    unlink("../storage/tmp.png");
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
