<?php
// j'appel la connexion a la bd
    require_once './auth_function.php';
    $erreur=NULL; // ici c'est mon message d'erreur qui y sera stocker
    $id=NULL;

    //et je verifie le remplissage des champs
    if (!empty($_POST['profile']) && !empty($_POST['password']) ) {
        $profile=$_POST['profile'];
        $password=$_POST['password'];

        //je verifie ici la taille du mot de passe
        if (strlen($password)<8) {
            $erreur= '<div class="alert alert-danger">PASSWORD SHALL BE 08 CHARACTERS </div>';
        }else{
            // je recupere et verifie le profile et mdp du user
            $resultat=odbc_exec($connexion,"SELECT [id_users] FROM [db_gestion_credit].[dbo].[users] WHERE [users_profile]='$profile' AND [mdp]='$password';");
            while (odbc_fetch_row($resultat)) {
                $id=odbc_result($resultat,"id_users");
            }
            //je fais la redirection ou mot de passe incorrect
            if ($id) {
                session_start();
                $_SESSION['user']="$profile";
                $_SESSION['id']=$id;
                $_SESSION['connecte']=1;
                //redirection en fonction du profile
                if ($profile == 'administrateur') {
                   header('Location:  ./admin/indexAdmin.php');
                   exit();
                }elseif($profile=='initiateur'){
                    header('Location:  ./loan/initiation.php');
                    exit();
                }elseif($profile=='conformite'){
                    header('Location:  ./loan/indexConformite.php');
                    exit();
                }elseif($profile=='analyste'){
                    header('Location:  ./loan/analyste.php');
                    exit();
                }elseif($profile=='conformite'){
                    header('Location:  ./loan/indexConformite.php');
                    exit();
                }
            }else{
                $erreur= '<div class="alert alert-danger"> ERROR ON PROFILE OR PASSWORD </div>';
            }
        }
    }else{
       $erreur= '<div class="alert alert-danger"> FILL ALL INPUTS </div>';
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
    <link rel="stylesheet" href="./dist/css/bootstrap.css"/>
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
                        <label for="profile">Profile</label><br>
                        <input type="text" name="profile" id="profile" class="form-control" placeholder="Enter Your Profile">
                    </div>
                    <div class="password form-group">
                        <label for="password">Password</label><br>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password" maxlength="8">
                    </div>
                    <div id="verificationmdp"></div><br>
                    <?=$erreur?>
                    <button type="submit" class="btn btn-primary ">Sign in</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>