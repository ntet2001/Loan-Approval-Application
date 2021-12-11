<?php
    //ajout de ma session  et test sur le user est connecte
    require_once "../Fonction/auth_function.php";
    ajoutsession();
    estconnecte();
    $connexion=connexion();
    $erreur=NULL;

    //je verifie l'id passer par l'url
    if (!empty($_GET['id'])) {
        $id=checkInput($_GET['id']);
    }

    //je recupere les info de l'agence liées a l'id
    $queryBut="SELECT nom_but FROM but WHERE  id_but='$id'";
    $selectBut=odbc_exec($connexion,$queryBut);
    while (odbc_fetch_row($selectBut)) {
    $nomBut=odbc_result($selectBut,'nom_but');
    }

    //je supprime ici la section
    if (isset($_POST['delete'])) {
    $queryDelete="DELETE FROM but WHERE id_but='$id'";
    $delete=odbc_exec($connexion,$queryDelete);
    header('Location: ./indexBut.php');
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
                <form action="<?='deleteBut.php?id='.$id?>" method="post">
                    <h1>Delete Purpose Loan</h1><br>
                     <p class="alert alert-warning">Do you want to delete <?=$nomBut?> ?</p>
                    <a href="./indexBut.php" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-danger" name="delete"> Yes</button>
                </form>
                <?=finconnexion();?>
            </div>
        </div>
    </main>
</body>
</html>