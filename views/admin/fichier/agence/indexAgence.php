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
    <link rel="stylesheet" href="styleAgence.css">
        <!--call bootstrap javascript-->
    <script src="../../../dist/jquery/jquery-3.6.0.min.js"></script>
    <script src="../../../dist/js/bootstrap.js"></script>
    <script src="../../../dist/js/popper.min.js"></script>
</head>
<body>
    <!---header pour ma navbar -->
    <header>
        <nav class="navbar  navbar-expand-lg navbar-light bg-primary fixed-top">
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
                        <a class="dropdown-item" href="#">Agency</a>
                        <a class="dropdown-item" href="../document/indexDocument.php">Documents</a>
                        <a class="dropdown-item" href="../client/indexClient.php">Customers</a>
                        <a class="dropdown-item" href="../typePret/indexType.php">Type Loan</a>
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
                        <a class="dropdown-item" href="../../../loan/risque.php">Risk</a>
                        <a class="dropdown-item" href="../../../loan/manager.php">Manager</a>
                        <a class="dropdown-item" href="../../../loan/comitee.php">Credit commitee</a>
                        <a class="dropdown-item" href="../../../loan/creditAdmin.php">Credit administration</a>
                    </div>
                </li>
                 <!--autres liens-->
                <li class="nav-item"><a href="../../consultation/indexConsultation.php" class="nav-link">Consultation</a></li>
                <li class="nav-item"><a href="../../analyse/indexAnalyse.php" class="nav-link">Analyzies</a></li>
                <li class="nav-item"><a href="../../outils/indexOutils.php" class="nav-link">Tools</a></li>
                <li class="nav-item"><a href="../../administration/indexUser.php" class="nav-link">Administration</a></li>
                <li class="nav-item"><a href="../../../deconnexion.php" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
  <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
</svg>Log Out </a></li>
                </div>
            </div>
        </nav>
    </header>
    <!--main de mon fichier avec formulaire et tableau-->
    <main class="container">
        <!---Formulaire-->
        <div class="row formulaire">
            <div class="col-lg-6">
                <form action="indexAgence.php" method="post">
                    <div class="form-group">
                        <label for="nomAgence"><h3>Agency Name</h3></label><br>
                        <input type="text" name="nomAgence" id="nomAgence" class="form-control" placeholder="Name"><br>
                        <label for="nomPole"><h3>Pole Name</h3></label><br>
                        <select name="nomPole" id="nomPole" class="form-control">
                            <option value="NTA">1 NTA</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-primary">Reset</button>
                </form>
            </div>
        </div>
        <!----tableau---->
        <div class="row tableau">
            <div class="col">
                <caption><h4>ALL AGENCIES</h4></caption>
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Agency Name</th>
                            <th>Pole Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>OTA</td>
                            <td>NTA</td>
                            <td><a href="./updateAgence.php" class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
</svg> Modify</a> <a href="./deleteAgence.php" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg> Delete</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>