<?php
require "header.php";
require "includes/dbh.php";
    if (isset($_GET['email']))
        $email = $_GET['email'];
    if (isset($_GET['token']))
        $token = $_GET['token'];
    $sql = "SELECT tokenReset FROM users WHERE mailUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: login.php?error=sqlerror");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        if (isset($_GET['error']) || $token == $row['tokenReset']) {
        ?>
        <html>
            <head>
                <title>Reset your password</title>
                <link rel="stylesheet" href="css/login.css">
                <link rel="stylesheet" href="css/footer.css">
                <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            </head>
            <body>
                <main>
                    <h1 class="up">.camagru.</h1>
                    <div id="login-box">
                        <div class="content">
                            <h2 class="boxtitle">Reset Your Password</h2>
                            <div>
                                <?php
                                    if (isset($_GET['error'])) {
                                ?>
                                <p class="error">Password change failed!</p>
                                <?php
                                    }
                                ?>
                                <form action="includes/reset.php" method="post">
                                    <input type="text" name="uid" placeholder="Username..."><br>
                                    <input type="password" name="pwd" placeholder="New Password..."><br>
                                    <input type="password" name="pwd-repeat" placeholder="Repeat New Password..."><br>
                                    <button type="submit" name="reset-submit">reset</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <h1 class="down">.camagru.</h1>
                </main>
            </body>
            <div class="footer">
            <?php
                require "footer.php";
            ?>
            <div>
        </html>
        <?php
        }
        else
            header("Location: index.php");
    }
