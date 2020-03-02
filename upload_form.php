<html>
    <div class="header">
    <?php
        require "header.php";
    ?>
    </div>
    <head>
        <title>Contact Camagru!</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <body>
        <main>
            <?php
            if (isset($_GET['error'])) {
            ?>
            <p class="error">An error occured, please try again...</p>
            <?php
            }
            ?>
            <div id="login-box">
                <div class="content">
                    <h1 class="utitle">Choose a picture</h1>
                    <p class="contact">Pictures should be 600px by 450px</p>
                    <form class="picture" action="includes/upload_form_script.php" method="post" enctype="multipart/form-data">
                        <input class="file" type="file" name="file">
                        <button class="form-submit" type="submit" name="submit">submit</button>
                    </form>
                </div>
            </div>
        </main>
    </body>
    <?php
        require "footer.php";
    ?>
</html>
