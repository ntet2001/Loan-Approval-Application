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
        if (!empty($_POST['nomReseau'])) {
            function getdata(){
                $data=$_POST['nomReseau'];
                return $data;
                }
                $info=getdata();
                $update="UPDATE reseau SET nom_reseau='$info' WHERE id_reseau='$id';";
                $resultat=odbc_exec($connexion,$update);
                header('Location: ./indexReseau.php');
        }else{
            $erreur='<div class="alert alert-danger">Fill All The Inputs</div>';
        }
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
                <form action="<?='./updateReseau.php?id='.$id?>" method="post">
                    <h1>Modify Network</h1><br>
                    <div class="form-group">
                        <label for="nomReseau"><h3>Network Name</h3></label><br>
                        <input type="text" name="nomReseau" id="nomReseau" class="form-control"placeholder="ex:Name"><br>
                    </div>
                    <a href="./indexReseau.php" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg> Modify
                    </button>
                </form><br>
                <?=$erreur?>
            </div>
        </div>
    </main>
</body>
</html>