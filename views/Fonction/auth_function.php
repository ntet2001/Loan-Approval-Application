<?php
    //fonction pour la connexion a la bd
    function connexion()
    {
        $cursor_option = SQL_CUR_USE_DRIVER;
        $serveur='DESKTOP-JHVHF00\SQLEXPRESS01';
        $database='db_gestion_credit';
        $user='ntet';
        $pwd='credit2021';
        try {
            $connexion=odbc_connect("DRIVER={SQL Server};SERVER=$serveur;DATABASE=$database",$user,$pwd,$cursor_option);
            return $connexion;
        } catch (Exception $e) {
            echo 'erreur'.$e->getMessage();
        }   
    }  
    
    //fonction de fermeture de la connexion
    function finconnexion()
    {
        odbc_close(connexion());
    }

    //ajout de session
    function ajoutsession(){
        session_start();
    }

    //retirer session
    function retirersession(array $data){
        session_unset($data);
        session_destroy();
        header('Location: ./login.php');
    }

    // fonction pour verifier si l'utilisateur est connecte
    function estconnecte(){
        if($_SESSION['connecte'] != 1){
            header('Location: ../connexion/login.php');
        }
    }

    // fonction pour verifier id passer par l'url
    function checkinput($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }

    //fonction pour verifier les menus d'un utilisateur et les retournes
    function gestMenu($menu ,string $profil)
    {   
        $menus=[];
        $taille=null;
        $lien1=null;
        //pour les traitements
        if ($profil == 'initiator') {
            $lien1='<li class="nav-item"><a class="nav-link" href="../Loan/initiation.php">initiation</a></li>';
        }elseif($profil == 'confirmer'){
            $lien1='<li class="nav-item"><a class="nav-link" href="../Loan/indexConformite.php">Conformity</a></li>';
        }elseif($profil == 'analyst'){
            $lien1='<li class="nav-item"><a class="nav-link" href="../Loan/analyse.php">Analyst</a></li>';
        }elseif($profil == '1st evaluator'){
            $lien1='<li class="nav-item"><a class="nav-link" href="../Loan/evaluation1.php">1st Evaluation</a></li>';
        }elseif($profil == '2nd evaluator'){
            $lien1='<li class="nav-item"><a class="nav-link" href="../Loan/evaluation2.php">2nd Evaluation</a></li>';
        }elseif($profil == '3rd evaluator'){
            $lien1='<li class="nav-item"><a class="nav-link" href="../Loan/evaluation3.php">3rd Evaluation</a></li>';
        }elseif($profil == 'directory board'){
            $lien1='<li class="nav-item"><a class="nav-link" href="../Loan/manager.php">Directory Board</a></li>';
        }elseif($profil == 'credit comittee'){
            $lien1='<li class="nav-item"><a class="nav-link" href="../Loan/comittee.php">Credit Comittee</a></li>';
        }else{
            $lien1='<li class="nav-item"><a class="nav-link" href="../Loan/creditAdmin.php">Credit Administration</a></li>';
        }
        $menus[0]=$lien1;
        //autres menu
        if(is_array($menu)){
            $taille=count($menu);
        }
        for ($i=0; $i<$taille ;$i++) {
            if ($menu[$i]== 'consultation') {
                $menus[]='<li class="nav-item"><a class="nav-link" href="../Analyse/indexConsultation.php">Consultation</a></li>';
            }elseif ($menu[$i] == 'analyses') {
                $menus[]='<li class="nav-item"><a class="nav-link" href="../Analyse/indexAnalyse.php">Analyses</a></li>';
            }elseif ($menu[$i] == 'tools') {
                $menus[]='<li class="nav-item"><a class="nav-link" href="../Analyse/indexOutils.php">Tools</a></li>';
            }else{
               $menus[]=null;
            }
        }
        //retourne le tableau de menus
        return $menus;

    }

    
?>
