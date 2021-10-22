<?php require_once "headerLoan.php";?>
<body>
    <main class="container" style="margin-top: 90px; margin-bottom:20px;">
        <h1 style="text-align: center;margin-bottom:20px;">  Loan Notification </h1>
            <div class="formulaire" style="margin-bottom: 20px;">
                <form action="./creditAdmin.php" method="post">
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
                        <div class="alert alert-info">
                            <strong>manager:</strong> Approve
                        </div>
                    </div>
                    </div>
                    <label for="notification"><strong>Notification</strong></label>
                        <select name="notification" id="notification" class="form-control">
                            <option value="1"><strong> Approve</strong></option>
                            <option value="2"><strong>Reject</strong></option>
                        </select> <br>
                    <button type="submit" class="btn btn-success">
                        Notified Custormer
                    </button>
                </form>
            </div>
    </main>
</body>
</html>