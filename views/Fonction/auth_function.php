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
    function gestMenu(array $menu ,string $profil)
    {   
        $menus=[];
        foreach ($menu as $nomMenu) {
            if ($nomMenu == 'files') {
                $menus[]='<a class="dropdown-item" href="../Organisation/indexSection.php">Section</a>';
                $menus[]='<a class="dropdown-item" href="../Organisation/indexPole.php">Pole</a>';
                $menus[]='<a class="dropdown-item" href="../Organisation/indexAgence.php">Agency</a>';
                $menus[]='<a class="dropdown-item" href="../Organisation/indexClient.php">Customer</a>';
                $menus[]='<a class="dropdown-item" href="../Loan/indexDocument.php">Document</a>';
                $menus[]='<a class="dropdown-item" href="../Loan/indexType.php">Type Loan</a>';
                $menus[]='<a class="dropdown-item" href="../Loan/indexBut.php">Purpose Loan</a>';
                $menus[]='<a class="dropdown-item" href="../Loan/indexNature.php">Nature Loan</a>';
                //pour les traitements
            }else if($nomMenu == 'traitment'){
                if ($profil == 'initiator') {
                    $menus[]='<li class="nav-item"><a class="nav-link" href="../Loan/initiation.php">initiation</a></li>';
                }elseif($profil == 'confirmer'){
                    $menus[]='<li class="nav-item"><a class="nav-link" href="../Loan/indexConformite.php">Conformity</a></li>';
                }elseif($profil == 'analyst'){
                    $menus[]='<li class="nav-item"><a class="nav-link" href="../Loan/analyse.php">Analyst</a></li>';
                }elseif($profil == '1st evaluator'){
                    $menus[]='<li class="nav-item"><a class="nav-link" href="../Loan/evaluation1.php">1st Evaluation</a></li>';
                }elseif($profil == '2nd evaluator'){
                    $menus[]='<li class="nav-item"><a class="nav-link" href="../Loan/evaluation2.php">2nd Evaluation</a></li>';
                }elseif($profil == '3rd evaluator'){
                    $menus[]='<li class="nav-item"><a class="nav-link" href="../Loan/evaluation3.php">3rd Evaluation</a></li>';
                }elseif($profil == 'directory board'){
                    $menus[]='<li class="nav-item"><a class="nav-link" href="../Loan/manager.php">Directory Board</a></li>';
                }elseif($profil == 'credit comittee'){
                    $menus[]='<li class="nav-item"><a class="nav-link" href="../Loan/comittee.php">Credit Comittee</a></li>';
                }else{
                    $menus[]='<li class="nav-item"><a class="nav-link" href="../Loan/creditAdmin.php">Credit Administration</a></li>';
                }
            }
            elseif ($nomMenu == 'consultation') {
                $menus[]='<li class="nav-item"><a class="nav-link href="../Analyse/indexConsultation.php">Consultation</a></li>';
            }elseif ($nomMenu == 'analyses') {
                $menus[]='<li class="nav-item"><a class="nav-link href="../Analyse/indexAnalyse.php">Analyses</a></li>';
            }elseif ($nomMenu == 'tools') {
                $menus[]='<li class="nav-item"><a class="nav-link href="../Analyse/indexOutils.php">Tools</a></li>';
            }else{
                break;
            }
        }
        //retourne le tableau de menus
        return $menus;

    }

    
?>
