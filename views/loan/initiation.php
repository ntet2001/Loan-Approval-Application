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
    <main class="container" style="margin-top: 80px;">
        <h1 style="text-align: center;margin-bottom:40px;">INITIALIZE THE LOAN</h1>
        <div class="formulaire">
            <form action="./initiation.php" method="post" style="padding-bottom: 40px;">
                <div class="row">
                    <!--info client--->
                    <div class="col-lg-6">
                        <h3>Custormer Informations</h3>
                        <div class="form-group">
                            <label for="numClient">Num Customer</label><br>
                            <input type="text" name="numClient" id="numClient" class="form-control">
                            <label for="nomClient">Name</label><br>
                            <input type="text" name="nomClient" id="nomClient" class="form-control">
                            <label for="prenomClient">Last Name</label><br>
                            <input type="text" name="prenomClient" id="prenomClient" class="form-control">
                            <label for="emailClient">Email</label><br>
                            <input type="email" name="emailClient" id="emailClient" class="form-control">
                            <label for="telephoneClient">Phone Number</label><br>
                            <input type="tel" name="telephoneClient" id="telephoneClient" class="form-control"><br>
                            <label for="document"><strong> Document</strong></label>
                            <input type="file" name="document" id="document" multiple="multiple">
                        </div>
                    </div>
                    <!--info credit--->
                    <div class="col-lg-6">
                    <h3>Loan Informations</h3>
                        <div class="form-group">
                            <label for="montantdemande">Amout Asked</label><br>
                            <input type="number" name="montantdemande" id="montantdemande" class="form-control">
                            <label for="periodicite">Periodicity</label><br>
                            <input type="text" name="periodicite" id="periodicite" class="form-control">
                            <label for="echeance">deadline</label><br>
                            <input type="number" name="echeance" id="echeance" class="form-control">
                            <label for="typeCredit">Type Loan</label><br>
                            <input type="text" name="typeCredit" id="typeCredit" class="form-control">
                            <label for="but">Purpose Loan</label><br>
                            <input type="text" name="but" id="but" class="form-control"><br>
                            <label for="nature">Nature Loan</label><br>
                            <input type="text" name="nature" id="nature" class="form-control">
                        </div>
                    </div>
                </div>
                <button type="reset" class="btn btn-danger">Reset</button>
                <a href="./indexConformite.php" class="btn btn-success">Send to Confirmation</a>
            </form>
        </div>
    </main>
</body>
</html>