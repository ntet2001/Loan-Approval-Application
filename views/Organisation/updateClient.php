<?php
    //ajout de ma session et du nom de l'utilisateur dans mon loan header
    session_start();
    if ($_SESSION['connecte']!=1) {
        header('Location: ../../../login.php');
    }
?>