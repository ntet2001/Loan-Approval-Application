<?php
    //on demarre la session et la connexion
    require_once "../Fonction/auth_function.php";
    ajoutsession();
    $connexion=connexion();
    $erreur=NULL;

    //je charge les champs select
    $queryAgence="SELECT id_agence,nom_agence FROM agence";
    $queryProfil="SELECT id_profil,nom_profil FROM profil";
    $selectAgence=odbc_exec($connexion,$queryAgence);
    $selectProfil=odbc_exec($connexion,$queryProfil);

    //ici je teste que les champs sont non vides
    if(!empty($_POST['nom']) && !empty($_POST['password']) && !empty($_POST['profil']) && !empty($_POST['agence'])){
        // je teste la tailledu champs password
        if(strlen($_POST['password']) < 8){
            $erreur='<div class="alert alert-danger">08 characters are Required for the password</div>';
        }else{
            $user=[];
            $user[0]=$_POST['agence'];
            $user[1]=$_POST['profil'];
            $user[2]=$_POST['password'];
            $user[3]=$_POST['nom'];

            //je teste ici si le user existe bien dans la bd
            $query="SELECT DISTINCT users.id_user 
            FROM users INNER JOIN agence
            ON users.id_agence='$user[0]'
            INNER JOIN profil
            ON users.id_profil='$user[1]'
            WHERE mdp='$user[2]' AND nom_user='$user[3]'";
            $resultat=odbc_exec($connexion,$query);
            
            //je redirige si les infos existent dans la bd
            if(odbc_fetch_row($resultat)){
                while (odbc_fetch_row($resultat)) {
                    $_SESSION['id']=odbc_result($resultat,'id_user');
                }
                //ferme la connexion
                finconnexion();
                $_SESSION['agence']=$user[0];
                $_SESSION['profil']=$user[1];
                $_SESSION['nom']=$user[3];
                $_SESSION['connecte']=1;
                header('Location: ./indexAdmin.php');
            }else{
                $erreur='<div class="alert alert-danger">Verified informations you gived are corrects </div>';
            }
               
        }
    }else{
        $erreur='<div class="alert alert-danger"> Fill All The Inputs </div>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--page style-->
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./indexLogin.css">
    <!---page js-->
    <script src="./connexion.js" defer></script>
</head>
<body id="body">
    <!--ma div principale-->
    <div class="container-fluid col-md-12 col-sm-12 col-xs-12 col-lg-6">
        <h1>LOGIN</h1>
        <div class="row">
            <div class="col">
                <!--mon formulaire-->
                <form action="login.php" method="post" class="formulaire">
                    <div class="profile form-group">
                        <label for="nom">Nom:</label><br>
                        <input type="text" name="nom" id="nom" class="form-control" placeholder="Enter Your Username">
                    </div>
                    <div class="password form-group">
                        <label for="password">Password:</label><br>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password" maxlength="8">
                    </div>
                    <div class="profil form-group">
                        <label for="profil">Select Profile:</label><br>
                        <select name="profil" id="profil" class="form-control">
                            <!-- j'affiche les differents profils -->
                            <?php while(odbc_fetch_row($selectProfil)):?>
                                <?php
                                    $idprofil=odbc_result($selectProfil,'id_profil');
                                    $nomprofil=odbc_result($selectProfil,'nom_profil');    
                                ?>
                                <option value="<?=$idprofil;?>"><?=$nomprofil;?></option>
                            <?php endwhile;?>  
                        </select>
                    </div>
                    <div class="agence form-group">
                        <label for="agence">Select Agency:</label><br>
                        <select name="agence" id="agence" class="form-control">
                            <!-- j'affiche les differents agences -->
                            <?php while(odbc_fetch_row( $selectAgence)):?>
                                <?php
                                    $idagence=odbc_result($selectAgence,'id_agence');
                                    $nomagence=odbc_result($selectAgence,'nom_agence');    
                                ?>
                                <option value="<?=$idagence;?>"><?=$nomagence;?></option>
                            <?php endwhile;?>    
                        </select>
                    </div>
                    <!-- message de verification des champs -->
                    <?=$erreur?>
                    <div id="verificationmdp"></div><br>
                    <button type="submit" class="btn btn-primary ">Sign in</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>