<?php
    //ajout de ma session  et test sur le user est connecte
    require_once "../Fonction/auth_function.php";
    ajoutsession();
    estconnecte();
    $connexion=connexion();
    $erreur=NULL;
    $erreur1=NULL;
    $erreur2=NULL;
    $erreur3=NULL;
    $reussite=0;
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

    //je charge le numero client et leur id
    $queryClient="SELECT * FROM client WHERE id_agence='$idAgence'";
    $resultatClient=odbc_exec($connexion,$queryClient);

    //je charge les types de pret
    $queryTypePret="SELECT id_typePret, nom_typePret FROM typePret";
    $resultatTypePret=odbc_exec($connexion,$queryTypePret);

    //je charge les buts
    $queryBut="SELECT id_but,nom_but FROM but";
    $resultatBut=odbc_exec($connexion,$queryBut);

    //j'enregistre l'engagement
    if (!empty($_POST['numClient']) && !empty($_POST['nomClient']) && !empty($_POST['prenomClient']) && !empty($_POST['emailClient']) && !empty($_POST['telephoneClient']) && !empty($_POST['montantdemande']) && !empty($_POST['periodicite']) && !empty($_POST['echeance']) && !empty($_POST['typeCredit']) && !empty($_POST['but'])) {
        $cheminfinal=null;
        //verifie l'existence du fichier
        if (isset($_FILES['document'])) {
            if ($_POST['periodicite'] == 1) {
               $periodicite='per terms';
            }else if ($_POST['periodicite'] == 2) {
               $periodicite='per semesters';
            }else{
                $periodicite='per years';
            }
           $array=[];
           $array[0]=$_POST['numClient'];
           $array[1]=$_POST['montantdemande'];
           $array[2]=$periodicite;
           $array[3]=$_POST['echeance'];
           $array[4]=$_POST['typeCredit'];
           $array[5]=$_POST['but'];
           // je recuperer ici le nombre de fichiers envoyer
            $taille=count($_FILES['document']['name']);
            var_dump($taille);
            for ($j=0; $j <$taille ; $j++) { 
                 //verifie si le fichier a bien ete telecharge
                if (is_uploaded_file($_FILES['document']['tmp_name'][$j])) {
                    //verifie la taille du fichier
                    $tailleFichier=filesize($_FILES['document']['tmp_name'][$j]);
                    if ($tailleFichier<=6000000) {
                        //je test l'extension du document
                        $fichiernom=pathinfo($_FILES['document']['name'][$j]);
                        $extensionfichier=$fichiernom['extension'];
                        $extension_autorise=['pdf'];
                        if (in_array($extensionfichier,$extension_autorise)) {
                            $cheminTemporaire=$_FILES['document']['tmp_name'][$j];
                            $cheminfinal='./uploads/'.$_FILES['document']['name'][$j];
                            $move= move_uploaded_file($cheminTemporaire,$cheminfinal);
                                if ($move) {
                                    //j'insere dans ma bd les infos sur les documents et l'initiation
                                    date_default_timezone_set('Europe/paris');
                                    $date=date('j/n/Y H:i:s');
                                    $queryDocument="INSERT INTO document (nom_document,date_document,id_client)
                                    VALUES('$cheminfinal','$date','$array[0]')";
                                    $insertDocument=odbc_exec($connexion,$queryDocument);
                                    $reussite++; 
                                }else{
                                    $erreur= '<span style="color:red;">not saved </span>';
                                }
                        }else{$erreur1= '<span style="color:red;"> Only PDF document accepted </span>';}
                    }else{
                        $erreur2= '<span style="color:red;"> files size to big </span>';
                    }
                }else{
                    $erreur3= '<span style="color:red;">Error when upload </span>';
                }
            }
        }
        if ($reussite == $taille) {
            //initiation
            $queryEngagement="INSERT INTO engagement (montant_dmd,statut,periodicite,echeance,id_client,id_typePret,id_but)
            VALUES('$array[1]',0,'$array[2]','$array[3]','$array[0]','$array[4]','$array[5]')";
            $insertEngagement=odbc_exec($connexion,$queryEngagement);
            $erreur= '<span style="color:green;">Documents saved and demand sended </span>';
        }else{
            $erreur= '<span style="color:red;">Documents not saved verified document type </span>';
        }
       
    }else{
        $erreur='<span style="color:red;">Fill correctly all your inputs </span>';
    }

    require_once "headerLoan.php";
