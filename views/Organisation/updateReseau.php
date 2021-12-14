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

    //je selectionne les infos correspondant a l'id
    $querySelect="SELECT nom_reseau,nom_admin FROM reseau WHERE id_reseau='$id'";
    $select=odbc_exec($connexion,$querySelect);
        
    if (!empty($_POST['nomReseau']) && isset($_POST['update']) && !empty($_POST['password']) &&!empty($_POST['nomAdmin'])) {
        if (strlen($_POST['password']) == 8) {
            $data=[];
            $data[0]=$_POST['nomReseau'];
            $data[1]=strtolower($_POST['nomAdmin']);
            $data[2]=strtolower($_POST['password']);
            $pwd=password_hash($data[2],PASSWORD_DEFAULT,['cost' => 14]);
            if (password_verify($data[2],$pwd)) {
                $queryUpdate="UPDATE reseau SET nom_reseau='$data[0]',nom_admin='$data[1]',mdp_admin='$data[2]' WHERE id_reseau='$id';";
                $update=odbc_exec($connexion,$queryUpdate);
                header('Location: ./indexReseau.php');   
            }
        }else{
            $erreur='<span style="color:red;">Password Shall Be 08 characters</span>';
        }
    }else{
        $erreur='<span style="color:red;">Fill All The Inputs</span>';
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
                <form action="<?='./updateReseau.php?id='.$id?>" method="post" autocomplete="off">
                    <h1>Modify Network</h1><br>
                    <div class="form-group">
                        <?php while(odbc_fetch_row($select)):?>
                            <?php
                                $nomReseau=odbc_result($select,'nom_reseau');
                                $nomAdmin=odbc_result($select,'nom_admin');
                            ?>
                        <?php endwhile;?>
                        <label for="nomReseau"><h4>Network Name</h4></label><br> 
                        <input type="text" name="nomReseau" id="nomReseau" class="form-control" value="<?=htmlentities($nomReseau)?>" ><br>
                        <label for="nomAdmin"><h4>Network AdminName</h4></label><br>
                        <input type="text" name="nomAdmin" id="nomAdmin" class="form-control" value="<?=htmlentities($nomAdmin)?>" ><br> 
                        <label for="password"><h4>Password Admin</h4></label><br>
                        <input type="password" name="password" id="password" class="form-control" maxlength="8">   
                    </div>
                    <a href="./indexReseau.php" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-success" name="update">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg> Modify
                    </button>
                </form><br>
                <?=$erreur?>
                <!-- fermeture de la connexion -->
                <?=finconnexion();?>
            </div>
        </div>
    </main>
</body>
</html>