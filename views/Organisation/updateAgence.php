<?php
    //ajout de ma session  et test sur le user est connecte
    require_once "../Fonction/auth_function.php";
    ajoutsession();
    estconnecte();
    $connexion=connexion();
    $erreur=NULL;
    $idReseau=$_SESSION['id_reseau'];

    //je recupere mes poles en prenant d'abord les sections 
    $querySection="SELECT id_section FROM section WHERE id_reseau='$idReseau'";
    $selectSection=odbc_exec($connexion,$querySection);
    while (odbc_fetch_row($selectSection)) {
        $idSections[]=odbc_result($selectSection,'id_section');
    }

    //je verifie l'id passer par l'url
    if (!empty($_GET['id'])) {
        $id=checkInput($_GET['id']);
    }

    //je recupere les info de l'agence liées a l'id
    $queryAgence="SELECT nom_agence,id_pole FROM agence WHERE id_agence='$id'";
    $selectAgence=odbc_exec($connexion,$queryAgence);

    //je fais l'update
    if (!empty($_POST['nomPole']) && !empty($_POST['nomAgence'])) {
        $data=[];
        $data[0]=$_POST['nomAgence'];
        $data[1]=$_POST['nomPole'];
        $queryUpdate="UPDATE agence SET nom_agence='$data[0]' ,id_pole='$data[1]' WHERE id_agence='$id'";
        $update=odbc_exec($connexion,$queryUpdate);
        header('Location: ./indexAgence.php');
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
    <link rel="stylesheet" href="styleAgence.css">
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
                <form action="<?='updateAgence.php?id='.$id?>" method="post" autocomplete="off">
                    <h1>Modify Agency</h1><br>
                    <?php
                        while (odbc_fetch_row($selectAgence)) {
                            $nomAgence=odbc_result($selectAgence,'nom_agence');
                            $id_pole=odbc_result($selectAgence,'id_pole');
                        }
                    ?>
                    <div class="form-group"> 
                        <label for="nomAgence"><h3>Agency Name</h3></label><br>
                        <input type="text" name="nomAgence" id="nomAgence" class="form-control" value="<?=htmlentities($nomAgence);?>"><br>
                        <label for="nomPole"><h3>Pole Name</h3></label><br>
                        <select name="nomPole" id="nomPole" class="form-control">
                            <?php foreach ($idSections as $idSection):?>
                               <?php
                                    $queryPole="SELECT id_pole, nom_pole FROM pole WHERE id_section='$idSection'";
                                    $selectPole=odbc_exec($connexion,$queryPole);
                                ?>
                                <?php while(odbc_fetch_row($selectPole)):?>
                                    <?php
                                        $poleId=odbc_result($selectPole,'id_pole');
                                        $nomPole=odbc_result($selectPole,'nom_pole');
                                    ?>
                                    <?php
                                        $attribute=""; 
                                        if ($poleId == $id_pole){
                                            $attribute="selected='selected'";
                                        }
                                    ?>
                                    <option value="<?=$poleId?>" <?=$attribute?>> <?=$nomPole?> </option>
                                <?php endwhile?>
                            <?php endforeach?>
                        </select>
                    </div>
                    <?=$erreur?><br>
                    <a href="./indexAgence.php" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg> Modify
                    </button>
                </form>
            </div>
        </div>
        <?=finconnexion();?>
    </main>
</body>
</html>