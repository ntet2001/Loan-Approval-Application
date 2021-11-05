<?php
    //fonction pour la connexion a la bd
    function connexion()
    {
        $cursor_option = SQL_CUR_USE_DRIVER;
        $serveur='DESKTOP-JHVHF00\SQLEXPRESS01';
        $database='db_gestion_credit';
        $user='ntet';
        $pwd='credit2021';
        try {
            $connexion=odbc_connect("DRIVER={SQL Server};SERVER=$serveur;DATABASE=$database",$user,$pwd,$cursor_option);
            return $connexion;
        } catch (Exception $e) {
            echo 'erreur'.$e->getMessage();
        }   
    }  
    
    //fonction de fermeture de la connexion
    function finconnexion()
    {
        odbc_close(connexion());
    }

    //ajout de session
    function ajoutsession(){
        session_start();
    }

    //retirer session
    function retirersession(array $data){
        session_unset($data);
        session_destroy();
        header('Location: ./login.php');
        exit();
    }

    // fonction pour verifier si l'utilisateur est connecte
    function estconnecte(){
        if($_SESSION['connecte'] != 1){
            header('Location: ../connexion/login.php');
        }
    }

    // fonction pour verifier id passer par l'url
    function checkinput($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }

    
?>
