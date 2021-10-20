<?php
    session_start();
    session_unset($_SESSION['connecte'],$_SESSION['id'],$_SESSION['user']);
    session_destroy();
    header('Location: ./login.php');
    exit();

?>