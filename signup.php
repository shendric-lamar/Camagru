<html>
    <head>
        <title>Sign Up to Camagru!</title>
        <link rel="stylesheet" href="css/signup.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    </head>
    <body>
        <main>
            <h1 class="up">.camagru.</h1>
            <div id="login-box">
                <div class="left-box">
                    <h2>Sign Up</h2>
                    <?php
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == "emptyfields") {
                            echo '<p class="error">Fill in all fields!</p>';
                        }
                        else if ($_GET['error'] == "invalidmail") {
                            echo '<p class="error">Invalid email!</p>';
                        }
                        else if ($_GET['error'] == "invalidmailuid") {
                            echo '<p class="error">Invalid username and e-mail!</p>';
                        }
                        else if ($_GET['error'] == "invaliduid") {
                            echo '<p class="error">Invalid username!</p>';
                        }
                        else if ($_GET['error'] == "passwordcheck") {
                            echo '<p class="error">Your passwords do not match!</p>';
                        }
                        else if ($_GET['error'] == "usertaken") {
                            echo '<p class="error">Username is already taken!</p>';
                        }
                    }
                    else if (isset($_GET['signup'])) {
                        if ($_GET['signup'] == "success") {
                            header("Location: includes/signup_succes.php?signup=success");
                        }
                        else if ($_GET['signup'] == "error") {
                            echo '<p class="error">Signup failed... Please try again later!</p>';
                        }
                    }
                    ?>
                    <form action="includes/signup.php" method="post">
                         <input type="text" name="uid" placeholder="Username...">
                         <input type="text" name="mail" placeholder="E-mail...">
                         <input type="password" name="pwd" placeholder="Password...">
                         <input type="password" name="pwd-repeat" placeholder="Repeat password...">
                         <button type="submit" name="signup-submit">Signup</button>
                    </form>
                </div>
                <div class="right-box">
                    <p>Camagru is a web-project for Coding School 19, part of the 42 network. It's an Instagram inspired web application written in php, html, css and javascript!</p>
                </div>
                <div class="circle">o</div>
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
