<?php 
    //ajout de ma session  et test sur le user est connecte
    require_once "../Fonction/auth_function.php";
    require_once 'vendor/autoload.php';


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
    $queryEngagement1="SELECT TOP 1  num_dossier,montant_dmd,montant_acc,periodicite,echeance,client.id_client,
    but.nom_but,typePret.nom_typePret FROM engagement
    INNER JOIN but
    ON engagement.id_but=but.id_but
    INNER JOIN typePret
    ON engagement.id_typePret=typePret.id_typePret
    INNER JOIN client
    ON engagement.id_client=client.id_client
    WHERE statut=7 AND client.id_agence='$idAgence'";
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
        $array[7]=odbc_result($selectEngagement1,'montant_acc');
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

        //je recupere les opinions des autres memebres du workflow
        $queryOpinion="SELECT opinion FROM traiter WHERE num_dossier='$array[0]'";
        $selectQuery=odbc_exec($connexion,$queryOpinion);

        //je fais la mise a jour des infos si envoyer est defini et que on a choisi approve ou je supprime si reject
        if (isset($_POST['envoyer'])) {
            if (!empty($_POST['notification'])) {
                date_default_timezone_set('Europe/paris');
                $datefin=date('j/n/Y H:i:s');
                $notification=$_POST['notification'];
                if ($notification == 1) {
                    $queryUpdateTraiter="UPDATE traiter SET date_fin='$datefin',opinion='approved' WHERE num_dossier='$array[0]' AND id_user='$idUser'";
                    $updateTraiter=odbc_exec($connexion,$queryUpdateTraiter);
                    
                    //api sms bird message
                    $messagebird = new MessageBird\Client('G6CmeU2Fj0IcFOT7i9FF60LIM');
                    $message = new MessageBird\Objects\Message;
                    $message->originator = '+237695050197';
                    $message->recipients = [ '+237695050197' ];
                    $message->body = 'Hi Dear Customer: '."$info[1]".',Your Credit was Approved!';
                    $response = $messagebird->messages->create($message);
                    var_dump($response);
                   
                    //update statut a 1 sur engagement
                    $queryUpdateEngagement="UPDATE engagement SET statut=8 WHERE num_dossier='$array[0]'";
                    $updateEngagement=odbc_exec($connexion,$queryUpdateEngagement);

                    header('Location: ./creditAdmin.php');
                    
                }else{
                    $queryUpdateTraiter="UPDATE traiter SET date_fin='$datefin',opinion='rejected' WHERE num_dossier='$array[0]' AND id_user='$idUser'";
                    $updateTraiter=odbc_exec($connexion,$queryUpdateTraiter);
                    $queryUpdateEngagement="UPDATE engagement SET statut=-1 WHERE num_dossier='$array[0]'";
                    $updateEngagement=odbc_exec($connexion,$queryUpdateEngagement);

                    //api sms bird message
                    $messagebird = new MessageBird\Client('G6CmeU2Fj0IcFOT7i9FF60LIM');
                    $message = new MessageBird\Objects\Message;
                    $message->originator = '+237695050197';
                    $message->recipients = [ '+237695050197' ];
                    $message->body = 'Hi Dear Customer: '."$info[1]".',Your Loan Request was Rejected!';
                    $response = $messagebird->messages->create($message);

                    header('Location: ./creditAdmin.php');
                }
            }else{
                $erreur='<span style="color:red;"> Fill all inputs </span>';
            }
        }
    }
    require_once "headerLoan.php";
?>
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
                                    <input type="text" name="numClient" id="numClient" class="form-control" value="<?php if(isset($info)){echo "$info[0]";}?>" disabled>
                                </div>
                                <div class="check_2">
                                    <label for="nomClient"><strong>Name</strong></label><br>
                                    <input type="text" name="nomClient" id="nomClient" class="form-control" value="<?php if(isset($info)){echo "$info[1]";}?>" disabled>
                                </div>
                                <div class="check_3">
                                    <label for="prenomClient"><strong>Last Name</strong></label><br>
                                    <input type="text" name="prenomClient" id="prenomClient" class="form-control" value="<?php if(isset($info)){echo "$info[2]";}?>" disabled> 
                                </div>
                                <div class="check_4">
                                    <label for="emailClient"><strong>Email</strong></label><br>
                                    <input type="email" name="emailClient" id="emailClient" class="form-control" value="<?php if(isset($info)){echo "$info[3]";}?>" disabled>
                                </div>
                                <div class="check_5">
                                    <label for="telephoneClient"><strong>Phone Number</strong></label><br>
                                    <input type="tel" name="telephoneClient" id="telephoneClient" class="form-control" value="<?php if(isset($info)){echo "$info[4]";}?>" disabled><br>
                                </div>
                            </div>
                        </div>
                        <!---info credit-->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="check_0">
                                    <label for="montantdemande"><strong>Amout Asked</strong></label><br>
                                    <input type="number" name="montantdemande" id="montantdemande" class="form-control" value="<?php if(isset($array)){echo "$array[1]";}?>" disabled>
                                </div>
                                <div class="check_1">
                                    <label for="montantaccorde"><strong>Amout gived</strong></label><br>
                                    <input type="number" name="montantaccorde" id="montantaccorde" class="form-control" value="<?php if(isset($array)){echo "$array[7]";}?>" disabled>
                                </div>
                                <div class="check_2">
                                    <label for="periodicite"><strong>Periodicity</strong></label><br>
                                    <input type="text" name="periodicite" id="periodicite" class="form-control" value="<?php if(isset($array)){echo "$array[2]";}?>" disabled>
                                </div>
                                <div class="check_3">
                                    <label for="echeance"><strong>deadline</strong></label><br>
                                    <input type="date" name="echeance" id="echeance" class="form-control" value="<?php if(isset($array)){echo "$array[3]";}?>" disabled>
                                </div>
                                <div class="check_4">
                                    <label for="typeCredit"><strong>Type Loan</strong></label><br>
                                    <input type="text" name="typeCredit" id="typeCredit" class="form-control" value="<?php if(isset($array)){echo "$array[5]";}?>" disabled>
                                </div>
                                <div class="check_5">
                                    <label for="but"><strong>Purpose Loan</strong></label><br>
                                    <input type="text" name="but" id="but" class="form-control" value="<?php if(isset($array)){echo "$array[6]";}?>" disabled>
                                </div>
                                <div class="check_6">
                                    <label for="nature"><strong>Nature Loan</strong></label><br>
                                    <input type="text" name="nature" id="nature" class="form-control" value="<?php if(isset($nomFinancement)){echo "$nomFinancement";}?>" disabled>
                                </div>
                            </div>
                        </div>
                        <?php if(isset($selectQuery)):?>
                            <?php while(odbc_fetch_row($selectQuery)):?>
                                <?php
                                    $opinion=odbc_result($selectQuery,'opinion');    
                                ?>
                                <?php if($opinion != null):?>
                                    <span class="alert alert-info"> <?=$opinion?> </span>
                                <?php endif?>   
                            <?php endwhile;?>
                        <?php endif;?>
                    </div>
                    </div>
                    <label for="notification"><strong>Notification</strong></label>
                        <select name="notification" id="notification" class="form-control">
                            <option value="1"><strong> Approve</strong></option>
                            <option value="2"><strong>Reject</strong></option>
                        </select> <br>
                    <button type="submit" class="btn btn-success" name="envoyer">Notified Custormer</button>
                </form>
                <?=$erreur?>
            </div>
    </main>
</body>
</html>