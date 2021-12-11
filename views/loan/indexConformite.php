<?php 
    //ajout de ma session  et test sur le user est connecte
    require_once "../Fonction/auth_function.php";
    ajoutsession();
    estconnecte();
    $connexion=connexion();
    $erreur=NULL;
    $date=null;
    $idReseau=$_SESSION['id_reseau'];
    $idAgence=$_SESSION['id_agence'];
    $idUser=$_SESSION['id_user'];
    // je recupere le nom du reseau et le nom de l'agence du user
    $queryReseau="SELECT nom_reseau FROM reseau WHERE id_reseau='$idReseau'";
    $queryAgence="SELECT nom_agence FROM agence WHERE id_agence='$idAgence'";
    $ResultatReseau=odbc_exec($connexion,$queryReseau);
    while (odbc_fetch_row($ResultatReseau)) {
        $nomReseau=odbc_result($ResultatReseau,'nom_reseau');
    }
    $ResultatAgence=odbc_exec($connexion,$queryAgence);
    while (odbc_fetch_row($ResultatAgence)) {
        $nomAgence=odbc_result($ResultatAgence,'nom_agence');
    }

    // je recupere les infos sur l'engagement et l'id du client
    $queryEngagement1="SELECT TOP 1  num_dossier,montant_dmd,periodicite,echeance,client.id_client,
    but.nom_but,typePret.nom_typePret FROM engagement
    INNER JOIN but
    ON engagement.id_but=but.id_but
    INNER JOIN typePret
    ON engagement.id_typePret=typePret.id_typePret
	INNER JOIN client
	ON engagement.id_client=client.id_client
    WHERE statut=0 AND client.id_agence='$idAgence'";
    $selectEngagement1=odbc_exec($connexion,$queryEngagement1);
    while (odbc_fetch_row($selectEngagement1)) {
        $array=[];
        $array[0]=odbc_result($selectEngagement1,'num_dossier');
        $array[1]=odbc_result($selectEngagement1,'montant_dmd');
        $array[2]=odbc_result($selectEngagement1,'periodicite');
        $array[3]=odbc_result($selectEngagement1,'echeance');
        $array[4]=odbc_result($selectEngagement1,'id_client');
        $array[5]=odbc_result($selectEngagement1,'nom_but');
        $array[6]=odbc_result($selectEngagement1,'nom_typePret');
    }
    if (isset($array[5]) && isset($array[4]) && isset($array[0])) {
        $queryFinancement="SELECT type_engagement.nature FROM but
        INNER JOIN type_engagement
        ON but.id_type_engagement=type_engagement.id_type_engagement
        WHERE nom_but='$array[5]'";
        $selectFinancement=odbc_exec($connexion,$queryFinancement);
        while (odbc_fetch_row($selectFinancement)) {
            $nomFinancement=odbc_result($selectFinancement,'nature');
        }

        $queryClient="SELECT num_client,nom_client,prenom_client,email_client,telephone_client FROM client WHERE id_client='$array[4]'";
        $selectClient=odbc_exec($connexion,$queryClient);
        while (odbc_fetch_row($selectClient)) {
            $info=[];
            $info[0]=odbc_result($selectClient,'num_client');
            $info[1]=odbc_result($selectClient,'nom_client');
            $info[2]=odbc_result($selectClient,'prenom_client');
            $info[3]=odbc_result($selectClient,'email_client');
            $info[4]=odbc_result($selectClient,'telephone_client');

        }

        //je recupere les documents lies a l'id du client
        $queryDocument="SELECT nom_document FROM document
        WHERE id_client='$array[4]'";
        $selectDocument=odbc_exec($connexion,$queryDocument);

        // j'insere la date debut dans traiter si il n'y en a pas deja 
        $queryDate="SELECT date_debut FROM traiter WHERE id_user='$idUser' AND num_dossier='$array[0]'";
        $selectDate=odbc_exec($connexion,$queryDate);
        while (odbc_fetch_row($selectDate)) {
            $date=odbc_result($selectDate,'date_debut');
        }
        if ($date == null) {
            date_default_timezone_set('Europe/paris');
            $datedebut=date('j/n/Y H:i:s');
            $queryTraiter1="INSERT INTO traiter (date_debut,id_user,num_dossier) VALUES ('$datedebut','$idUser','$array[0]')";
            $insertTraiter=odbc_exec($connexion,$queryTraiter1);
        }

        //je fais la mise a jour des infos si envoyer est defini et que on a choisi approve ou je supprime si reject
        if (isset($_POST['envoyer'])) {
            if (!empty($_POST['opinion']) && !empty($_POST['decision'])) {
                date_default_timezone_set('Europe/paris');
                $datefin=date('j/n/Y H:i:s');
                $opinion=$_POST['opinion'];
                $decision=$_POST['decision'];
                if ($decision == 2) {
                    $queryUpdateTraiter="UPDATE traiter SET date_fin='$datefin',opinion='$opinion' WHERE num_dossier='$array[0]' AND id_user='$idUser'";
                    $updateTraiter=odbc_exec($connexion,$queryUpdateTraiter);
                    //update statut a 1 sur engagement
                    $queryUpdateEngagement="UPDATE engagement SET statut=1 WHERE num_dossier='$array[0]'";
                    $updateEngagement=odbc_exec($connexion,$queryUpdateEngagement);
                    header('Location: ./indexConformite.php');
                }else{
                    $queryUpdateTraiter="UPDATE traiter SET date_fin='$datefin',opinion='$opinion' WHERE num_dossier='$array[0]' AND id_user='$idUser'";
                    $updateTraiter=odbc_exec($connexion,$queryUpdateTraiter);
                    $queryUpdateEngagement="UPDATE engagement SET statut=-1 WHERE num_dossier='$array[0]'";
                    $updateEngagement=odbc_exec($connexion,$queryUpdateEngagement);
                    header('Location: ./indexConformite.php');
                }
            }else{
                $erreur='<span style="color:red;"> Fill all inputs </span>';
            }
        }
    }
    require_once "headerLoan.php";
