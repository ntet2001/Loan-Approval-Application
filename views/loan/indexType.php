<?php
    //ajout de ma session et du nom de l'utilisateur dans mon loan header
    session_start();
    if ($_SESSION['connecte']!=1) {
        header('Location: ../../../login.php');
    }
    require_once "../../../auth_function.php";
    $select=odbc_exec($connexion,"SELECT [id_type_pret],[nom_type_pret] FROM [db_gestion_credit].[dbo].[type_pret];");
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
    <link rel="stylesheet" href="../../../dist/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../headerAdmin/headerAdmin.css">
    <link rel="stylesheet" href="styleReseau.css">
        <!--call bootstrap javascript-->
    <script src="../../../dist/jquery/jquery-3.6.0.min.js"></script>
    <script src="../../../dist/jquery/jquery.dataTables.min.js"></script>
    <script src="../../../dist/js/bootstrap.js"></script>
    <script src="../../../dist/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../../dist/js/popper.min.js"></script>
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
                        <!--dropdown pour fichier-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Files</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../reseau/indexReseau.php">Network</a>
                            <a class="dropdown-item" href="../section/indexSection.php">Section</a>
                            <a class="dropdown-item" href="../pole/indexPole.php">Pole</a>
                            <a class="dropdown-item" href="../agence/indexAgence.php">Agency</a>
                            <a class="dropdown-item" href="../document/indexDocument.php">Documents</a>
                            <a class="dropdown-item" href="../client/indexClient.php">Customers</a>
                            <a class="dropdown-item" href="#">Type Loan</a>
                            <a class="dropdown-item" href="../butPret/indexbut.php">Purpose Loan</a>
                            <a class="dropdown-item" href="../naturePret/indexNature.php">Nature Loan</a>
                        </div>
                    </li>
                    <!--dropdown pour traitement-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Traitment</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../../../loan/initiation.php">Initiation</a>
                            <a class="dropdown-item" href="../../../loan/indexConformite.php">Confirmation</a>
                            <a class="dropdown-item" href="../../../loan/analyse.php">Analyze</a>
                            <a class="dropdown-item" href="../../../loan/evaluation1.php">1st evaluation</a>
                            <a class="dropdown-item" href="../../../loan/evaluation2.php">2nd evaluation</a>
                            <a class="dropdown-item" href="../../../loan/evaluation3.php">3rd evaluation</a>
                            <a class="dropdown-item" href="../../../loan/manager.php">General Manager</a>
                            <a class="dropdown-item" href="../../../loan/comitee.php">Credit commitee</a>
                            <a class="dropdown-item" href="../../../loan/creditAdmin.php">Credit administration</a>
                        </div>
                    </li>
                    <!--autres liens-->
                    <li class="nav-item"><a href="../../consultation/indexConsultation.php" class="nav-link">Consultation</a></li>
                    <li class="nav-item"><a href="../../analyse/indexAnalyse.php" class="nav-link">Analyzies</a></li>
                    <li class="nav-item"><a href="../../outils/indexOutils.php" class="nav-link">Tools</a></li>
                    <li class="nav-item"><a href="../../administration/indexUser.php" class="nav-link">Administration</a></li>
                    <li class="nav-item">
                        <a href="../../../deconnexion.php" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
                                <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                            </svg>Log Out 
                        </a>
                    </li>
                </div>
            </div>
        </nav>
    </header>
    <!--mon main et tableau--->
    <main class="container">
        <form action="indexType.php" method="post" style="margin-bottom: 50px;">
            <div class="row">
                <div class="form-group col-lg-6">
                    <input type="file" name="importerType" id="importerType">
                </div>
            </div> 
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <div class="row tableau">
            <div class="col">
                <caption><h4 style="text-align: center;">Type Loans</h4></caption>
                <table id="example" class="table table-hover table-bordered table-triped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Type Loan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while (odbc_fetch_row($select)):?>
                                <?php $idpret=odbc_result($select,"id_type_pret");?>
                                <?php $nompret=odbc_result($select,"nom_type_pret");?>
                                <tr>
                                    <td><?=$idpret?></td>
                                    <td><?=$nompret?></td>
                                </tr>
                        <?php endwhile?>
                        <?php odbc_close($connexion);?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>