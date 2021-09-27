<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--link call bootstrap css-->
    <link rel="stylesheet" href="../../dist/css/bootstrap.css">
    <link rel="stylesheet" href="../headerAdmin/headerAdmin.css">
        <!--call bootstrap javascript-->
    <script src="../../dist/jquery/jquery-3.6.0.min.js"></script>
    <script src="../../dist/js/bootstrap.js"></script>
    <script src="../../dist/js/popper.min.js"></script>
</head>
<body>
    <!---header pour ma navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
            <div class="container-fluid">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#monMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!--dropdown pour fichier-->
                <div class="collapse navbar-collapse" id="monMenu">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Files</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../fichier/reseau/indexReseau.php">Network</a>
                        <a class="dropdown-item" href="../fichier/section/indexSection.php">Section</a>
                        <a class="dropdown-item" href="../fichier/pole/indexPole.php">Pole</a>
                        <a class="dropdown-item" href="../fichier/agence/indexAgence.php">Agency</a>
                        <a class="dropdown-item" href="../fichier/document/indexDocument.php">Documents</a>
                        <a class="dropdown-item" href="../fichier/client/indexClient.php">Customers</a>
                        <a class="dropdown-item" href="../fichier/typePret/indexType.php">Type Loan</a>
                        <a class="dropdown-item" href="../fichier/butPret/indexbut.php">Purpose Loan</a>
                        <a class="dropdown-item" href="../fichier/naturePret/indexNature.php">Nature Loan</a>
                    </div>
                </li>
                 <!--dropdown pour traitement-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Traitment</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../../loan/initiation.php">Initiation</a>
                        <a class="dropdown-item" href="../../loan/indexConformite.php">Confirmation</a>
                        <a class="dropdown-item" href="../../loan/analyse.php">Analyze</a>
                        <a class="dropdown-item" href="../../loan/evaluation1.php">1st evaluation</a>
                        <a class="dropdown-item" href="../../loan/evaluation2.php">2nd evaluation</a>
                        <a class="dropdown-item" href="../../loan/evaluation3.php">3rd evaluation</a>                        <a class="dropdown-item" href="../../loan/manager.php">Manager</a>
                        <a class="dropdown-item" href="../../loan/comitee.php">Credit commitee</a>
                        <a class="dropdown-item" href="../../loan/creditAdmin.php">Credit administration</a>
                    </div>
                </li>
                 <!--autres liens-->
                <li class="nav-item"><a href="../consultation/indexConsultation.php" class="nav-link">Consultation</a></li>
                <li class="nav-item"><a href="../analyse/indexAnalyse.php" class="nav-link">Analyzies</a></li>
                <li class="nav-item"><a href="../outils/indexOutils.php" class="nav-link">Tools</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Administration</a></li>
                <li class="nav-item"><a href="../../deconnexion.php" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
  <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
</svg>Log Out </a></li>
                </div>
            </div>
        </nav>
    </header>
    <main class="container">
        <h1 style="margin-bottom: 20px;">Register User </h1>
        <div class="row formulaire">
            <div class="col-lg-6">
                <form action="indexUser.php" method="post">
                    <div class="form-group">
                        <label for="profile">Profile</label><br>
                        <input type="text" name="profile" id="profile" class="form-control"><br>
                        <label for="password">Password</label><br>
                        <input type="password" name="password" id="password" class="form-control"><br>
                        <label for="confirmPassword">Confirm Password</label><br>
                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                    <a href="./viewUser.php" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
</svg> View Profiles</a>
                </form>
            </div>
        </div>
    </main>
</body>
</html>