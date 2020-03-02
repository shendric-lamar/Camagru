<?php
if (isset($_POST['signup-submit'])) {

    require 'dbh.php';

    $username = $_POST['uid'];
    $fName = $_POST['f-name'];
    $lName = $_POST['l-name'];
    $dob = $_POST['dob'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if (empty($username) || empty($fName) || empty($lName) || empty($dob) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^$[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidmailuid");
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&uid=".$username);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invaliduid&mail=".$email);
        exit();
    }
    else if ($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
        exit();
    }
    else {
        $sql = "SELECT uidUsers FROM users WHERE uidUsers=? OR mailUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../signup.php?error=usertaken&mail=".$email);
                exit();
            }
            else {
                $sql = "INSERT INTO users (uidUsers, firstName, lastName, dateOfBirth, mailUsers, pwdUsers, token) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    $token = password_hash($username, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sssssss", $username, $fName, $lName, $dob, $email, $hashedPwd, $token);
                    mysqli_stmt_execute($stmt);

                    require '../mailer/PHPMailer/PHPMailerAutoload.php';
                    require 'credentials.php';

                    $mail = new PHPMailer;
                    //$mail->SMTPDebug = 3;                           // Enable verbose debug output
                    $mail->isSMTP();                                  // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';                   // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                           // Enable SMTP authentication
                    $mail->Username = EMAIL;                          // SMTP username
                    $mail->Password = PASS;                           // SMTP password
                    $mail->SMTPSecure = 'tls';                        // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                // TCP port to connect to

                    $mail->setFrom('noreply@camagru.com');
                    $mail->addAddress($email);                        // Add a recipient
                    $mail->addReplyTo('noreply@camagru.com');

                    $mail->isHTML(true);                              // Set email format to HTML

                    $mail->Subject = 'Verify your Camagru account!';
                    $mail->Body    = '<a href="http://localhost:8080/Camagru/login.php?uid=' . $username . '&token=' . $token . '">Click here to verify your account!</a>';
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    if(!$mail->send()) {
                        header("Location: ../signup.php?signup=error");
                        exit();
                    } else {
                        header("Location: signup_succes.php?signup=succes");
                        exit();
                    }
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
    header("Location: ../signup.php");
    exit();
}
