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
            <div class="formulaire" style="margin-bottom: 20px;">
                <form action="./indexConformite.php" method="post">
                    <div class="row">
                        <!---info client-->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="check_1">
                                    <label for="numClient"><strong>Num Customer</strong></label><br>
                                    <input type="text" name="numClient" id="numClient" class="form-control" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite1" class="conformite"><br>
                                </div>
                                <div class="check_2">
                                    <label for="nomClient"><strong>Name</strong></label><br>
                                    <input type="text" name="nomClient" id="nomClient" class="form-control" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite2" class="conformite"><br>
                                </div>
                                <div class="check_3">
                                    <label for="prenomClient"><strong>Last Name</strong></label><br>
                                    <input type="text" name="prenomClient" id="prenomClient" class="form-control" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite3" class="conformite"><br> 
                                </div>
                                <div class="check_4">
                                    <label for="emailClient"><strong>Email</strong></label><br>
                                    <input type="email" name="emailClient" id="emailClient" class="form-control" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite4" class="conformite"><br>
                                </div>
                                <div class="check_5">
                                    <label for="telephoneClient"><strong>Phone Number</strong></label><br>
                                    <input type="tel" name="telephoneClient" id="telephoneClient" class="form-control" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite5" class="conformite"><br>
                                </div>
                                <div class="check_6">
                                    <label for="document"><strong> Document</strong></label><br>
                                    <select name="document" id="document" class="form-control">
                                        <option value=""></option>
                                    </select>
                                    <input type="checkbox" name="conformite[]" id="conformite6" class="conformite"><br>
                                </div>
                            </div>
                        </div>
                        <!---info credit-->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="check_1">
                                    <label for="montantdemande"><strong>Amout Asked</strong></label><br>
                                    <input type="number" name="montantdemande" id="montantdemande" class="form-control" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite7" class="conformite"><br>
                                </div>
                                <div class="check_2">
                                    <label for="periodicite"><strong>Periodicity</strong></label><br>
                                    <input type="text" name="periodicite" id="periodicite" class="form-control" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite8" class="conformite"><br>
                                </div>
                                <div class="check_3">
                                    <label for="echeance"><strong>deadline</strong></label><br>
                                    <input type="number" name="echeance" id="echeance" class="form-control" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite9" class="conformite"><br>
                                </div>
                                <div class="check_4">
                                    <label for="typeCredit"><strong>Type Loan</strong></label><br>
                                    <input type="text" name="typeCredit" id="typeCredit" class="form-control" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite10" class="conformite"><br>
                                </div>
                                <div class="check_5">
                                    <label for="but"><strong>Purpose Loan</strong></label><br>
                                    <input type="text" name="but" id="but" class="form-control" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite11" class="conformite"><br>
                                </div>
                                <div class="check_6">
                                    <label for="nature"><strong>Nature Loan</strong></label><br>
                                    <input type="text" name="nature" id="nature" class="form-control" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite12" class="conformite"><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button id="checkbtn" class="btn btn-primary" style="margin-bottom: 10px;">Checked the Request</button>
                    <div id="decision"></div>
                    <a href="./initiation.php" class="btn btn-danger">Reject</a>
                    <button type="submit" class="btn btn-success">Send To Analyst</button>
                </form>
            </div>
    </main>
    <script defer>
        let inputcheck=document.getElementsByTagName('input');
        let decision=document.getElementById('decision');
        let compteur=0;
        let checkbtn=document.getElementById('checkbtn');

        checkbtn.addEventListener('click',function (e) {
            e.preventDefault();
            for (let i = 0; i < inputcheck.length; i++) {
                if (inputcheck[i].type=='checkbox' && inputcheck[i].checked) {
                compteur++;
                }
            }
            if (compteur == 12) {
                decision.className='alert alert-success';
                decision.textContent='The request can be send to Analyst';
            }else{
                decision.className='alert alert-danger';
                decision.textContent='The request can\'t be send to Analyst';
            }
        },false);
    </script>
</body>
</html>