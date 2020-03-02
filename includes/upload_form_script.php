<?php
$target_file = "../storage/tmp.png";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false && $check[0] == "600" && $check[1] == "450") {
        echo "File is an image - " . $check["mime"] . "." .$check[0].$check[1];
        $uploadOk = 1;
    } else {
        header("Location: ../upload_form.php?error");
        $uploadOk = 0;
    }
}
if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file) && $uploadOk == 1) {
    header("Location: ../upload.php");
}
else {
    header("Location: ../upload_form.php?error");
}
?>
