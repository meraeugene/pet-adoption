<?php
include(__DIR__ . '/../dB/config.php');

 if (isset($_SESSION['auth'])) {
        if ($_SESSION['userRole'] == 'admin') {
            header("Location: view/admin/index.php"); // Redirect admin to dashboard
            exit();
        } else {
            header("Location: view/users/index.php"); // Redirect user to their dashboard
            exit();
        }
    }

?>