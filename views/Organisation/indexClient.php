<?php
    //ajout de ma session  et test sur le user est connecte
    require_once "../Fonction/auth_function.php";
    ajoutsession();
    estconnecte();
    $connexion=connexion();
    $erreur=NULL;
    $idReseau=$_SESSION['id_reseau'];

    // je recupere le nom du reseau
    $queryReseau="SELECT nom_reseau FROM reseau WHERE id_reseau='$idReseau'";
    $ResultatReseau=odbc_exec($connexion,$queryReseau);
    while (odbc_fetch_row($ResultatReseau)) {
        $nomReseau=odbc_result($ResultatReseau,'nom_reseau');
    }

    //je recupere mes agences en prenant d'abord les sections puis les poles
    $querySection="SELECT id_section FROM section WHERE id_reseau='$idReseau'";
    $selectSection=odbc_exec($connexion,$querySection);
    while (odbc_fetch_row($selectSection)) {
        $idSections[]=odbc_result($selectSection,'id_section');
    }
    //poles
    foreach ($idSections as $idSection) {
        $queryPole="SELECT id_pole FROM pole WHERE id_section='$idSection'";
        $selectPole=odbc_exec($connexion,$queryPole);
        while (odbc_fetch_row($selectPole)) {
            $idPoles[]=odbc_result($selectPole,'id_pole');
        }
    }

    //j'insere un nouvel utilisateur
    //insertion d'une nouvelle section
    if (!empty($_POST['numClient']) && !empty($_POST['nomClient']) && !empty($_POST['prenomClient']) && !empty($_POST['emailClient']) && !empty($_POST['telephoneClient']) && !empty($_POST['AgenceClient'])) {
        $data=[];
        $data[0]=$_POST['numClient'];
        $data[1]=$_POST['nomClient'];
        $data[2]=$_POST['prenomClient'];
        $data[3]=$_POST['emailClient'];
        $data[4]=$_POST['telephoneClient'];
        $data[5]=$_POST['AgenceClient'];
        $queryInsert="INSERT INTO client (num_client,nom_client,prenom_client,email_client,telephone_client,id_agence)
        VALUES('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]')";
        $insert=odbc_exec($connexion,$queryInsert);
        header('Location: ./indexClient.php');
    }else{
        $erreur='<span style="color:red;"> Fill all inputs</span>';
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
        <nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
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
        </nav>
    </header>
    <!--mon main avec mon Formulaire d'enregistrement-->
    <main class="container" style="margin-bottom: 50px;">
        <h3 style="text-align: center;margin-bottom:50px;">Register Customer</h3>
        <form action="indexClient.php" method="post">
            <div class="row formulaire">
                <div class="col-lg-6 form-group">
                    <label for="numClient">Customer No:</label><br>
                    <input type="text" name="numClient" id="numClient" class="form-control"><br>
                    <label for="nomClient">Custormer Name</label><br>
                    <input type="text" name="nomClient" id="nomClient" class="form-control" placeholder="ex: Doe"><br>
                    <label for="prenomClient">Last Name</label><br>
                    <input type="text" name="prenomClient" id="prenomClient" class="form-control" placeholder="ex: John"><br>
                </div>
                <div class="col-lg-6 form-group">
                    <label for="emailClient">Customer Email</label><br>
                    <input type="email" name="emailClient" id="emailClient" class="form-control" placeholder="Johndoe@gmail.com"><br>
                    <label for="telephoneClient">Custormer Phone</label><br>
                    <input type="tel" name="telephoneClient" id="telephoneClient" class="form-control" placeholder="+237 6xx-xx-xx-xx"><br>
                    <label for="AgenceClient">Agency</label><br>
                    <select name="AgenceClient" id="AgenceClient" class="form-control">
                        <?php foreach ($idPoles as $idpole):?>
                            <?php
                                $queryAgence="SELECT id_agence,nom_agence FROM agence WHERE id_pole='$idpole'";
                                $selectAgence=odbc_exec($connexion,$queryAgence);    
                            ?>
                            <?php while (odbc_fetch_row($selectAgence)):?>
                                <?php
                                    $idAgence=odbc_result($selectAgence,'id_agence');
                                    $nomAgence=odbc_result($selectAgence,'nom_agence');    
                                ?>
                                <option value="<?=$idAgence?>"><?=$nomAgence?></option>
                            <?php endwhile?>
                        <?php endforeach?>
                    </select>
                </div>
            </div>
            <?=$erreur?><br>
            <button type="reset" class="btn btn-primary">Reset</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <div class="row" style="margin-top: 50px;">
            <div class="col">
            <caption><h4 style="text-align: center;">ALL CUSTOMERS</h4></caption>
                <table id="example" class="table table-hover table-bordered table-triped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Customers No:</th>
                            <th>Customers Name</th>
                            <th>Agency Name</th>
                            <th>Customers Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //je recupere les clients de mes agences
                            foreach ($idPoles as $idPole) {
                                $queryAgenceId="SELECT id_agence FROM agence WHERE id_pole='$idPole'";
                                $selectAgenceId=odbc_exec($connexion,$queryAgenceId);
                                while (odbc_fetch_row($selectAgenceId)) {
                                    $idAgences[]=odbc_result($selectAgenceId,'id_agence');
                                }
                            }
                        ?>
                        <?php foreach ($idAgences as $idAgence):?>
                            <?php
                                $queryClient="SELECT id_client, num_client,nom_client,email_client,agence.nom_agence FROM client
                                INNER JOIN agence
                                ON client.id_agence=agence.id_agence
                                WHERE client.id_agence='$idAgence'";
                                $selectClient=odbc_exec($connexion,$queryClient);    
                            ?>
                            <?php while (odbc_fetch_row($selectClient)):?>
                               <?php
                                    $idClient=odbc_result($selectClient,'id_client');
                                    $numClient=odbc_result($selectClient,'num_client');
                                    $nomClient=odbc_result($selectClient,'nom_client');
                                    $emailClient=odbc_result($selectClient,'email_client');
                                    $agenceNom=odbc_result($selectClient,'nom_agence');
                                ?>
                                <tr>
                                    <td><?=$idClient?></td>
                                    <td><?=$numClient?></td>
                                    <td><?=$nomClient?></td>
                                    <td><?=$agenceNom?></td>
                                    <td><?=$emailClient?></td>
                                    <td>
                                    <a href="<?='./updateClient.php?id='.$idClient?>" class="btn btn-warning">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg> Modify
                                        </a> 
                                        <a href="<?='./deleteClient.php?id='.$idClient?>" class="btn btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile?>
                        <?php endforeach?>        
                    </tbody>
                </table>
                <?=finconnexion();?>
            </div>
        </div>
    </main>
</body>
</html>