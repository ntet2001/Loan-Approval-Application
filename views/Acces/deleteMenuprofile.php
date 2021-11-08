<?php
    require_once "../Fonction/auth_function.php";
    //ajout de la session et connexion et verification de l'id section
    ajoutsession();
    estconnecte();
    $connexion=connexion();
    $erreur=null;

    //je verifie l'id passer par l'url
    if (!empty($_GET['id'])) {
    $id=checkInput($_GET['id']);
    }

    // requete de suppression
    if (isset($_POST['delete'])) {
        $queryDelete="DELETE FROM profil_menu WHERE id='$id'";
        $queryDelete=odbc_exec($connexion,$queryDelete);
        header('Location: ./indexMenuprofile.php');    
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
    <main class="container" style="margin-top:100px;">
    <div class="row formulaire">
            <div class="col-lg-6">
                <!--formulaire-->
                <form action="<?='deleteMenuprofile.php?id='.$id?>" method="post">
                    <h1>Delete Profile-Menu</h1><br>
                    <p class="alert alert-warning">Do you want to delete Profile-menu<?=$id?> ?</p>
                    <a href="./indexMenuprofile.php" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-danger" name="delete">Yes</button>
                </form>
                <!-- ferme la connexion -->
                <?=finconnexion();?>
            </div>
        </div>
    </main>
</body>
</html>