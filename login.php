<?php
    require "header.php";
?>
<html>
    <head>
        <title>Log In to Camagru!</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> -->
    </head>
    <body>
        <main>
            <h1 class="up">.camagru.</h1>
            <div id="login-box">
                <div class="content">
                    <h2 class="boxtitle">Log In</h2>
                    <?php
                    require 'includes/dbh.php';

                    if (isset($_GET['token']) && isset($_GET['uid'])) {
                        $uid = $_GET['uid'];
                        $sql = "SELECT token FROM users WHERE uidUsers=?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: login.php?error=sqlerror");
                            exit();
                        }
                        else {
                            mysqli_stmt_bind_param($stmt, 's', $uid);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            $row = mysqli_fetch_assoc($result);
                            if ($_GET['token'] == $row['token']) {
                                $sql = "UPDATE users SET activated='1' WHERE uidUsers=?";
                                if (!mysqli_stmt_prepare($stmt, $sql)) {
                                    header("Location: login.php?error=sqlerror");
                                    exit();
                                }
                                else {
                                    mysqli_stmt_bind_param($stmt, "s", $uid);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_store_result($stmt);
                                    echo '<p class="success">Account activated! Please log in</p>';
                                }
                            }
                            else
                                echo '<p class="error">Log in failed... Please try again later!</p>';
                        }
                    }
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == "emptyfields") {
                            echo '<p class="error">Fill in all fields!</p>';
                        }
                        else if ($_GET['error'] == "sqlerror") {
                            echo '<p class="error">Log in failed!</p>';
                        }
                        else if ($_GET['error'] == "wrongpwd") {
                            echo '<p class="error">Login failed!</p>';
                        }
                        else if ($_GET['error'] == "nouser") {
                            echo '<p class="error">Login failed!</p>';
                        }
                        if ($_GET['error'] == "acnotact") {
                            echo '<p class="error">Activate account first!</p>';
                        }
                    }
                    else if (isset($_GET['login'])) {
                        if ($_GET['login'] == "success") {
                            header("Location: index.php?login=success");
                        }
                        else {
                            echo '<p class="error">Log in failed... Please try again later!</p>';
                        }
                    }
                    ?>
                    <div>
                        <form action="includes/login.php" method="post">
                            <input type="text" name="mailuid" placeholder="Username..."><br>
                            <input type="password" name="pwd" placeholder="Password..."><br>
                            <button type="submit" name="login-submit">login</button>
                        </form>
                        <p class="sign-up"><a href="reset-request.php">forgot your password?</a></p>
                        <p class="sign-up">Don't have an account yet? <a href="signup.php">sign up!</a></p>
                    </div>
                </div>
            </div>
            <h1 class="down">.camagru.</h1>
        </main>
    </body>
    <?php
        require "footer.php";
    ?>
</html>
