    <main>
        <?php
        if (isset($_SESSION['userId'])) {
            header("Location: home.php");
        }
        else {
            header("Location: login.php");
        }
        ?>
    </main>

<?php
    require "footer.php";
?>
