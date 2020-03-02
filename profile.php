<?php
    require "header.php";
?>
<html>
    <head>
        <title>Your Profile</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php
            require "includes/dbh.php";
            $sql = "SELECT * FROM users WHERE idUsers=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: profile.php?error=sqlerror");
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, "s", $_SESSION['userId']);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);
            }
        ?>
        <main>
            <h1>Profile</h1>
            <div id="profile-box">
                <h2 class="name"><?php echo $row['firstName']; ?></br><?php echo $row['lastName']; ?></h2>
                <img class="profile-pic" src="images/site/blank-avatar.jpg" alt="profile-picture">
                <div class="content-profile">
                    <div class="info">
                        <i class="material-icons">account_circle</i>
                        <i class="material-icons" style="color:#c6daf5;">chevron_right</i>
                        <a class="edit material-icons" style="float:right;font-size:20px;" href="edit.php">edit</a>
                        <h3 class="pinfo">Personal Info</h3>
                        <p class="question">Username <p class="answer"><?php echo $row['uidUsers']; ?></p></p>
                        <p class="question">Full Name <p class="answer"><?php echo $row['firstName']; echo " ".$row['lastName']; ?></p></p>
                        <p class="question">Date of birth <p class="answer"><?php echo $row['dateOfBirth']; ?></p></p>
                        <p class="question">Email <p class="answer"><?php echo $row['mailUsers']; ?></p></p>
                        <p type="password" class="question">Password <p class="answer">●●●●●●●</p></p>
                    </div>
                </div>
            </div>
        </main>
    </body>
    <div class="footer">
    <?php
        require "footer.php";
    ?>
    </div>
</html>
