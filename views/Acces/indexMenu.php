<?php
    require_once "../Fonction/auth_function.php";
    //ajout de la session et connexion et verification de l'id section
    ajoutsession();
    estconnecte();
    $connexion=connexion();
    $erreur=null;
    $idReseau=$_SESSION['id_reseau'];
    
    //je selectionne les menus de l'application
    $queryMenu="SELECT id_menu, nom_menu FROM menu ";
    $selectMenu=odbc_exec($connexion,$queryMenu);

    // je recupere le nom du reseau
    $queryReseau="SELECT nom_reseau FROM reseau WHERE id_reseau='$idReseau'";
    $ResultatReseau=odbc_exec($connexion,$queryReseau);
    while (odbc_fetch_row($ResultatReseau)) {
        $nomReseau=odbc_result($ResultatReseau,'nom_reseau');
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
    <link rel="stylesheet" href="../dist/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../connexion/headerAdmin/headerAdmin.css">
        <!--call bootstrap javascript-->
    <script src="../dist/jquery/jquery-3.6.0.min.js"></script>
    <script src="../dist/jquery/jquery.dataTables.min.js"></script>
    <script src="../dist/js/bootstrap.js"></script>
    <script src="../dist/js/dataTables.bootstrap4.min.js"></script>
    <script src="../dist/js/popper.min.js"></script>
    <script defer>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
</head>
<body>
    <!---header pour ma navbar -->
    <header>
        <nav class="navbar  navbar-expand-lg navbar-light bg-primary fixed-top">
            <div class="container-fluid">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#monMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="monMenu">
                    <li class="nav-item">
                        <a href="../Connexion/administrateur.php" class="nav-link">
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
                    <span style="color: white;">Code:<?=$_SESSION['code_admin']." <br>".$_SESSION['nom_admin'].'  Reseau: '.$nomReseau?></span>
                </div>
            </div>
        </nav>
    </header>
    <!--main de mon fichier avec formulaire et tableau-->
    <main class="container">
        <!----tableau---->
        <div class="row tableau" style="margin-top: 50px;">
            <div class="col">
                <caption><h4>ALL MENUS</h4></caption>
                <table id="example" class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- j'affiche les differents menus -->
                        <?php while(odbc_fetch_row($selectMenu)):?>
                            <?php
                                $idMenu=odbc_result($selectMenu,'id_menu');
                                $nomMenu=odbc_result($selectMenu,'nom_menu');    
                            ?>
                        <tr>
                            <td><?=$idMenu?></td>
                            <td><?=$nomMenu?></td>
                        </tr>
                        <?php endwhile;?> 
                        <!-- //ferme la connexion a la bd -->
                        <?php finconnexion(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>