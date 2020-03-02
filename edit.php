    <?php
        require "header.php";
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
<html>
    <head>
        <title>Edit Your Profile</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    </head>
    <body>
        <main>
            <div id="profile-box-edit">
                <h2 class="name"><?php echo $row['firstName']; ?></br><?php echo $row['lastName']; ?></h2>
                <img class="profile-pic" src="images/site/blank-avatar.jpg" alt="profile-picture">
                <div class="content-edit">
                    <div class="info">
                        <i class="material-icons">account_circle</i>
                        <i class="material-icons" style="color:#c6daf5;">chevron_right</i>
                        <h3 class="pinfo">Personal Info</h3>
                        <?php
                            if (isset($_GET['error'])) {
                                if ($_GET['error'] == "fieldsleftblank") {
                                    ?>
                                    <p class="error">Please fill in all fields!</p>
                                    <?php
                                }
                                if ($_GET['error'] == "useremailtaken") {
                                    ?>
                                    <p class="error">That username or email-address is already in use!</p>
                                    <?php
                                }
                            }
                            ?>
                        <form class="edit-form" action="includes/edit.php" method="post">
                            <p class="question-edit">Username</p><input type="text" name="uid" value="<?php echo $row['uidUsers']; ?>">
                            <p class="question-edit">Full Name</p><input type="text" name="fName" value="<?php echo $row['firstName']; echo " ".$row['lastName']; ?>">
                            <p class="question-edit">Date of birth</p><input type="date" name="dob" value="<?php echo $row['dateOfBirth']; ?>">
                            <p class="question-edit">Email</p><input type="text" name="email" value="<?php echo $row['mailUsers']; ?>">
                            <p type="password" class="question-edit">Password</p><input type="password" name="pwd">
                            <button type="submit" name="edit-submit">submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </body>
    <?php
        require "footer.php";
    ?>
</html>
