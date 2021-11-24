<?php
    //on demarre la session et la connexion
    require_once "../Fonction/auth_function.php";
    $connexion=connexion();
    $erreur=NULL;

    //ici je teste que les champs sont non vides
    if(!empty($_POST['nom']) && !empty($_POST['password'])){
        // je teste la taille du champs password
        if(strlen($_POST['password']) < 8){
            $erreur='<span style="color:red;">08 characters are Required for the password</span>';
        }else{
            $user=[];
            $user[0]=$_POST['password'];
            $user[1]=$_POST['nom'];

            //je teste ici si c'est un user dans la bd
            $queryUser="SELECT id_user,id_reseau,id_section,id_pole,id_agence,id_profil FROM users
            WHERE nom_user='$user[1]' AND mdp='$user[0]'";
            $resultatUser=odbc_exec($connexion,$queryUser);

            //je teste ici si c'est un administrateur
            $queryAdmin="SELECT id_reseau,code_admin,nom_admin FROM reseau 
            WHERE nom_admin='$user[1]' AND mdp_admin='$user[0]'";
            $resultatAdmin=odbc_exec($connexion,$queryAdmin);

            //je recupere les infos du user ou de l'administrateur
            if (odbc_fetch_row($resultatUser) == true){
                ajoutsession();
                $_SESSION['id_user']=odbc_result($resultatUser,'id_user');
                $_SESSION['id_reseau']=odbc_result($resultatUser,'id_reseau');
                $_SESSION['id_section']=odbc_result($resultatUser,'id_section');
                $_SESSION['id_pole']=odbc_result($resultatUser,'id_pole');
                $_SESSION['id_agence']=odbc_result($resultatUser,'id_agence');
                $_SESSION['nom_user']=$user[1];
                $id_profil=odbc_result($resultatUser,'id_profil');

                //je recupere le profil de l'utilisateur
                $queryProfil="SELECT nom_profil FROM profil WHERE id_profil='$id_profil'";
                $resultatProfil=odbc_exec($connexion,$queryProfil);
                while (odbc_fetch_row($resultatProfil)) {
                    $_SESSION['nom_profil']=odbc_result($resultatProfil,'nom_profil');
                }
                
                //je recupere les menus du user
                $queryMenu="SELECT nom_menu FROM profil_menu
                INNER JOIN menu
                ON profil_menu.id_menu= menu.id_menu
                WHERE id_profil='$id_profil'";
                $resultatMenu=odbc_exec($connexion,$queryMenu);
                while (odbc_fetch_row($resultatMenu)) {
                    $menu[]=odbc_result($resultatMenu,'nom_menu');
                }
                $_SESSION['menu']=$menu;
                $_SESSION['connecte'] = 1;
                //je redirige vers l'acceuil des users
                header('Location: indexAdminUser.php');
                
            }else if(odbc_fetch_row($resultatAdmin) == true){
                ajoutsession();
                $sections[]=null;
                $poles[]=null;
                $agences[]=null;
                //je recupere les infos du reseau
                $id_reseau=odbc_result($resultatAdmin,'id_reseau');
                $_SESSION['code_admin']=odbc_result($resultatAdmin,'code_admin');
                $_SESSION['nom_admin']=odbc_result($resultatAdmin,'nom_admin');

                //je recupere les id des sections
                $querySection="SELECT id_section FROM section WHERE id_reseau='$id_reseau'";
                $resultatSection=odbc_exec($connexion,$querySection);
                while (odbc_fetch_row($resultatSection)) {
                    $sections[]=odbc_result($resultatSection,'id_section');
                }
                
                //je recupere les id des poles
                foreach ($sections as $section) {
                    $queryPole="SELECT id_pole FROM pole WHERE id_section='$section'";
                    $resultatPole=odbc_exec($connexion,$queryPole);
                    while (odbc_fetch_row($resultatPole)) {
                        $poles[]=odbc_result($resultatPole,'id_pole');
                    }
                }

                //je recupere les id des agences
                foreach ($poles as $pole) {
                    $queryAgence="SELECT id_agence FROM agence WHERE id_pole='$pole'";
                    $resultatAgence=odbc_exec($connexion,$queryAgence);
                    while (odbc_fetch_row($resultatAgence)) {
                        $agences[]=odbc_result($resultatAgence,'id_agence');
                    }
                }
                $_SESSION['id_reseau']=$id_reseau;
                $_SESSION['id_sections']=$sections;
                $_SESSION['id_poles']=$poles;
                $_SESSION['id_agences']=$agences;
                $_SESSION['connecte'] = 1;
                header('Location: administrateur.php');
            }
            else{
                $erreur='<span style="color:red;">Verified your informations </span>';
            }
            
               
        }
    }else{
        $erreur='<span style="color:red;"> Fill all the inputs </span>';
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
                    <!-- message de verification des champs -->
                    <?=$erreur;?>
                    <!-- //ferme la connexion -->
                    <?=finconnexion();?>
                    <div id="verificationmdp"></div><br>
                    <button type="submit" class="btn btn-primary ">Sign in</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>