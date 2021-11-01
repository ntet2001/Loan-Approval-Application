<?php
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--link call bootstrap css-->
    <link rel="stylesheet" href="../../../dist/css/bootstrap.css">
    <link rel="stylesheet" href="../../../dist/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../headerAdmin/headerAdmin.css">
    <link rel="stylesheet" href="styleReseau.css">
        <!--call bootstrap javascript-->
    <script src="../../../dist/jquery/jquery-3.6.0.min.js"></script>
    <script src="../../../dist/jquery/jquery.dataTables.min.js"></script>
    <script src="../../../dist/js/bootstrap.js"></script>
    <script src="../../../dist/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../../dist/js/popper.min.js"></script>
    <script defer>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
</head>
<body>
    <!---header pour ma navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
            <div class="container-fluid">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#monMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
               <div class="collapse navbar-collapse" id="monMenu">
                        <!--dropdown pour fichier-->
                    
                    <!--dropdown pour traitement-->
                    
                    <!--autres liens-->
                    
                        <a href="../../../deconnexion.php" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
                                <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                            </svg>Log Out 
                        </a>
                    </li>
               </div>
            </div>
        </nav>
    </header>
    <!--mon main avec mon Formulaire d'enregistrement-->
    <main class="container">
        <h3 style="text-align: center;margin-bottom:50px;">Register Customer</h3>
        <form action="indexClient.php" method="post">
            <div class="row formulaire">
                <div class="col-lg-6 form-group">
                    <label for="numClient">Customer No:</label><br>
                    <input type="text" name="numClient" id="numClient" class="form-control"><br>
                    <label for="nomClient">Custormer Name</label><br>
                    <input type="text" name="nomClient" id="nomClient" class="form-control" placeholder="ex: Doe"><br>
                    <label for="prenomClient">Last Name</label><br>
                    <input type="text" name="prenomClient" id="prenomClient" class="form-control" placeholder="ex: John"><br>
                    <input type="file" name="infoClient" id="infoClient">
                </div>
                <div class="col-lg-6 form-group">
                    <label for="emailClient">Customer Email</label><br>
                    <input type="email" name="emailClient" id="emailClient" class="form-control" placeholder="Johndoe@gmail.com"><br>
                    <label for="telephoneClient">Custormer Phone</label><br>
                    <input type="tel" name="telephoneClient" id="telephoneClient" class="form-control" placeholder="+237 6xx-xx-xx-xx"><br>
                    <label for="AgenceClient">Agency</label><br>
                    <select name="AgenceClient" id="AgenceClient" class="form-control">
                        <option value=""></option>
                    </select>
                </div>
            </div>
            <button type="reset" class="btn btn-primary">Reset</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <div class="row" style="margin-top: 50px;">
            <div class="col">
            <caption><h4 style="text-align: center;">ALL CUSTOMERS</h4></caption>
                <table id="example" class="table table-hover table-bordered table-triped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Customers Name</th>
                            <th>Agency Name</th>
                            <th>Customers Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Titre Foncier</td>
                            <td>John Doe</td>
                            <td>John@gmail.com</td>
                            <td>
                            <a href="" class="btn btn-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                    </svg> Modify
                                </a> 
                                <a href="" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg> Delete
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>