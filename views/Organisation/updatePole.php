<?php
    //ajout de ma session  et test sur le user est connecte
    require_once "../Fonction/auth_function.php";
    ajoutsession();
    estconnecte();
    $connexion=connexion();
    $erreur=NULL;
    $idReseau=$_SESSION['id_reseau'];

    //je charge les differentes sections
    //je recupere les sections liees a l'id du reseau de l'utilisateur
    $querySection="SELECT id_section, nom_section FROM section WHERE id_reseau='$idReseau'";
    $Resultatsection=odbc_exec($connexion,$querySection);

    //je verifie l'id passer par l'url
    if (!empty($_GET['id'])) {
        $id=checkInput($_GET['id']);
    }


    //je recupere les infos passer par l'id
    $queryId="SELECT nom_pole,id_section FROM pole WHERE id_pole='$id'";
    $selectId=odbc_exec($connexion,$queryId);

    //je fais l'update
    if (!empty($_POST['nomPole']) && !empty($_POST['nomSection'])) {
        $data=[];
        $data[0]=$_POST['nomPole'];
        $data[1]=$_POST['nomSection'];
        $queryUpdate="UPDATE pole SET nom_pole='$data[0]', id_section='$data[1]' WHERE id_pole='$id'";
        $update=odbc_exec($connexion,$queryUpdate);
        header('Location: ./indexPole.php');
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
    <link rel="stylesheet" href="stylePole.css">
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
                <form action="<?='updatePole.php?id='.$id?>" method="post" autocomplete="off">
                    <h1>Modify Pole</h1><br>
                    <div class="form-group">
                        <?php
                            while (odbc_fetch_row($selectId)) {
                                $nomPole=odbc_result($selectId,'nom_pole');
                                $sectionId=odbc_result($selectId,'id_section');
                            }
                        ?>
                        <label for="nomPole"><h3>Pole Name</h3></label><br>
                        <input type="text" name="nomPole" id="nomPole" class="form-control" value="<?=htmlentities($nomPole)?>"><br>
                        <label for="nomSection"><h3>Section Name</h3></label><br>
                        <select name="nomSection" id="nomSection" class="form-control">
                            <!-- j'affiche les differentes section en selectionnant celle de l'utilisateur -->
                            <?php while(odbc_fetch_row($Resultatsection)):?>
                                <?php $attribute='';?>
                                <?php
                                    $idSection=odbc_result($Resultatsection,'id_section');
                                    $nomSection=odbc_result($Resultatsection,'nom_section');
                                ?>
                                <?php 
                                    if ($sectionId == $idSection){
                                        $attribute="selected='selected'";
                                    }
                                ?>
                                <option value="<?=$idSection?>" <?=$attribute?>> <?=$nomSection?> </option>
                            <?php endwhile;?>
                        </select>
                    </div>
                    <?=$erreur?><br>
                    <a href="./indexPole.php" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg> Modify
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>