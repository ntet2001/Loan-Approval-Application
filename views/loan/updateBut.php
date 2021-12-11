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
    $queryId="SELECT nom_but,id_type_engagement FROM but WHERE id_but='$id'";
    $selectId=odbc_exec($connexion,$queryId);
    while(odbc_fetch_row($selectId)){
        $nomBut=odbc_result($selectId,'nom_but');
        $typeEngagementId=odbc_result($selectId,'id_type_engagement');
    }
    
    //je selectionne les type engagement
    $queryTypeEngagement="SELECT id_type_engagement,nature FROM type_engagement";
    $resultatTypeEngagement=odbc_exec($connexion,$queryTypeEngagement);

    //je fais l'update
    if (!empty($_POST['but']) && !empty($_POST['typeEngagement'])) {
        $data=[];
        $data[0]=$_POST['but'];
        $data[1]=$_POST['typeEngagement'];
        $queryUpdate="UPDATE but SET nom_but='$data[0]', id_type_engagement='$data[1]' WHERE id_but='$id'";
        $update=odbc_exec($connexion,$queryUpdate);
        header('Location: ./indexBut.php');
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
                <form action="<?='updateBut.php?id='.$id?>" method="post">
                    <h1>Modify Type Loan</h1><br>
                    <div class="form-group">
                        <label for="but"><h5>Enter purpose Loan:</h5></label>
                        <input type="text" name="but" id="but" class="form-control" value="<?=htmlentities($nomBut)?>"><br>
                        <label for="typeEngagement"><h5>Enter type Engagement:</h5></label>
                        <select name="typeEngagement" id="typeEngagement" class="form-control">
                            <?php while (odbc_fetch_row($resultatTypeEngagement)):?>
                                <?php $attribut=null?>
                                <?php
                                    $idTypeEngagement=odbc_result($resultatTypeEngagement,'id_type_engagement');    
                                    $nomTypeEngagement=odbc_result($resultatTypeEngagement,'nature');    
                                ?>
                                <?php
                                    if($idTypeEngagement == $typeEngagementId){
                                        $attribut='selected="selected"';
                                    }
                                ?>
                                <option value="<?=$idTypeEngagement?>" <?=$attribut?>> <?=$nomTypeEngagement?> </option>
                                <?php endwhile?>
                        </select>
                    </div>
                    <?=$erreur?><br>
                    <a href="./indexBut.php" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg> Modify
                    </button>
                </form>
                <?=finconnexion();?>
            </div>
            <div class="col-lg-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="auto" height="auto" fill="currentColor" class="bi bi-currency-exchange" viewBox="0 0 16 16">
                    <path d="M0 5a5.002 5.002 0 0 0 4.027 4.905 6.46 6.46 0 0 1 .544-2.073C3.695 7.536 3.132 6.864 3 5.91h-.5v-.426h.466V5.05c0-.046 0-.093.004-.135H2.5v-.427h.511C3.236 3.24 4.213 2.5 5.681 2.5c.316 0 .59.031.819.085v.733a3.46 3.46 0 0 0-.815-.082c-.919 0-1.538.466-1.734 1.252h1.917v.427h-1.98c-.003.046-.003.097-.003.147v.422h1.983v.427H3.93c.118.602.468 1.03 1.005 1.229a6.5 6.5 0 0 1 4.97-3.113A5.002 5.002 0 0 0 0 5zm16 5.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0zm-7.75 1.322c.069.835.746 1.485 1.964 1.562V14h.54v-.62c1.259-.086 1.996-.74 1.996-1.69 0-.865-.563-1.31-1.57-1.54l-.426-.1V8.374c.54.06.884.347.966.745h.948c-.07-.804-.779-1.433-1.914-1.502V7h-.54v.629c-1.076.103-1.808.732-1.808 1.622 0 .787.544 1.288 1.45 1.493l.358.085v1.78c-.554-.08-.92-.376-1.003-.787H8.25zm1.96-1.895c-.532-.12-.82-.364-.82-.732 0-.41.311-.719.824-.809v1.54h-.005zm.622 1.044c.645.145.943.38.943.796 0 .474-.37.8-1.02.86v-1.674l.077.018z"/>
                </svg>
            </div>
        </div>
    </main>
</body>
</html>