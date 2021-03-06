<?php
    //ajout de ma session  et test sur le user est connecte
    require_once "../Fonction/auth_function.php";
    ajoutsession();
    estconnecte();
    $connexion=connexion();
    $idReseau=$_SESSION['id_reseau'];
    $erreur=NULL;

    // je recupere le nom du reseau
    $queryReseau="SELECT nom_reseau FROM reseau WHERE id_reseau='$idReseau'";
    $ResultatReseau=odbc_exec($connexion,$queryReseau);
    while (odbc_fetch_row($ResultatReseau)) {
        $nomReseau=odbc_result($ResultatReseau,'nom_reseau');
    }

    //je charge les champs select profil
    $queryProfil="SELECT id_profil,nom_profil FROM profil";
    $selectProfil=odbc_exec($connexion,$queryProfil);

    //on verifie que les champs sont non vides
    if (!empty($_POST['nom']) && !empty($_POST['profil']) && !empty($_POST['agence']) && !empty($_POST['password']) && !empty($_POST['confirmPassword']) && !empty($_POST['reseau']) && !empty($_POST['section']) && !empty($_POST['pole'])) {
        //on verifie la taille du mot de passe
       if(strlen($_POST['password'])==8 && strlen($_POST['confirmPassword'])==8){
           // je verifie que confirm password est egale a password
            if ($_POST['password'] == $_POST['confirmPassword']) {
               //insere les donnees
                $data=[];
                $data[0]=strtolower($_POST['nom']);
                $data[1]=strtolower($_POST['password']);
                $data[2]=$_POST['agence'];
                $data[3]=$_POST['profil'];
                $data[4]=$_POST['reseau'];
                $data[5]=$_POST['section'];
                $data[6]=$_POST['pole'];
                $pwdUser=password_hash($data[1],PASSWORD_DEFAULT,['cost' => 14]);
                if (password_verify($data[1],$pwdUser)) {
                    $queryinsert="INSERT INTO users (nom_user,mdp,id_agence,id_profil,id_reseau,id_section,id_pole) 
                    VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]')";
                    $insert=odbc_exec($connexion,$queryinsert);
                    $erreur='<span style="color:green;">insert successful <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg></span>';
                }

            }else{
                $erreur='<span style="color:red;">confirm password shall be the same as password</span>'; 
            }
       }else{
           $erreur='<div class="alert alert-danger">08 characters are Required for the password</div>';
       }
    }else{
        $erreur='<div class="alert alert-danger">Fill All the Inputs</div>';
    }   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--link call bootstrap css-->
    <link rel="stylesheet" href="../dist/css/bootstrap.css">
    <link rel="stylesheet" href="../connexion/headerAdmin/headerAdmin.css">
        <!--call bootstrap javascript-->
    <script src="../dist/jquery/jquery-3.6.0.min.js"></script>
    <script src="../dist/js/bootstrap.js"></script>
    <script src="../dist/js/popper.min.js"></script>
    <!---script pour verification du mot de passe-->
    <script src="./user.js" defer></script>
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
                    <li class="nav-item">
                        <a href="../Connexion/administrateur.php" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                                <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                            </svg>  Return Home
                        </a>
                    </li>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                    <span style="color: white;">Code:<?=$_SESSION['code_admin']." <br>".$_SESSION['nom_admin'].'  Reseau: '.$nomReseau?></span>
                </div>
            </div>
        </nav>
    </header>
    <main class="container" style="margin-bottom: 20px;">
        <h1 style="margin-bottom: 20px;">Register User </h1>
        <div class="row formulaire">
            <div class="col-lg-6">
                <!-- mon formulaire pour les users  -->
                <form action="indexUser.php" method="post" autocomplete="off">
                    <div class="form-group" id='divVerification'>
                        <label for="nom">Name:</label><br>
                        <input type="text" name="nom" id="nom" class="form-control">
                        <label for="profil">Profile:</label><br>
                        <select name="profil" id="profil"  class="form-control">
                             <!-- j'affiche les differents profils -->
                             <?php while(odbc_fetch_row($selectProfil)):?>
                                <?php
                                    $idprofil=odbc_result($selectProfil,'id_profil');
                                    $nomprofil=odbc_result($selectProfil,'nom_profil');    
                                ?>
                                <option value="<?=$idprofil;?>"><?=$nomprofil;?></option>
                            <?php endwhile;?>  
                        </select>
                        <label for="reseau">Network</label><br>
                        <select name="reseau" id="reseau"  class="form-control">
                            <option value="<?=$idReseau?>"><?=$nomReseau?></option>
                        </select>
                        <label for="section">Section</label><br>
                        <select name="section" id="section"  class="form-control">
                            <!-- j'affiche les differentes sections -->
                            <?php
                                //je charge les champs select section
                                $querySection="SELECT id_section FROM section WHERE id_reseau='$idReseau'";
                                $selectSection=odbc_exec($connexion,$querySection);
                                while (odbc_fetch_row($selectSection)) {
                                    $id_sections[]=odbc_result($selectSection,'id_section');
                                }
                                foreach ($id_sections as $id_section) {
                                    $querySection="SELECT id_section,nom_section FROM section WHERE id_section='$id_section' ";
                                    $selectSection=odbc_exec($connexion,$querySection);
                                    while(odbc_fetch_row( $selectSection)){
                                        $idsection=odbc_result($selectSection,'id_section');
                                        $nomsection=odbc_result($selectSection,'nom_section');    
                                        echo '<option value="'.$idsection.'">'.$nomsection.'</option>';
                                    }
                                }
                            ?> 
                        </select>
                        <label for="pole">Pole</label><br>
                        <select name="pole" id="pole"  class="form-control">
                            <!-- j'affiche les differentes poles -->
                            <?php
                                //je charge les champs select pole
                                foreach ($id_sections as $idSection) {
                                    $queryPole="SELECT id_pole FROM pole WHERE id_section='$idSection'";
                                    $selectPole=odbc_exec($connexion,$queryPole);
                                    while (odbc_fetch_row($selectPole)) {
                                        $id_poles[]=odbc_result($selectPole,'id_pole');
                                    }
                                }
                                foreach ($id_poles as $id_pole) {
                                    $queryPole="SELECT id_pole,nom_pole FROM pole WHERE id_pole='$id_pole'";
                                    $selectPole=odbc_exec($connexion,$queryPole);
                                    while(odbc_fetch_row( $selectPole)){
                                        $idpole=odbc_result($selectPole,'id_pole');
                                        $nompole=odbc_result($selectPole,'nom_pole');    
                                        echo '<option value="'.$idpole.'">'.$nompole.'</option>';
                                    }
                                }
                            ?>  
                        </select>
                        <label for="agence">Agency:</label><br>
                        <select name="agence" id="agence"  class="form-control">
                            <!-- j'affiche les differents agences -->
                            <?php
                                //je charge les champs select agence
                                //je recupere les clients de mes agences
                                foreach ($id_poles as $idPole) {
                                    $queryAgenceId="SELECT id_agence FROM agence WHERE id_pole='$idPole'";
                                    $selectAgenceId=odbc_exec($connexion,$queryAgenceId);
                                    while (odbc_fetch_row($selectAgenceId)) {
                                        $id_agences[]=odbc_result($selectAgenceId,'id_agence');
                                    }
                                }
                                foreach ($id_agences as $id_agence) {
                                    $queryAgence="SELECT id_agence,nom_agence FROM agence WHERE id_agence='$id_agence'";
                                    $selectAgence=odbc_exec($connexion,$queryAgence);
                                    while(odbc_fetch_row( $selectAgence)){
                                        $idagence=odbc_result($selectAgence,'id_agence');
                                        $nomagence=odbc_result($selectAgence,'nom_agence');    
                                        echo '<option value="'.$idagence.'">'.$nomagence.'</option>';
                                    }
                                }
                            ?> 
                        </select>
                        <label for="password">Password:</label><br>
                        <input type="password" name="password" id="password" class="form-control" maxlength="8">
                        <label for="confirmPassword" class="labelConfirm">Confirm Password:</label><br>
                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" maxlength="8"><br>
                        <!-- message de verification des champs -->
                        <span id="verification"></span><br>
                        <?=$erreur?>
                        <!-- ferme la connexion -->
                        <?=finconnexion();?>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                    <a href="./viewUser.php" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                        </svg> View Profiles
                    </a>
                </form>
            </div>
            <div class="col-lg-6">
                <svg id="a5c16198-98a1-478b-8909-43624583dcf2" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" width="auto" height="auto" viewBox="0 0 793 551.73152"><ellipse cx="158" cy="539.73152" rx="158" ry="12" fill="#e6e6e6"/><path d="M324.27227,296.55377c27.49676-11.6953,61.74442-4.28528,95.19092.85757.31124-6.228,4.08385-13.80782.132-18.15284-4.80115-5.2788-4.35917-10.82529-1.47008-16.40375,7.38788-14.265-3.1969-29.44375-13.88428-42.0647a23.66937,23.66937,0,0,0-19.75537-8.29179l-19.7975,1.41411A23.70939,23.70939,0,0,0,343.635,230.85851v0c-4.72724,6.42917-7.25736,12.84055-5.66438,19.21854-7.08065,4.83882-8.27029,10.67977-5.08851,17.2644,2.698,4.14592,2.66928,8.18161-.12275,12.1056a55.89079,55.89079,0,0,0-8.31011,16.5061Z" transform="translate(-203.5 -174.13424)" fill="#2f2e41"/><path d="M977.70889,651.09727H417.29111A18.79111,18.79111,0,0,1,398.5,632.30616h0q304.727-35.41512,598,0h0A18.79111,18.79111,0,0,1,977.70889,651.09727Z" transform="translate(-203.5 -174.13424)" fill="#2f2e41"/><path d="M996.5,633.41151l-598-1.10536,69.30611-116.61553.3316-.55268V258.13057a23.7522,23.7522,0,0,1,23.75418-23.75418H899.792a23.7522,23.7522,0,0,1,23.75418,23.75418V516.90649Z" transform="translate(-203.5 -174.13424)" fill="#3f3d56"/><path d="M491.35028,250.95679a7.74623,7.74623,0,0,0-7.73753,7.73753V493.03073a7.74657,7.74657,0,0,0,7.73753,7.73752H903.64972a7.74691,7.74691,0,0,0,7.73753-7.73752V258.69432a7.74657,7.74657,0,0,0-7.73753-7.73753Z" transform="translate(-203.5 -174.13424)" fill="#fff"/><path d="M493.07794,531.71835a3.32522,3.32522,0,0,0-3.01275,1.93006l-21.35537,46.42514a3.31594,3.31594,0,0,0,3.01221,4.7021H920.81411a3.3157,3.3157,0,0,0,2.96526-4.79925L900.5668,533.55126a3.29926,3.29926,0,0,0-2.96526-1.83291Z" transform="translate(-203.5 -174.13424)" fill="#2f2e41"/><circle cx="492.34196" cy="67.97967" r="4.97412" fill="#fff"/><path d="M651.69986,593.61853a3.32114,3.32114,0,0,0-3.20165,2.4536l-5.35679,19.89649a3.31576,3.31576,0,0,0,3.20166,4.17856h101.874a3.31531,3.31531,0,0,0,3.13257-4.40093l-6.88691-19.89649a3.31784,3.31784,0,0,0-3.13366-2.23123Z" transform="translate(-203.5 -174.13424)" fill="#2f2e41"/><polygon points="720.046 337.135 720.046 341.556 264.306 341.556 264.649 341.004 264.649 337.135 720.046 337.135" fill="#2f2e41"/><circle cx="707.33457" cy="77.37523" r="77.37523" fill="#6c63ff"/><path d="M942.89,285.223H878.77911a4.42582,4.42582,0,0,1-4.42144-4.42145V242.11391a4.42616,4.42616,0,0,1,4.42144-4.42144H942.89a4.42616,4.42616,0,0,1,4.42144,4.42144v38.68761A4.42582,4.42582,0,0,1,942.89,285.223Zm-64.11091-43.10906v38.68761h64.11415L942.89,242.11391Z" transform="translate(-203.5 -174.13424)" fill="#fff"/><path d="M930.73105,242.11391h-39.793V224.42814c0-12.80987,8.36792-22.10721,19.89649-22.10721s19.89648,9.29734,19.89648,22.10721Zm-35.37153-4.42144h30.95009V224.42814c0-10.413-6.36338-17.68576-15.475-17.68576s-15.47505,7.27281-15.47505,17.68576Z" transform="translate(-203.5 -174.13424)" fill="#fff"/><circle cx="707.33457" cy="86.21811" r="4.42144" fill="#fff"/><path d="M856.81994,421.28372H538.18006a5.90767,5.90767,0,0,1-5.90073-5.90073V336.342a5.90767,5.90767,0,0,1,5.90073-5.90072H856.81994a5.90767,5.90767,0,0,1,5.90073,5.90072V415.383A5.90767,5.90767,0,0,1,856.81994,421.28372Zm-318.63988-88.4821a3.5443,3.5443,0,0,0-3.54043,3.54043V415.383a3.54431,3.54431,0,0,0,3.54043,3.54044H856.81994a3.54431,3.54431,0,0,0,3.54043-3.54044V336.342a3.5443,3.5443,0,0,0-3.54043-3.54043Z" transform="translate(-203.5 -174.13424)" fill="#e6e6e6"/><circle cx="384.19021" cy="198.69546" r="24.03645" fill="#e6e6e6"/><path d="M643.203,356.80541a4.00608,4.00608,0,1,0,0,8.01215H832.06074a4.00607,4.00607,0,0,0,0-8.01215Z" transform="translate(-203.5 -174.13424)" fill="#e6e6e6"/><path d="M643.203,380.84186a4.00607,4.00607,0,1,0,0,8.01214H724.469a4.00607,4.00607,0,1,0,0-8.01214Z" transform="translate(-203.5 -174.13424)" fill="#e6e6e6"/><path d="M467.022,382.46241,408.1189,413.778l-.74561-26.09629c19.22553-3.20948,37.51669-8.7974,54.42941-17.8946l6.1605-15.22008a10.31753,10.31753,0,0,1,17.53643-2.67788l0,0a10.31753,10.31753,0,0,1-.90847,14.06885Z" transform="translate(-203.5 -174.13424)" fill="#ffb8b8"/><path d="M323.09819,563.26707v0a11.57378,11.57378,0,0,1,1.46928-9.36311l12.93931-19.85777a22.61221,22.61221,0,0,1,29.335-7.73927h0c-5.438,9.25647-4.67994,17.37679,1.87806,24.43365a117.63085,117.63085,0,0,0-27.93606,19.04492A11.57386,11.57386,0,0,1,323.09819,563.26707Z" transform="translate(-203.5 -174.13424)" fill="#2f2e41"/><path d="M469.70475,537.30274l0,0a22.20314,22.20314,0,0,1-18.87085,10.77909l-85.96027.65122-3.728-21.62264,38.026-11.18413-32.06116-24.60507L402.154,450.31277l63.65,59.32431A22.20317,22.20317,0,0,1,469.70475,537.30274Z" transform="translate(-203.5 -174.13424)" fill="#2f2e41"/><path d="M351.45266,685.17939H331.32124c-18.07509-123.89772-36.47383-248.14186,17.8946-294.51529l64.12231,10.43852L405.13646,455.532l-35.7892,41.00845Z" transform="translate(-203.5 -174.13424)" fill="#2f2e41"/><path d="M369.14917,713.24594h0a11.57381,11.57381,0,0,1-9.3632-1.46873l-21.85854-2.93814a22.61221,22.61221,0,0,1-7.741-29.33451v0c9.2568,5.43749,17.37707,4.67891,24.43354-1.8795,4.98593,10.06738,13.20093,9.45331,21.04657,17.93494A11.57385,11.57385,0,0,1,369.14917,713.24594Z" transform="translate(-203.5 -174.13424)" fill="#2f2e41"/><path d="M399.1716,307.90158l-37.28042-8.94731c6.19168-12.6739,6.70155-26.77618,3.728-41.75406l25.35068-.74561C391.76421,275.08,394.16732,292.48081,399.1716,307.90158Z" transform="translate(-203.5 -174.13424)" fill="#ffb8b8"/><path d="M409.41752,423.55243c-27.13873,18.49308-46.31418.63272-60.94729-26.92346,2.03338-16.86188-1.259-37.04061-7.35672-58.96635a40.13762,40.13762,0,0,1,24.50567-48.40124h0l32.06116,13.421c27.22362,22.19038,32.582,46.227,22.36825,71.5784Z" transform="translate(-203.5 -174.13424)" fill="#6c63ff"/><path d="M331.32124,326.54178,301.4969,342.19956l52.9382,31.31555,7.366,18.16951a9.63673,9.63673,0,0,1-5.78925,12.73088h0a9.63673,9.63673,0,0,1-12.76159-8.54442l-.74489-12.66307-67.2838-22.20366a15.73306,15.73306,0,0,1-9.87265-9.61147v0a15.733,15.733,0,0,1,5.90262-18.30258l54.10485-37.11845Z" transform="translate(-203.5 -174.13424)" fill="#ffb8b8"/><path d="M361.14557,329.52422c-12.43861-5.4511-23.74934.47044-38.026,5.21926l-2.23683-39.51725c14.17612-7.55568,27.69209-9.59281,40.26285-3.728Z" transform="translate(-203.5 -174.13424)" fill="#6c63ff"/><circle cx="172.52496" cy="78.09251" r="23.80211" fill="#ffb8b8"/><path d="M404.5,249.22353c-23.56616,2.30811-41.52338-1.54606-53-12.52007v-8.8377h51Z" transform="translate(-203.5 -174.13424)" fill="#2f2e41"/></svg>
            </div>
        </div>
    </main>
</body>
</html>