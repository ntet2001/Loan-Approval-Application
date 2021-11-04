<?php
    //ajout de ma session  et test sur le user est connecte
    require_once "../Fonction/auth_function.php";
    ajoutsession();
    if($_SESSION['connecte'] != 1){
        header('Location: ../connexion/login.php');
    }
    $connexion=connexion();
    $erreur=NULL;

    //je charge les champs select
    $queryUser="SELECT nom_user,id_user,agence.nom_agence,profil.nom_profil
    FROM users
    INNER JOIN agence
    ON users.id_agence = agence.id_agence
    INNER JOIN profil
    ON users.id_profil=profil.id_profil
    ORDER BY profil.nom_profil,id_user ASC";
    $selectUser=odbc_exec($connexion,$queryUser);
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
    <main class="container" style="margin-top: 100px;">
        <a href="./indexUser.php" class="btn btn-primary" style="margin-bottom: 50px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg> Back
        </a>
        <div class="row tableau">
            <div class="col">
                <table class="table table-hover table-bordered table-striped" id="example">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Profile</th>
                            <th>Agency</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while(odbc_fetch_row($selectUser)):?>
                            <?php
                                $idUser=odbc_result($selectUser,'id_user');
                                $nomUser=odbc_result($selectUser,'nom_user');
                                $nomAgence=odbc_result($selectUser,'nom_agence');    
                                $nomprofil=odbc_result($selectUser,'nom_profil');    
                            ?>
                            <tr>
                                <td><?=$idUser?></td>
                                <td><?=$nomUser?></td>
                                <td><?=$nomprofil?></td>
                                <td><?=$nomAgence?></td>
                                <td>
                                    <a href="<?='./updateUser.php?id='.$idUser?>" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
                                            <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                        </svg> Change User Info
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile;?>
                        <!-- fin connexion -->
                        <?=finconnexion();?>   
                    </tbody>
                </table>
            </div>        
        </div>        
    </main>
</body>
</html>