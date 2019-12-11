<?php

require 'dbh.php';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $pname = rand(1000,1000)."-".$_FILES['file']['name'];
    $tname = $_FILES['files']['tmp_name'];
    $uploads_dir = '/images';
    move_uploaded_file($tname, $uploads_dir.'/'.$pname);
    $sql = "INSERT into fileup(title,image VALUE('$title','$pname'))";
    if(mysqli_query($conn, $sql)) {
        echo "File Successfully uploaded!";
    }
    else {
        echo "Error";
    }
}
function pre_r($array) {
    echo '<pre>';
    print_r($array);
    echo '<pre>';
}

?>
