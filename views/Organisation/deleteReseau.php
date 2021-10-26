<?php
    //ajout de ma session et du nom de l'utilisateur dans mon loan header
    session_start();
    if ($_SESSION['connecte']!=1) {
        header('Location: ../../../login.php');
    }
    require_once "../../../auth_function.php";
    $erreur=NULL;
    if (!empty($_GET)) {
        // je recupere l'id du user pour les modifications par l'url
        function checkInput($data)
        {
            $data=trim($data);
            $data=stripslashes($data);
            $data=htmlspecialchars($data);
            return $data;
        }
        $id=checkInput($_GET['id']);

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
    <link rel="stylesheet" href="../../../dist/css/bootstrap.css">
    <link rel="stylesheet" href="../../headerAdmin/headerAdmin.css">
    <link rel="stylesheet" href="styleReseau.css">
        <!--call bootstrap javascript-->
    <script src="../../../dist/jquery/jquery-3.6.0.min.js"></script>
    <script src="../../../dist/js/bootstrap.js"></script>
    <script src="../../../dist/js/popper.min.js"></script>
</head>
<body>
    <main class="container" style="margin-top:100px;">
    <div class="row formulaire">
            <div class="col-lg-6">
                <!--formulaire-->
                <form action="<?="./deleteReseau.php?id=".$id?>" method="post">
                    <h1>Delete Network</h1><br>
                    <p class="alert alert-warning">Do you want to delete it?</p>
                    <a href="./indexReseau.php" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-danger"> Yes</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>