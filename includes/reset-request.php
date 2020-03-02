<?php

require 'dbh.php';

if (isset($_POST["reset-request-submit"])) {
    $email = $_POST["email"];
    $sql = "SELECT mailUsers FROM users WHERE mailUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../reset-request.php?error=sqlerror");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $sql = "UPDATE users SET tokenReset=? WHERE mailUsers=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../reset-request.php?error=sqlerror");
                exit();
            }
            else {
                $token = password_hash($email, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "ss", $token, $email);
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

                $mail->Subject = 'Password Reset';
                $mail->Body    = '<a href="http://localhost:8080/Camagru/reset.php?email=' . $email . '&token=' . $token . '">Click here to reset your password</a>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                if(!$mail->send()) {
                    header("Location: ../reset-request.php?reset=error");
                    exit();
                } else {
                    header("Location: signup_succes.php?reset=succes");
                    exit();
                }
            }
        }
        else
            header("Location: ../reset-request.php?reset=error");
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
    header("Location: ../reset-request.php");
    exit();
}
?>
