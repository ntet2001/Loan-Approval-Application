<?php require_once "headerLoan.php";?>
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
                            <label for="numClient">Customer No :</label><br>
                            <select name="numClient" id="numClient" class="form-control">
                                <option value=""></option>
                            </select>
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
                            <select name="periodicite" id="periodicite" class="form-control">
                                <option value=""></option>
                            </select>
                            <label for="echeance">deadline</label><br>
                            <input type="number" name="echeance" id="echeance" class="form-control">
                            <label for="typeCredit">Type Loan</label><br>
                            <select name="typeCredit" id="typeCredit" class="form-control">
                                <option value=""></option>
                            </select>
                            <label for="but">Purpose Loan</label><br>
                            <select name="but" id="but" class="form-control">
                                <option value=""></option>
                            </select>
                            <label for="nature">Nature Loan</label><br>
                            <select name="nature" id="nature" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="decision">
                    <strong>Opinion:</strong>
                    <textarea name="opinion" id="opinion" cols="30" rows="10" class="form-control" style="margin-bottom: 20px;"></textarea>
                </div>
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" class="btn btn-success">Send to Confirmation</button>
            </form>
        </div>
    </main>
</body>
</html>