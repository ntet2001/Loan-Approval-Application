<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../dist/css/bootstrap.css">
    <?php require_once "headerLoan.php";?>
        <!--call bootstrap javascript-->
    <script src="../dist/jquery/jquery-3.6.0.min.js"></script>
    <script src="../dist/js/bootstrap.js"></script>
    <script src="../dist/js/popper.min.js"></script>
</head>
<body>
    <main class="container" style="margin-top: 90px;">
        <h1 style="text-align: center;">Conformitee of the Loan Initiation</h1>
        <div class="alert alert-warning">Check the conformitee of the Loan request</div>
        <div class="card" style="margin-bottom: 20px; padding-bottom:20px;">
            <div class="formulaire" style="margin-bottom: 20px;">
                <form action="./indexConformite.php" method="post">
                    <div class="row">
                        <!---info client-->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="numClient">Num Customer</label><br>
                                <input type="text" name="numClient" id="numClient" class="form-control" disabled>
                                <label for="nomClient">Name</label><br>
                                <input type="text" name="nomClient" id="nomClient" class="form-control" disabled>
                                <label for="prenomClient">Last Name</label><br>
                                <input type="text" name="prenomClient" id="prenomClient" class="form-control" disabled>
                                <label for="emailClient">Email</label><br>
                                <input type="email" name="emailClient" id="emailClient" class="form-control" disabled>
                                <label for="telephoneClient">Phone Number</label><br>
                                <input type="tel" name="telephoneClient" id="telephoneClient" class="form-control" disabled><br>
                                <label for="document"><strong> Document</strong></label><br>
                                <select name="document" id="document" class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <!---info credit-->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="montantdemande">Amout Asked</label><br>
                                <input type="number" name="montantdemande" id="montantdemande" class="form-control" disabled>
                                <label for="periodicite">Periodicity</label><br>
                                <input type="text" name="periodicite" id="periodicite" class="form-control" disabled>
                                <label for="echeance">deadline</label><br>
                                <input type="number" name="echeance" id="echeance" class="form-control" disabled>
                                <label for="typeCredit">Type Loan</label><br>
                                <input type="text" name="typeCredit" id="typeCredit" class="form-control" disabled>
                                <label for="but">Purpose Loan</label><br>
                                <input type="text" name="but" id="but" class="form-control" disabled><br>
                                <label for="nature">Nature Loan</label><br>
                                <input type="text" name="nature" id="nature" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <a href="./initiation.php" class="btn btn-danger">Reject</a>
                    <button type="submit" class="btn btn-success">Send To Analyst</button>
                </form>
            </div>
            <div id="decision" class="alert alert-warning"></div>
        </div>
    </main>
</body>
</html>