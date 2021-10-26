<?php
    $cursor_option = SQL_CUR_USE_DRIVER;
    $serveur='DESKTOP-JHVHF00\SQLEXPRESS01';
    $database='db_gestion_credit';
    $user='ntet';
    $pwd='credit2021';
    try {
        $connexion=odbc_connect("DRIVER={SQL Server};SERVER=$serveur;DATABASE=$database",$user,$pwd,$cursor_option);
    } catch (Exception $e) {
        echo 'erreur'.$e->getMessage();
    }        

?>
