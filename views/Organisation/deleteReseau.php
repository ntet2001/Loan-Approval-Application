<?php
    //ajout de ma session  et test sur le user est connecte
    require_once "../Fonction/auth_function.php";
    ajoutsession();
    estconnecte();
    $connexion=connexion();
    $erreur=NULL;
    $nomReseau=null;
    
    //je verifie l'id passer par l'url
    if (!empty($_GET['id'])) {
    $id=checkInput($_GET['id']);
    }

    //je selectionne les infos correspondant a l'id
    $querySelect="SELECT nom_reseau FROM reseau WHERE id_reseau='$id'";
    $select=odbc_exec($connexion,$querySelect);

    //je supprime ici le reseau
    if (isset($_POST['delete'])) {
        $queryDelete="DELETE FROM reseau WHERE id_reseau='$id'";
        $delete=odbc_exec($connexion,$queryDelete);
        header('Location: ./indexReseau.php');
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
    <link rel="stylesheet" href="styleReseau.css">
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
                <form action="<?="./deleteReseau.php?id=".$id?>" method="post">
                    <h1>Delete Network</h1><br>
                    <?php while (odbc_fetch_row($select)):?>
                        <?php 
                            $nomReseau=odbc_result($select,'nom_reseau');
                        ?>
                    <?php endwhile;?>
                        <p class="alert alert-warning">Do you want to delete <?=$nomReseau?> ?</p>
                    <a href="./indexReseau.php" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-danger" name="delete"> Yes</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>