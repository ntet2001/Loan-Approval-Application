<?php
   //ajout de ma session  et test sur le user est connecte
   require_once "../Fonction/auth_function.php";
   ajoutsession();
   estconnecte();
   $connexion=connexion();
   $erreur=NULL;
   $date=null;
   $idReseau=$_SESSION['id_reseau'];
   $idAgence=$_SESSION['id_agence'];
   $idUser=$_SESSION['id_user'];
   // je recupere le nom du reseau et le nom de l'agence du user
   $queryReseau="SELECT nom_reseau FROM reseau WHERE id_reseau='$idReseau'";
   $queryAgence="SELECT nom_agence FROM agence WHERE id_agence='$idAgence'";
   $ResultatReseau=odbc_exec($connexion,$queryReseau);
   while (odbc_fetch_row($ResultatReseau)) {
       $nomReseau=odbc_result($ResultatReseau,'nom_reseau');
   }
   $ResultatAgence=odbc_exec($connexion,$queryAgence);
   while (odbc_fetch_row($ResultatAgence)) {
       $nomAgence=odbc_result($ResultatAgence,'nom_agence');
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--link call bootstrap css-->
    <link rel="stylesheet" href="../dist/css/bootstrap.css">
    <link rel="stylesheet" href="../connexion/headerAdmin/headerAdmin.css">
        <!--call bootstrap javascript-->
    <script src="../dist/jquery/jquery-3.6.0.min.js"></script>
    <script src="../dist/js/bootstrap.js"></script>
    <script src="../dist/js/popper.min.js"></script>
</head>
<body>
    <!---header pour ma navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
            <div class="container-fluid">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#monMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
               <div class="collapse navbar-collapse" id="monMenu">
                    <li class="nav-item">
                        <a href="../Connexion/indexAdminUser.php" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                                <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                            </svg>  Return Home
                        </a>
                    </li>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                    <span style="color: white;">Nom: <?=$_SESSION['nom_user'].'  '.'('.$_SESSION['nom_profil'].')'."<br>".'Reseau: '.$nomReseau.' '.'Agence: '.$nomAgence?></span>
                </div>
               </div>
            </div>
        </nav>
    </header>
</body>
</html>