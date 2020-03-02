<?php
    require "header.php";
?>
<html>
    <head>
        <title>Reset Password</title>
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
                    <p class="sign-up">An e-mail will be send to you with instructions on how to reset your password.</p>
                    <br>
                    <?php
                        if (isset($_GET['reset']) && $_GET['reset'] == 'error') {
                    ?>
                    <p class="error">Something went wrong... Please try again later!</p>
                    <?php
                        }
                    ?>
                    <div>
                        <form action="includes/reset-request.php" method="post">
                            <input type="text" name="email" placeholder="Email..."><br>
                            <button type="submit" name="reset-request-submit">Send E-mail</button>
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
