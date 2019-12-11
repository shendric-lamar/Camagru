<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="This is an example of a meta description. This will often show up in search results.">
        <met name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/header.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <title></title>
    </head>
    <body>
        <header>
            <nav>
                <ul class="nav-list">
                    <?php
                        $page = basename($_SERVER['PHP_SELF']);
                    ?>
                        <li class="nav"><a class="nav-link <?= ($page == 'home.php') ? 'active' : ''; ?>" href="home.php">Home</a></li>
                        <li class="nav"><a class="nav-link <?= ($page == 'notifications.php') ? 'active' : ''; ?>" href="#">Notifications</a></li>
                        <li class="nav"><a class="nav-link <?= ($page == 'profile.php') ? 'active' : ''; ?>" href="#">Profile</a></li>
                        <li class="nav"><a class="nav-link <?= ($page == 'upload.php') ? 'active' : ''; ?>" href="upload.php">Upload</a></li>
                        <li class="nav" style="float:right"><a class="nav-link" href="includes/logout.php">Log Out</a></li>
                        <li class="nav" style="float:right"><a class="nav-link <?= ($page == 'contact.php') ? 'active' : ''; ?>" href="contact.php">Contact</a>
                </ul>
            </nav>
        </header>
    </body>
    </html>
