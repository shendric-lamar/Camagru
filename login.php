<html>
    <head>
        <title>Log In to Camagru!</title>
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/footer.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    </head>
    <body>
        <main>
            <h1 class="up">.camagru.</h1>
            <div id="login-box">
                <div class="content">
                    <h2>Log In</h2>
                    <?php
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == "emptyfields") {
                            echo '<p class="error">Fill in all fields!</p>';
                        }
                        else if ($_GET['error'] == "sqlerror") {
                            echo '<p class="error">Log in failed... Please try again later!</p>';
                        }
                        else if ($_GET['error'] == "wrongpwd") {
                            echo '<p class="error">Wrong password!</p>';
                        }
                        else if ($_GET['error'] == "nouser") {
                            echo '<p class="error">User not found!</p>';
                        }
                    }
                    else if (isset($_GET['login'])) {
                        if ($_GET['login'] == "success") {
                            header("Location: home.php?login=succes");
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
                        <p class="sign-up">Don't have an account yet? <a href="signup.php">sign up</a></p>
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
