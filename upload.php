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
        <script src="js/upload.js">
        </script>
</head>
<body>
    <?php
        if (!isset($filter)) {
    ?>
            <p class="error">Please select a filter to be able to upload a picture!</p>
    <?php
        }
    ?>
    <div class="content-camera">
        <?php
            if (isset($filter)) { ?>
                <img class="filter" style="width:100%;" src="images/filters/<?= $filter;?>.png" alt="filter">
        <?php } ?>
        <img id="uploaded" src="storage/tmp.png">
        <div id="filter-box-upload">
            <div class="content">
                <div class="list-container">
                    <a href="upload.php?filter=dog"><img class="filter-icon" src="images/filters/dog.png" alt="dog"></a>
                    <a href="upload.php?filter=cat"><img class="filter-icon" src="images/filters/cat.png" alt="cat"></a>
                    <a href="upload.php?filter=bunny"><img class="filter-icon" src="images/filters/bunny.png" alt="bunny"></a>
                    <a href="upload.php?filter=glasses"><img class="filter-icon" src="images/filters/glasses.png" alt="glasses"></a>
                    <a href="upload.php?filter=moustache"><img class="filter-icon" src="images/filters/moustache.png" alt="moustache"></a>
                    <a href="upload.php?filter=hat"><img class="filter-icon" src="images/filters/hat.png" alt="hat"></a>
                </div>
            </div>
        </div>
        <?php if (!isset($filter)) {
                $hidden = "hidden";
                }
        ?>
        <button onclick="location.href = 'upload_form.php'" id="remove-upload" style="visibility:<?= $hidden ?>"><i class="material-icons">remove_circle</i></button>
        <button id="upload" style="visibility:<?= $hidden ?>"><i class="material-icons">file_upload</i></button>
        <button id="refresh-upload"><i class="material-icons">refresh</i></button>
        <div id="preview-box-upload">
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
