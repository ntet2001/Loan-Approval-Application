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
        <h1 style="text-align: center;margin-bottom:20px;">Manager Decision Making</h1>
            <div class="formulaire" style="margin-bottom: 20px;">
                <form action="./manager.php" method="post">
                    <div class="row">
                        <!---info client-->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="check_1">
                                    <label for="numClient"><strong>Customer No :</strong></label><br>
                                    <input type="text" name="numClient" id="numClient" class="form-control" disabled>
                                </div>
                                <div class="check_2">
                                    <label for="nomClient"><strong>Name</strong></label><br>
                                    <input type="text" name="nomClient" id="nomClient" class="form-control" disabled>
                                </div>
                                <div class="check_3">
                                    <label for="prenomClient"><strong>Last Name</strong></label><br>
                                    <input type="text" name="prenomClient" id="prenomClient" class="form-control" disabled> 
                                </div>
                                <div class="check_4">
                                    <label for="emailClient"><strong>Email</strong></label><br>
                                    <input type="email" name="emailClient" id="emailClient" class="form-control" disabled>
                                </div>
                                <div class="check_5">
                                    <label for="telephoneClient"><strong>Phone Number</strong></label><br>
                                    <input type="tel" name="telephoneClient" id="telephoneClient" class="form-control" disabled><br>
                                </div>
                                <div class="check_6">
                                    <label for="document"><strong> Document</strong></label><br>
                                    <span>Document1</span>
                                    <a href="http://" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                        </svg>Voir
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!---info credit-->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="check_1">
                                    <label for="montantdemande"><strong>Amout Asked</strong></label><br>
                                    <input type="number" name="montantdemande" id="montantdemande" class="form-control" disabled>
                                </div>
                                <div class="check_2">
                                    <label for="periodicite"><strong>Periodicity</strong></label><br>
                                    <input type="text" name="periodicite" id="periodicite" class="form-control" disabled>
                                </div>
                                <div class="check_3">
                                    <label for="echeance"><strong>deadline</strong></label><br>
                                    <input type="number" name="echeance" id="echeance" class="form-control" disabled>
                                </div>
                                <div class="check_4">
                                    <label for="typeCredit"><strong>Type Loan</strong></label><br>
                                    <input type="text" name="typeCredit" id="typeCredit" class="form-control" disabled>
                                </div>
                                <div class="check_5">
                                    <label for="but"><strong>Purpose Loan</strong></label><br>
                                    <input type="text" name="but" id="but" class="form-control" disabled>
                                </div>
                                <div class="check_6">
                                    <label for="nature"><strong>Nature Loan</strong></label><br>
                                    <input type="text" name="nature" id="nature" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-info">
                            <strong>Analyst:</strong> Approve
                        </div>
                        <div class="alert alert-info">
                            <strong>1st evaluation:</strong> Reject
                        </div>
                    </div>
                    <label for="opinion">Opinion and [Approve/Reject]</label>
                    <textarea name="opinion" id="opinion" cols="30" rows="10" class="form-control" style="margin-bottom: 20px;"></textarea>
                    <div class="col-lg-7">
                        <label for="decision"><strong>Decision</strong></label>
                            <select name="decision" id="decision" class="form-control">
                                <option value="1"><strong> Approve</strong></option>
                                <option value="0"><strong>Reject</strong></option>
                            </select> <br>
                        <label for="montantaccorde"><strong>Amount Accorded</strong></label><br>
                        <input type="number" name="montantaccorde" id="montantaccorde" class="form-control" required><br>
                    </div>
                    <button type="submit" class="btn btn-success">
                        save
                    </button>
                </form>
            </div>
    </main>
    <script defer>
        // on recupere la decision finale et l'input du montant
        let decision=document.getElementById('decision');
        let inputMontant=document.getElementById('montantaccorde');
        decision.addEventListener('change',function (e) {
            if(e.target.selectedIndex==1){
                inputMontant.disabled=true;
            }else{
                inputMontant.disabled=false;
            }
        },false);
    </script>
</body>
</html>