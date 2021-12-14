<?php
    //ajout de ma session  et test sur le user est connecte
    require_once "../Fonction/auth_function.php";
    ajoutsession();
    estconnecte();
    $connexion=connexion();
    $erreur=NULL;
    $idReseau=$_SESSION['id_reseau'];
    // je recupere le nom du reseau
    $queryReseau="SELECT nom_reseau FROM reseau WHERE id_reseau='$idReseau'";
    $ResultatReseau=odbc_exec($connexion,$queryReseau);
    while (odbc_fetch_row($ResultatReseau)) {
        $nomReseau=odbc_result($ResultatReseau,'nom_reseau');
    }

    //je verifie l'id passer par l'url
    if (!empty($_GET['id'])) {
        $id=checkInput($_GET['id']);
    }


    //je recupere les infos passer par l'id
    $queryId="SELECT nom_section
    FROM section
    WHERE id_section='$id'";
    $selectId=odbc_exec($connexion,$queryId);

    //je fais l'update
    if (!empty($_POST['nomSection']) && !empty($_POST['nomReseau'])) {
        $data=[];
        $data[0]=$_POST['nomSection'];
        $data[1]=$_POST['nomReseau'];
        $queryUpdate="UPDATE section SET nom_section='$data[0]', id_reseau='$data[1]' WHERE id_section='$id'";
        $update=odbc_exec($connexion,$queryUpdate);
        header('Location: ./indexSection.php');
    }else{
        $erreur='<span style="color:red;"> Fill all Inputs</span>';
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
    <link rel="stylesheet" href="../../headerAdmin/headerAdmin.css">
    <link rel="stylesheet" href="styleSection.css">
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
                <form action="<?='updateSection.php?id='.$id?>" method="post" autocomplete="off">
                    <h1>Modify Section</h1><br>
                    <div class="form-group">
                        <!-- je recupere les elements de l'id -->
                        <?php while (odbc_fetch_row($selectId)):?>
                            <?php $nomSection=odbc_result($selectId,"nom_section");?>
                        <?php endwhile;?>
                        <label for="nomSection"><h3>Section Name</h3></label><br>
                        <input type="text" name="nomSection" id="nomSection" class="form-control" value="<?=$nomSection?>"><br>
                        <label for="nomReseau"><h3>Network Name</h3></label><br>
                        <!-- j'affiche les reseau et selectionne le reseau de l'id -->
                        <select name="nomReseau" id="nomReseau" class="form-control">
                            <option value="<?=$idReseau?>"> <?=$nomReseau?> </option>
                        </select>
                    </div>
                    <a href="./indexSection.php" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg> Modify
                    </button>
                    <?=$erreur?>
                    <!-- je ferme la connexion -->
                    <?=finconnexion();?>
                </form>
            </div>
        </div>
    </main>
</body>
</html>