<?php
    require "header.php";

    $arr = array("dog", "cat", "hat", "bunny", "moustache", "glasses");
    if (isset($_GET['login'])) {
        if ($_GET['login'] == "success")
        echo "<p class='success'>Login successful!</p>";
    }
    if (isset($_GET['signup'])) {
        if ($_GET['signup'] == "success")
        echo "<p class='success'>Signup successful!</p>";
    }
    if (isset($_GET['filter']) && in_array($_GET['filter'], $arr)) {
        $filter = $_GET['filter'];
    }
    $user = $_SESSION['userUid'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <script src="js/capture.js">
        </script>
</head>
<body>
    <?php
        if (!isset($filter)) {
    ?>
            <p class="error">Please select a filter to be able to take pictures!</p>
    <?php
        }
    ?>
    <div class="content-camera">
        <video id="video">Video stream not available.</video>
        <?php
            if (isset($filter)) { ?>
                <img class="filter" style="width:100%;" src="images/filters/<?= $filter;?>.png" alt="filter">
        <?php } ?>
        <canvas id="canvas">
        </canvas>
        <div class="output">
            <img id="photo" src="">
            <?php
                if (isset($filter)) { ?>
                    <img class="filter-two" style="width:26.6666666%;" src="images/filters/<?= $filter;?>.png" alt="filter">
            <?php } ?>
        </div>
        <div id="filter-box">
            <div class="content">
                <div class="list-container">
                    <a href="camera.php?filter=dog"><img class="filter-icon" src="images/filters/dog.png" alt="dog"></a>
                    <a href="camera.php?filter=cat"><img class="filter-icon" src="images/filters/cat.png" alt="cat"></a>
                    <a href="camera.php?filter=bunny"><img class="filter-icon" src="images/filters/bunny.png" alt="bunny"></a>
                    <a href="camera.php?filter=glasses"><img class="filter-icon" src="images/filters/glasses.png" alt="glasses"></a>
                    <a href="camera.php?filter=moustache"><img class="filter-icon" src="images/filters/moustache.png" alt="moustache"></a>
                    <a href="camera.php?filter=hat"><img class="filter-icon" src="images/filters/hat.png" alt="hat"></a>
                </div>
            </div>
        </div>
        <?php if (!isset($filter)) {
                $hidden = "hidden";
                }
        ?>
        <button id="capture" style="visibility:<?= $hidden ?>"><i class="material-icons">camera_alt</i></button>
        <button id="remove" style="visibility:<?= $hidden ?>"><i class="material-icons">remove_circle</i></button>
        <button id="upload" style="visibility:<?= $hidden ?>"><i class="material-icons">file_upload</i></button>
        <button id="refresh"><i class="material-icons">refresh</i></button>
        <div id="preview-box">
            <div class="content-preview">
                <?php
                    $arr = glob("storage/".$user."/*");
                    if (empty($arr)) {}
                    else {
                        foreach (glob("storage/".$user."/*") as $filename) {
                ?>
                            <img class="preview" src="<?= $filename ?>" alt="">
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
