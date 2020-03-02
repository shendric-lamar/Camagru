<?php
    require "dbh.php";
    session_start();
    $filename = $_POST['photo'];
    $sql = "SELECT photoId FROM photos WHERE fileName = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $filename);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $photoId = $row['photoId'];
    }
    $id = $_SESSION['userId'];
    $user = $_SESSION['userUid'];
    $sql = "SELECT * FROM likes WHERE userId = ? AND photoId = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "ii", $id, $photoId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if ($resultCheck > 0) {
            $sql = "DELETE FROM likes WHERE userId = ? AND photoId = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../index.php?error=sqlerror");
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, "ii", $id, $photoId);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $sql = "UPDATE photos SET likes = likes - 1 WHERE fileName = ?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../index.php?error=sqlerror");
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt, "s", $filename);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                }
            }
        }
        else {
            $sql = "INSERT INTO likes (userId, photoId) VALUES (?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../index.php?error=sqlerror");
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, "ii", $id, $photoId);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $sql = "UPDATE photos SET likes = likes + 1 WHERE photoId = ?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../index.php?error=sqlerror");
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt, "i", $photoId);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);

                    $sql = "SELECT mailUsers FROM users INNER JOIN photos ON photos.userId = users.idUsers WHERE photos.photoId = ?";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../index.php?error=sqlerror");
                        exit();
                    }
                    else {
                        mysqli_stmt_bind_param($stmt, "i", $photoId);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $row = mysqli_fetch_assoc($result);
                        $email = $row['mailUsers'];

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

                        $mail->Subject = $user.' liked your photo!';
                        $mail->Body    = '<p>'.$user.' liked your photo.</p><a href="http://localhost:8080/Camagru/picture.php?photo='.$filename.'">View on Camagru</a>';
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                        if(!$mail->send()) {
                            header("Location: ../picture.php?signup=error");
                            exit();
                        } else {
                            header("Location: picture.php?photo=".$filename);
                            exit();
                        }
                    }
                }
            }
        }
    }
