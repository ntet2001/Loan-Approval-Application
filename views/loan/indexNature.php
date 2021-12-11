<?php
    //ajout de ma session  et test sur le user est connecte
    require_once "../Fonction/auth_function.php";
    ajoutsession();
    estconnecte();
    $connexion=connexion();
    $erreur=NULL;
    $compteur=null;
    $idReseau=$_SESSION['id_reseau'];

    // je recupere le nom du reseau
    $queryReseau="SELECT nom_reseau FROM reseau WHERE id_reseau='$idReseau'";
    $ResultatReseau=odbc_exec($connexion,$queryReseau);
    while (odbc_fetch_row($ResultatReseau)) {
        $nomReseau=odbc_result($ResultatReseau,'nom_reseau');
    }

    //affichage des typePret
    $queryTypeEngagement="SELECT id_type_engagement,nature  FROM type_engagement";
    $resultatTypeEngagement=odbc_exec($connexion,$queryTypeEngagement);

    //insertion d'un nouveau type pret
    if (!empty($_POST['nature'])) {
        $data=[];
        $data[0]=$_POST['nature'];
        $queryInsert="INSERT INTO type_engagement (nature) VALUES('$data[0]')";
        $insert=odbc_exec($connexion,$queryInsert);
        header('Location: ./indexNature.php');
    }else{
        $erreur='<span style="color:red;">Fill All the Inputs</span>';
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
    <link rel="stylesheet" href="../dist/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../connexion/headerAdmin/headerAdmin.css">
    <link rel="stylesheet" href="styleReseau.css">
        <!--call bootstrap javascript-->
    <script src="../dist/jquery/jquery-3.6.0.min.js"></script>
    <script src="../dist/jquery/jquery.dataTables.min.js"></script>
    <script src="../dist/js/bootstrap.js"></script>
    <script src="../dist/js/dataTables.bootstrap4.min.js"></script>
    <script src="../dist/js/popper.min.js"></script>
    <script defer>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
</head>
<body>
    <!---header pour ma navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light  bg-primary fixed-top">
            <div class="container-fluid">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#monMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
               <div class="collapse navbar-collapse" id="monMenu">
                    <li class="nav-item">
                        <a href="../Connexion/administrateur.php" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                                <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                            </svg>  Return Home
                        </a>
                    </li>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                    <span style="color: white;">Code:<?=$_SESSION['code_admin']." <br>".$_SESSION['nom_admin'].'  Reseau: '.$nomReseau?></span>
                </div>
               </div>
            </div>
        </nav>
    </header>
    <!--mon main et tableau--->
    <main class="container">
        <form action="indexNature.php" method="post" style="margin-bottom: 50px;">
            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="nature"><h5>Enter Nature of loan:</h5></label>
                    <input type="text" name="nature" id="nature" class="form-control">
                </div>
            </div> 
            <?php echo "$erreur"?><br>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <div class="row tableau">
            <div class="col">
                <caption><h4 style="text-align: center;">Nature Loan</h4></caption>
                <table id="example" class="table table-hover table-bordered table-triped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nature Loan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while(odbc_fetch_row($resultatTypeEngagement)):?>
                            <?php
                                $idNature=odbc_result($resultatTypeEngagement,'id_type_engagement');    
                                $nature=odbc_result($resultatTypeEngagement,'nature');    
                            ?>
                            <tr>
                                <td><?=$idNature?></td>
                                <td><?=$nature?></td>
                                <td>
                                    <a href=<?="./updateNature.php?id=".$idNature?> class="btn btn-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg> Modify
                                    </a> 
                                    <a href=<?="./deleteNature.php?id=".$idNature?> class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php finconnexion()?>
</body>
</html>