?>
<body>
    <main class="container" style="margin-top: 90px;">
        <h1 style="text-align: center;"> Loan Conformity</h1>
        <div class="alert alert-warning">Check the conformitee of the Loan request</div>
            <div class="formulaire" style="margin-bottom: 20px;">
                <form action="./indexConformite.php" method="post">
                    <div class="row">
                        <!---info client-->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="check_1">
                                    <label for="numClient"><strong>Customer No :</strong></label><br>
                                    <input type="text" name="numClient" id="numClient" class="form-control" value="<?php if(isset($info)){echo "$info[0]";}?>" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite1" class="conformite"><br>
                                </div>
                                <div class="check_2">
                                    <label for="nomClient"><strong>Name</strong></label><br>
                                    <input type="text" name="nomClient" id="nomClient" class="form-control" value="<?php if(isset($info)){echo "$info[1]";}?>" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite2" class="conformite"><br>
                                </div>
                                <div class="check_3">
                                    <label for="prenomClient"><strong>Last Name</strong></label><br>
                                    <input type="text" name="prenomClient" id="prenomClient" class="form-control" value="<?php if(isset($info)){echo "$info[2]";}?>" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite3" class="conformite"><br> 
                                </div>
                                <div class="check_4">
                                    <label for="emailClient"><strong>Email</strong></label><br>
                                    <input type="email" name="emailClient" id="emailClient" class="form-control" value="<?php if(isset($info)){echo "$info[3]";}?>" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite4" class="conformite"><br>
                                </div>
                                <div class="check_5">
                                    <label for="telephoneClient"><strong>Phone Number</strong></label><br>
                                    <input type="tel" name="telephoneClient" id="telephoneClient" class="form-control" value="<?php if(isset($info)){echo "$info[4]";}?>" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite5" class="conformite"><br>
                                </div>
                                <div class="check_6">
                                    <label for="document"><strong> Document: </strong></label><br>
                                    <?php $compteur=null?>
                                    <?php if(isset($selectDocument) == true):?>
                                        <?php While(odbc_fetch_row($selectDocument)):?>
                                            <?php $compteur++; ?>
                                            <?php $nomDocument=odbc_result($selectDocument,'nom_document')?>
                                            <span>Document <?=$compteur?> </span>
                                            <a href="<?=$nomDocument?>" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                </svg> voir
                                            </a><br><br>
                                        <?php endwhile;?>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                        <!---info credit-->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="check_1">
                                    <label for="montantdemande"><strong>Amout Asked</strong></label><br>
                                    <input type="number" name="montantdemande" id="montantdemande" class="form-control" value="<?php if(isset($array)){echo "$array[1]";}?>" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite7" class="conformite"><br>
                                </div>
                                <div class="check_2">
                                    <label for="periodicite"><strong>Periodicity</strong></label><br>
                                    <input type="text" name="periodicite" id="periodicite" class="form-control" value="<?php if(isset($array)){echo "$array[2]";}?>" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite8" class="conformite"><br>
                                </div>
                                <div class="check_3">
                                    <label for="echeance"><strong>deadline</strong></label><br>
                                    <input type="date" name="echeance" id="echeance" class="form-control" value="<?php if(isset($array)){echo "$array[3]";}?>" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite9" class="conformite"><br>
                                </div>
                                <div class="check_4">
                                    <label for="typeCredit"><strong>Type Loan</strong></label><br>
                                    <input type="text" name="typeCredit" id="typeCredit" class="form-control" value="<?php if(isset($array)){echo "$array[5]";}?>" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite10" class="conformite"><br>
                                </div>
                                <div class="check_5">
                                    <label for="but"><strong>Purpose Loan</strong></label><br>
                                    <input type="text" name="but" id="but" class="form-control" value="<?php if(isset($array)){echo "$array[6]";}?>" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite11" class="conformite"><br>
                                </div>
                                <div class="check_6">
                                    <label for="nature"><strong>Nature Loan</strong></label><br>
                                    <input type="text" name="nature" id="nature" class="form-control" value="<?php if(isset($nomFinancement)){echo "$nomFinancement";}?>" disabled>
                                    <input type="checkbox" name="conformite[]" id="conformite12" class="conformite"><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button id="checkbtn" class="btn btn-primary" style="margin-bottom: 10px;">Checked the Request</button><br>
                    <div id="decision"></div>
                    <strong>Opinion:</strong>
                    <textarea name="opinion" id="opinion" cols="30" rows="10" class="form-control" style="margin-bottom: 20px;"></textarea>
                    <label for="decision">Approved / Rejected</label><br>
                    <select name="decision" id="decision" class="form-control">
                        <option value="">Conformity Decision</option>
                        <option value="1">Rejected</option>
                        <option value="2">Approved</option>
                    </select><br>
                    <button type="submit" class="btn btn-success" name="envoyer">Submit</button>
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
            if (compteur == 11) {
                decision.className='alert alert-success';
                decision.textContent='The request can be send to Analyst if document completed';
            }else{
                decision.className='alert alert-danger';
                decision.textContent='The request can\'t be send to Analyst';
            }
        },false);
    </script>
</body>
</html>