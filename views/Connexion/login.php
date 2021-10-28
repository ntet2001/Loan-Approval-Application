<?php

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
                               
                        </select>
                    </div>
                    <div class="agence form-group">
                        <label for="agence">Select Agency:</label><br>
                        <select name="agence" id="agence" class="form-control">
                               
                        </select>
                    </div>
                    <div id="verificationmdp"></div><br>
                    <button type="submit" class="btn btn-primary ">Sign in</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>