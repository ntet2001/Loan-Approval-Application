<?php
    require_once "../Fonction/auth_function.php";
    //ajout de la session et connexion et verification de l'id section
    ajoutsession();
    estconnecte();
    $connexion=connexion();
    $erreur=null;
    $idReseau=$_SESSION['id_reseau'];
    
    // je recupere ici la liste des menus
    $queryMenu="SELECT id_menu, nom_menu FROM menu ";
    $selectMenu=odbc_exec($connexion,$queryMenu);

    // je recupere le nom du reseau
    $queryReseau="SELECT nom_reseau FROM reseau WHERE id_reseau='$idReseau'";
    $ResultatReseau=odbc_exec($connexion,$queryReseau);
    while (odbc_fetch_row($ResultatReseau)) {
        $nomReseau=odbc_result($ResultatReseau,'nom_reseau');
    }

    //je recupere ici la liste des profils
    $queryProfil="SELECT id_profil,nom_profil FROM profil";
    $selectProfil=odbc_exec($connexion,$queryProfil);

    //je charge les infos dans le tableau
    $queryMenuProfil="SELECT profil_menu.id, menu.nom_menu, profil.nom_profil
    FROM profil_menu
    INNER JOIN menu
    ON profil_menu.id_menu= menu.id_menu
    INNER JOIN profil
    ON profil_menu.id_profil=profil.id_profil";
    $selectMenuProfil=odbc_exec($connexion,$queryMenuProfil);

    //j'insere un nouveau menu a un profil
    if (!empty($_POST['profil']) && !empty($_POST['menu'])) {
        $data=[];
        $data[0]=$_POST['profil'];
        $data[1]=$_POST['menu'];
        $queryinsert="INSERT INTO profil_menu(id_profil,id_menu) VALUES ('$data[0]','$data[1]')";
        $insert=odbc_exec($connexion,$queryinsert);
        header('Location: ./indexMenuprofile.php');
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
    <link rel="stylesheet" href="../dist/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../connexion/headerAdmin/headerAdmin.css">
        <!--call bootstrap javascript-->
    <script src="../dist/jquery/jquery-3.6.0.min.js"></script>
    <script src="../dist/jquery/jquery.dataTables.min.js"></script>
    <script src="../dist/js/bootstrap.js"></script>
    <script src="../dist/js/dataTables.bootstrap4.min.js"></script>
    <script src="../dist/js/popper.min.js"></script>
    <script defer>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
</head>
<body>
    <!---header pour ma navbar -->
    <header>
        <nav class="navbar  navbar-expand-lg navbar-light bg-primary fixed-top">
            <div class="container-fluid">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#monMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
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
    <!--main de mon fichier avec formulaire et tableau-->
    <main class="container">
         <h1 style="text-align: center;">Profile-Menu</h1><br>
        <!---Formulaire-->
        <div class="row formulaire">
            <div class="col-lg-6">
                <form action="indexMenuprofile.php" method="post" autocomplete="off">
                    <div class="form-group">
                        <label for="profil"><h3>Choose Profile</h3></label><br>
                        <select name="profil" id="profil" class="form-control">
                            <!-- j'affiche les differents profils -->
                            <?php while(odbc_fetch_row($selectProfil)):?>
                                <?php
                                    $idprofil=odbc_result($selectProfil,'id_profil');
                                    $nomprofil=odbc_result($selectProfil,'nom_profil');    
                                ?>
                                <option value="<?=$idprofil?>"><?=$nomprofil?></option>
                            <?php endwhile;?> 
                        </select>
                        <label for="menu"><h3>Choose Menu</h3></label><br>
                        <select name="menu" id="menu" class="form-control">
                            <!-- j'affiche les differents menus -->
                            <?php $disable=null;?>
                            <?php while(odbc_fetch_row($selectMenu)):?>
                                <?php
                                    $idMenu=odbc_result($selectMenu,'id_menu');
                                    $nomMenu=odbc_result($selectMenu,'nom_menu');    
                                ?>
                                <?php
                                    if ($nomMenu == 'files') {
                                       $disable="disabled";
                                    }else{
                                        $disable=null;
                                    }
                                ?>
                                <option value="<?=$idMenu?>" <?=$disable?>><?=$nomMenu?></option>
                            <?php endwhile;?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-primary">Reset</button>
                    <?=$erreur?>
                </form>
            </div>
            <div class="col-lg-4">
                <svg id="bb1959b4-201d-4db0-994c-74206432dcb3" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" width="auto" height="auto" viewBox="0 0 952 586"><path id="a163713d-a7fc-4807-a77b-111ad75719e9" data-name="Path 133" d="M170.63353,697.233a158.3937,158.3937,0,0,0,7.4,43.785c.1.329.211.653.319.982h27.613c-.029-.295-.059-.624-.088-.982-1.841-21.166,8.677-148.453,21.369-170.483C226.13454,572.322,168.49254,629.979,170.63353,697.233Z" transform="translate(-124 -157)" fill="#f1f1f1"/><path id="a1d5a274-7181-45f3-aae5-db776f20014a" data-name="Path 134" d="M172.70558,741.018c.231.329.471.658.717.982h20.716c-.157-.28-.339-.609-.55-.982-3.422-6.176-13.551-24.642-22.953-43.785-10.1-20.572-19.374-41.924-18.593-49.652C151.80058,649.323,144.80861,702.457,172.70558,741.018Z" transform="translate(-124 -157)" fill="#f1f1f1"/><path d="M775.29126,277.577a14.42246,14.42246,0,0,0,21.04127,6.80778l39.97977,32.06957,2.47488-26.51836-38.34489-26.38825a14.50066,14.50066,0,0,0-25.151,14.02926Z" transform="translate(-124 -157)" fill="#9f616a"/><polygon points="713.205 130.446 698.283 119.903 681.358 139.458 701.046 151.126 713.205 130.446" fill="#6c63ff"/><path d="M833.93681,280.29582l50.28691,19.349L932.63291,267.947a24.62075,24.62075,0,0,1,31.79547,37.06016l-.433.48083-74.454,39.9183-81.32649-37.15291Z" transform="translate(-124 -157)" fill="#3f3d56"/><polygon points="695.76 583 171.76 583 190.76 212 272.76 212 348.374 265 714.76 265 695.76 583" fill="#e5e5e5"/><path d="M691.4891,626.86286,388.6242,502.13469a4.32609,4.32609,0,0,1-2.35009-5.64107L523.508,163.26232a4.3261,4.3261,0,0,1,5.64107-2.35009L832.014,285.6404a4.32609,4.32609,0,0,1,2.35009,5.64107L697.13017,624.51277A4.32609,4.32609,0,0,1,691.4891,626.86286Z" transform="translate(-124 -157)" fill="#fff"/><path d="M691.4891,626.86286,388.6242,502.13469a4.32609,4.32609,0,0,1-2.35009-5.64107L523.508,163.26232a4.3261,4.3261,0,0,1,5.64107-2.35009L832.014,285.6404a4.32609,4.32609,0,0,1,2.35009,5.64107L697.13017,624.51277A4.32609,4.32609,0,0,1,691.4891,626.86286ZM528.49088,162.51046a2.59553,2.59553,0,0,0-3.38465,1.41006L387.87234,497.15182a2.59552,2.59552,0,0,0,1.41005,3.38464l302.8649,124.72817a2.59553,2.59553,0,0,0,3.38465-1.41L832.76583,290.62327a2.59552,2.59552,0,0,0-1.41005-3.38464Z" transform="translate(-124 -157)" fill="#3f3d56"/><path d="M614.03119,325.86654,538.9143,294.93132a4.32609,4.32609,0,0,1-2.35009-5.64107l30.93522-75.11689a4.3261,4.3261,0,0,1,5.64107-2.35009l75.11689,30.93522a4.3261,4.3261,0,0,1,2.35009,5.64107l-30.93522,75.11689A4.3261,4.3261,0,0,1,614.03119,325.86654ZM572.4823,213.4215a2.59553,2.59553,0,0,0-3.38464,1.41006l-30.93522,75.11689a2.59553,2.59553,0,0,0,1.41006,3.38464l75.11688,30.93522a2.59553,2.59553,0,0,0,3.38465-1.41006l30.93521-75.11689a2.59551,2.59551,0,0,0-1.41-3.38464Z" transform="translate(-124 -157)" fill="#f2f2f2"/><path d="M588.67043,326.17072,513.55354,295.2355a3.89342,3.89342,0,0,1-2.11508-5.077l30.93522-75.11689a3.89343,3.89343,0,0,1,5.077-2.11508l75.11688,30.93522a3.89341,3.89341,0,0,1,2.11508,5.077l-30.93522,75.11689A3.89341,3.89341,0,0,1,588.67043,326.17072Z" transform="translate(-124 -157)" fill="#6c63ff"/><path d="M733.35509,428.74966,498.415,331.99483a3.889,3.889,0,1,1,2.96189-7.192L736.317,421.55762a3.889,3.889,0,0,1-2.96188,7.192Z" transform="translate(-124 -157)" fill="#ccc"/><path d="M666.41582,430.15629,488.213,356.76742a3.889,3.889,0,1,1,2.96188-7.192l178.20284,73.38887a3.889,3.889,0,1,1-2.96189,7.192Z" transform="translate(-124 -157)" fill="#ccc"/><path d="M770.07315,337.32136,666.18809,294.53861a3.889,3.889,0,1,1,2.96189-7.192l103.885,42.78275a3.889,3.889,0,0,1-2.96188,7.192Z" transform="translate(-124 -157)" fill="#ccc"/><path d="M733.94491,351.41683,655.98605,319.3112a3.889,3.889,0,1,1,2.96189-7.192l77.95886,32.10562a3.889,3.889,0,0,1-2.96189,7.192Z" transform="translate(-124 -157)" fill="#ccc"/><path d="M712.951,478.29485,478.011,381.54a3.889,3.889,0,1,1,2.96188-7.192L715.91289,471.1028a3.889,3.889,0,0,1-2.96188,7.192Z" transform="translate(-124 -157)" fill="#ccc"/><path d="M646.01174,479.70147,467.80891,406.3126a3.889,3.889,0,1,1,2.96188-7.192l178.20284,73.38887a3.889,3.889,0,1,1-2.96189,7.192Z" transform="translate(-124 -157)" fill="#ccc"/><path d="M692.54693,527.84,457.60687,431.0852a3.889,3.889,0,0,1,2.96188-7.192L695.50881,520.648a3.889,3.889,0,0,1-2.96188,7.192Z" transform="translate(-124 -157)" fill="#ccc"/><path d="M682.34489,552.61262,447.40483,455.85779a3.889,3.889,0,0,1,2.96188-7.192l234.94006,96.75484a3.889,3.889,0,0,1-2.96188,7.192Z" transform="translate(-124 -157)" fill="#ccc"/><path d="M567.73018,550.77248a84.70308,84.70308,0,0,0,14.09436-.43c4.21238-.49243,8.60066-1.17049,12.29309-3.38536a11.6831,11.6831,0,0,0,5.8212-8.83535,8.2218,8.2218,0,0,0-4.975-8.33661,9.80892,9.80892,0,0,0-9.95124,1.3943,12.959,12.959,0,0,0-4.44981,10.35166c.194,8.00444,6.52716,15.90938,13.55947,19.23894,7.92082,3.75025,18.73754.56318,20.76617-8.67189.42194-1.92082-2.19428-2.58835-3.288-1.35411a8.72086,8.72086,0,0,0,12.17216,12.44835l-2.94431-1.21255a20.9902,20.9902,0,0,0,14.43752,15.24852,19.46991,19.46991,0,0,0,5.37174.81856c2.2119.00621,4.48428,1.11646,6.59962,1.80561l15.24432,4.96639c2.24232.73052,3.665-2.67332,1.40427-3.40985l-13.80618-4.49787c-2.30073-.74955-4.59586-1.51967-6.90308-2.24893-1.64936-.52133-3.45545-.23905-5.176-.54579a17.28811,17.28811,0,0,1-13.5191-12.64511,1.86584,1.86584,0,0,0-2.9443-1.21254,5.04821,5.04821,0,0,1-7.02188-7.25421l-3.288-1.35411c-1.30866,5.95754-8.576,8.19323-13.81358,6.47055-5.85748-1.92656-10.892-7.53271-12.639-13.4049a10.8108,10.8108,0,0,1,.7867-8.60233,6.443,6.443,0,0,1,6.75034-3.30637,4.62264,4.62264,0,0,1,3.95027,5.07015,8.26891,8.26891,0,0,1-4.60472,6.264c-3.29662,1.7695-7.24432,2.21012-10.90575,2.61181a78.79791,78.79791,0,0,1-12.57356.3577c-2.35393-.11867-2.82641,3.54144-.44763,3.66136Z" transform="translate(-124 -157)" fill="#6c63ff"/><polygon points="695.76 290 695.76 583 171.76 583 171.76 237 253.76 237 329.37 290 695.76 290" fill="#fff"/><rect x="203.75984" y="528" width="214" height="17" fill="#6c63ff"/><rect x="203.75984" y="495" width="107" height="17" fill="#6c63ff"/><path d="M820.75984,741h-526V393h83.31555l75.61414,53H820.75984Zm-524-2h522V448H453.05843l-75.61414-53H296.75984Z" transform="translate(-124 -157)" fill="#3f3d56"/><polygon points="909.144 548.636 891.414 554.972 858.535 489.598 884.704 480.246 909.144 548.636" fill="#9f616a"/><path d="M986.63848,741.638l-.25872-.72291a23.659,23.659,0,0,1,14.30045-30.20571l34.91779-12.47929,8.21153,22.97656Z" transform="translate(-124 -157)" fill="#2f2e41"/><polygon points="793.848 566.172 775.019 566.172 766.062 493.546 793.851 493.547 793.848 566.172" fill="#9f616a"/><path d="M922.64961,741.42424l-60.71214-.00225v-.76791A23.63085,23.63085,0,0,1,885.5687,717.0236h.0015l37.08053.0015Z" transform="translate(-124 -157)" fill="#2f2e41"/><path d="M960.75907,259.18645l-8.18861-16.18053s-30.50532,7.64282-33.27853,25.32289Z" transform="translate(-124 -157)" fill="#6c63ff"/><polygon points="870.547 287.198 848.278 411.467 907.407 516.036 872.083 529.858 812.186 428.494 804.507 400.849 799.899 545.216 768.042 544.249 753.435 409.445 776.862 284.127 870.547 287.198" fill="#2f2e41"/><path d="M989.9385,388.055l-.77018-72.87145c0-30.88384-20.32611-53.64707-23.14362-55.75276-1.32569-4.231-3.70431-7.15557-7.0678-8.68606-6.77553-3.07086-15.06191.61412-15.41273.77989L918.685,260.84434l-.11662.34118c-.26371.77988-25.3466,83.08812-31.64469,103.74554-.8968,2.96364-1.41327,4.6599-1.41327,4.6599s.09758,4.77688.27275,12.20538c.556,25.54152,1.87167,82.43492,2.39814,84.82336,0,0,45.91642,6.96052,64.09763,6.96052,32.70714,0,53.48166-6.25865,53.94958-6.36587l.75066-.156Z" transform="translate(-124 -157)" fill="#3f3d56"/><circle cx="927.1367" cy="204.30312" r="33.60816" transform="translate(-108.38042 312.74381) rotate(-28.66301)" fill="#9f616a"/><path d="M930.86135,372.63255l-45.07817,9.16379c-.17517-7.4285-.27275-12.20538-.27275-12.20538s.51647-1.69626,1.41327-4.6599Z" transform="translate(-124 -157)" opacity="0.2"/><path d="M797.36935,363.02694a14.4225,14.4225,0,0,0,21.81522-3.63l50.24885,10.09416-9.99619-24.68652-46.18464-5.80088a14.50066,14.50066,0,0,0-15.88324,24.02326Z" transform="translate(-124 -157)" fill="#9f616a"/><polygon points="732.887 186.321 714.788 183.82 708.751 208.968 731.599 210.276 732.887 186.321" fill="#6c63ff"/><path d="M850.69724,338.47437l53.55238-5.94132,28.41215-50.40785a24.62075,24.62075,0,0,1,45.27595,18.28923l-.16338.62608-47.76016,69.68386-89.30252,4.40419Z" transform="translate(-124 -157)" fill="#3f3d56"/><path d="M955.76343,233.48271l-27.895,1.00127c-1.70035.061-6.31513-18.28939-6.91921-22.09617a10.3896,10.3896,0,0,0-10.838-8.40483c-2.08811.19724-7.35359-3.70388-12.78705-8.32323-10.31547-8.76987-9.77883-25.241,1.55269-32.65157q.46458-.30381.91188-.55481c7.14855-4.00112,15.511-5.34475,23.70251-5.44721,7.42579-.09288,15.06209.84177,21.60406,4.35653,11.72836,6.30122,17.97016,20.07116,18.51843,33.37376s-3.71631,26.31011-8.55563,38.71336" transform="translate(-124 -157)" fill="#2f2e41"/><path d="M1075,743H125a1,1,0,0,1,0-2h950a1,1,0,0,1,0,2Z" transform="translate(-124 -157)" fill="#cbcbcb"/></svg>
            </div>
        </div>
        <!----tableau---->
        <div class="row tableau" style="margin-top: 50px;">
            <div class="col">
                <caption><h4>ALL MENUS</h4></caption>
                <table id="example" class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Profile</th>
                            <th>Menu</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- j'affiche les differents menus dans le tableau -->
                        <?php while(odbc_fetch_row($selectMenuProfil)):?>
                                <?php
                                    $idMenuProfil=odbc_result($selectMenuProfil,'id');
                                    $profilNom=odbc_result($selectMenuProfil,'nom_profil');    
                                    $menuNom=odbc_result($selectMenuProfil,'nom_menu');    
                                ?>
                        <tr>
                            <td><?=$idMenuProfil?></td>
                            <td><?=$profilNom?></td>
                            <td><?=$menuNom?></td>
                            <td>
                                <a href="<?='./updateMenuprofile.php?id='.$idMenuProfil?>" class="btn btn-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                    </svg> Modify
                                </a> 
                                <a href="<?='./deleteMenuprofile.php?id='.$idMenuProfil?>" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg> Delete
                                </a>
                            </td>
                        </tr>
                        <?php endwhile;?>
                        <!-- ferme la connexion -->
                        <?=finconnexion();?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>