?>
        <main class="container" style="margin-top: 80px;">
            <h1 style="text-align: center;margin-bottom:40px;">INITIALIZE THE LOAN</h1>
            <div class="formulaire">
                <form action="./initiation.php" method="post" style="padding-bottom: 40px;" autocomplete="off" enctype="multipart/form-data">
                    <div class="row">
                        <!--info client--->
                        <div class="col-lg-6">
                            <h3>Custormer Informations</h3>
                            <div class="form-group">
                                <label for="numClient">Customer No :</label><br>
                                <select name="numClient" id="numClient" class="form-control" onchange="load(numClient)">
                                    <!-- numero client -->
                                    <option value="" disabled>Choose your customer number</option>
                                    <?php
                                     $tab= array();
                                     $i=0;$numclient=null;
                                     while (odbc_fetch_row($resultatClient)):?>
                                        <?php
                                            $tab[$i]['id_client']=odbc_result($resultatClient,'id_client');
                                            $tab[$i]['num_client']=odbc_result($resultatClient,'num_client');
                                            $tab[$i]['nom_client']=odbc_result($resultatClient,'nom_client');
                                            $tab[$i]['prenom_client']=odbc_result($resultatClient,'prenom_client');
                                            $tab[$i]['email_client']=odbc_result($resultatClient,'email_client');
                                            $tab[$i]['telephone_client']=odbc_result($resultatClient,'telephone_client');
                                            $i++;
                                            $id_client=odbc_result($resultatClient,'id_client');    
                                            $num_client=odbc_result($resultatClient,'num_client');    
                                        ?>
                                        <?php
                                            if(isset($_GET['numclient'])){
                                                $numclient=$_GET['numclient'];
                                            }
                                        ?>
                                        <option value="<?=$id_client?>"> <?=$num_client?> </option>
                                    <?php endwhile?>
                                </select>
                                <input type="hidden" name="select" id="select" value="<?=$numclient?>">
                                <label for="nomClient">Name</label><br>
                                <input type="text" name="nomClient" id="nomClient" class="form-control" value="<?php if(isset($_GET['numclient'])){$i=$_GET['numclient'];echo $tab[$i-1]['nom_client'];} ?>">
                                <label for="prenomClient">Last Name</label><br>
                                <input type="text" name="prenomClient" id="prenomClient" class="form-control" value="<?php if(isset($_GET['numclient'])){$i=$_GET['numclient'];echo $tab[$i-1]['prenom_client'];} ?>">
                                <label for="emailClient">Email</label><br>
                                <input type="email" name="emailClient" id="emailClient" class="form-control" value="<?php if(isset($_GET['numclient'])){$i=$_GET['numclient'];echo $tab[$i-1]['email_client'];} ?>">
                                <label for="telephoneClient">Phone Number</label><br>
                                <input type="tel" name="telephoneClient" id="telephoneClient" class="form-control" value="<?php if(isset($_GET['numclient'])){$i=$_GET['numclient'];echo $tab[$i-1]['telephone_client'];} ?>"><br>
                                <label for="document"><strong> Document</strong></label>
                                <input type="file" name="document[]" id="document" multiple>
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
                                    <!-- periodicite -->
                                    <option value=""></option>
                                    <option value="1">Per terms</option>
                                    <option value="2">Per semesters</option>
                                    <option value="3">per Years</option>
                                </select>
                                <label for="echeance">deadline</label><br>
                                <input type="date" name="echeance" id="echeance" class="form-control">
                                <label for="typeCredit">Type Loan</label><br>
                                <select name="typeCredit" id="typeCredit" class="form-control">
                                    <!-- type pret -->
                                    <option value=""></option>
                                    <?php while (odbc_fetch_row($resultatTypePret)):?>
                                        <?php
                                            $id_TypePret=odbc_result($resultatTypePret,'id_typePret');    
                                            $nom_typePret=odbc_result($resultatTypePret,'nom_typePret');    
                                        ?>
                                        <option value="<?=$id_TypePret?>"> <?=$nom_typePret?> </option>
                                    <?php endwhile?>
                                </select>
                                <label for="but">Purpose Loan</label><br>
                                <select name="but" id="but" class="form-control">
                                    <!-- but pret -->
                                    <option value=""></option>
                                    <?php while (odbc_fetch_row($resultatBut)):?>
                                        <?php
                                            $id_but=odbc_result($resultatBut,'id_but');    
                                            $nom_but=odbc_result($resultatBut,'nom_but');    
                                        ?>
                                        <option value="<?=$id_but?>"> <?=$nom_but?> </option>
                                    <?php endwhile?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?=$erreur?><br>
                    <?=$erreur1?><br>
                    <?=$erreur2?><br>
                    <?=$erreur3?><br><br>
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-success">Send to Confirmation</button>
                </form>
            </div>
            <?php finconnexion();?>
        </main>
        <script defer>
            //ici je rempli mes inputs en fonctions du num client choisis en faisant un chargement de page
            let numClient= document.getElementById('numClient');
            let select= document.getElementById('select');
            numClient.selectedIndex=select.value;
            function load(numClient){
                window.location.assign("initiation.php?numclient="+numClient.selectedIndex+"&&idClient="+numClient.value);
            }
            
        </script>
    </body>
</html>