<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Módulo Inventario - IS 2</title>
        <script src="../Bootstrap/js/jquery-2.1.4.js"></script>
        <script src="../Bootstrap/js/bootstrap.js"></script>
        <link href="../Bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link rel="../stylesheet" href="Bootstrap/css/bootstrap-theme.css">
        <style type="text/css">
            div{
                font-family: Calibri Light;
            }
        </style>    
    </head>
     <body background ="../View/Imagenes/azul.png" width="1800">
        <center>
            <div class="masthead"><img src="../View/Imagenes/banner-inventario.jpg" height="200" width="1340">
            </div>
           <div class="row text-center">
                    <h3>SISTEMA DE MÓDULO DE INVENTARIO</h3>
                </div>
        </center>
     
        <div class="container" style="margin-top:150px;">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h4 style="border-bottom: 1px solid #c5c5c5;">
                        <span class="glyphicon glyphicon-user">
                        </span>
                        <span>Acceso a la cuenta</span>
                    </h4>
                    <div style="padding: 20px;">
                        <form action="../Controller/controller.php">
                            <input type="hidden" name="opcion1" value="iniciar_sesion">
                            <input type="hidden" name="opcion2" value="iniciar_sesion">
                            <div class="form-group input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-envelope"></i>
                                </span>
                                <input type="email" class="form-control" placeholder="E-mail" name="email" required="true"
                                value="<?php
                                if (isset($_SESSION['E_MAIL_USU'])) {
                                    echo $_SESSION['E_MAIL_USU'];
                                }
                                ?>" autofocus>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-lock"></i>
                                </span>
                                <input class="form-control" placeholder="Contraseña" name="password" type="password" required="true" maxlength=25>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-log-in"></i> Iniciar Sesión</button>
                            </div>
                        </form>
                        <?php
                        if (isset($_SESSION['ErrorInicioSesion'])) {
                            echo "<div class = 'alert alert-danger'>" . $_SESSION['ErrorInicioSesion'] . "</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
