<html>
    <head>
        <?php
            if (isset($_GET['signup']))
                echo '<title>Sign Up Successful!</title>';
            else if (isset($_GET['reset']))
                echo '<title>Email Sent!</title>';
            ?>
        <link rel="stylesheet" href="../css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <main>
        <div id="success-box">
            <i class="material-icons checkbox" style="font-size:100px;text-align:center;">check</i>
            <?php
                if (isset($_GET['signup']))
                    echo '<p class="text">You have successfully signed up to Camagru! </br>
                    Please click the link in the email we sent to your email address to verify your account!</p>';
                else if (isset($_GET['reset']))
                    echo '<p class="text">Please click the link in the email we sent to your email address to reset your password!</p>';
                ?>

        </div>
    </main>
    <?php
        require "../footer.php";
    ?>
</html>
