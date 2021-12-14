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

    //je recupere les infos passer par l'id
    $queryId="SELECT nom_section FROM section WHERE id_section='$id'";
    $selectId=odbc_exec($connexion,$queryId);

     //je supprime ici la section
    if (isset($_POST['delete'])) {
        $queryDelete="DELETE FROM section WHERE id_section='$id'";
        $delete=odbc_exec($connexion,$queryDelete);
        header('Location: ./indexSection.php');
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
                <form action="<?='deleteSection.php?id='.$id?>" method="post" autocomplete="off">
                    <h1>Delete Section</h1><br>
                    <?php while (odbc_fetch_row($selectId)):?>
                        <?php $nomSection=odbc_result($selectId,"nom_section");?>
                    <?php endwhile;?>
                    <p class="alert alert-warning">Do you want to delete <?=$nomSection?> ?</p>
                    <a href="./indexSection.php" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-danger" name="delete"> Yes</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>