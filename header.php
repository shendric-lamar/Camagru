<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="This is an example of a meta description. This will often show up in search results.">
        <met name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <title></title>
    </head>
    <body>
        <header>
            <nav>
                <ul class="nav-list">
                    <?php
                        $page = basename($_SERVER['PHP_SELF']);
                    ?>
                        <li class="nav"><a class="nav-link material-icons <?= ($page == 'index.php') ? 'active' : ''; ?>" href="index.php" title="Home">home</a></li>
                    <?php
						if (isset($_SESSION["userId"]) && $_SESSION["userId"] != "") {
                    ?>
    					<li class='nav'><a class='nav-link material-icons <?= ($page == 'profile.php') ? 'active' : ''; ?>' href='profile.php' title='Profile'>account_circle</a></li>
                        <li class="nav"><a class="nav-link material-icons <?= ($page == 'camera.php') ? 'active' : ''; ?>" href="camera.php" title="Camera">camera_alt</a></li>
                        <li class="nav"><a class="nav-link material-icons <?= ($page == 'upload_form.php') ? 'active' : ''; ?>" href="upload_form.php"title="Upload Picture">camera</a></li>
                        <li class="nav"><a class="nav-link material-icons <?= ($page == 'gallery.php') ? 'active' : ''; ?>" href="gallery.php"title="Gallery">insert_photo</a></li>
                    <?php
                        }
                        if (isset($_SESSION["userId"]) && $_SESSION["userId"] != "") {
                    ?>
                    <li class="nav" style="float:right"><a class="nav-link material-icons" href="includes/logout.php" title="Logout">exit_to_app</a></li>
                    <?php } else { ?>
                    <li class="nav" style="float:right"><a class="nav-link material-icons" href="login.php" title="Login">launch</a></li>
                    <?php } ?>

                    <li class="nav" style="float:right"><a class="nav-link material-icons <?= ($page == 'contact.php') ? 'active' : ''; ?>" href="contact.php" title="Contact">contact_mail</a>
                </ul>
            </nav>
        </header>
    </body>
    </html>
