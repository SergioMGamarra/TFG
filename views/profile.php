<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Academy Recommend | Log in</title>
    <?php
    session_start();
    include('../include/css_assets.php');
    include ('../include/config.php');
    include ('../include/functions.php');

    if (!isset($_SESSION['id'])) {
        //Header('Location: main.php');
        header('Location: main.php');
    } else {
        if($_POST) {
            if(isset($_POST['change_pass'])) {
                change_pass($connection, $_POST['new_pass'], $_SESSION['id']);
            } else if(isset($_POST['change_interes'])) {
                updateEtiquetas($connection, $_POST, $_SESSION['id']);
            }
        }


        $datos = getUserInfoComplete($connection, $_SESSION['id']);
        $eti = array();
        foreach ($datos['tags'] as $tag) {
            array_push($eti, $tag['nombre']);
        }
    }

    ?>
</head>
<body>
<nav class="navbar navbar-static-top"  style="background-color: black">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="../assets/img/scienceAffinity-logo.png" style="height: 100%;"/> </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            </ul>

            <ul class="nav navbar-nav navbar-right" style="color: white!important;">
                <li><a style="color: white;" href="main.php">Buscador</a></li>
                <li><a style="color: white;" href="best_valorations.php">Mejores artículos</a></li>
                <li><a style="color: white;" href="best_users.php">Usuarios populares</a></li>
                <!--li class="active"><a style="color: white;" href="recommender.php">Recomendaciones<span class="sr-only">(current)</span></a></li-->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle " data-toggle="dropdown" title="Recomendaciones" aria-expanded="false" style="color: white;"><i class="icon-star"></i> Recomendaciones</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-toggle" href="recommender.php"><i class="icon-pencil fa-fw"></i>Según tus votaciones</a>
                        </li>
                        <li>
                            <a class="dropdown-toggle" href="recommender-item.php"><i class="icon-handbag fa-fw"></i> Según tus intereses</a>
                        </li>
                    </ul>
                </li>
                <?php if(isset($_SESSION['id'])) { echo '
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle btn-danger" data-toggle="dropdown" title="" aria-expanded="false" style="color: white;"><i class="icon-star"></i> '.getNombreById($connection, $_SESSION['id'])['nombre'].'</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-toggle" href="mine.php"><i class="icon-pencil fa-fw"></i>Mis artículos</a>
                        </li>
                        <li>
                            <a class="dropdown-toggle" href="mine_vot.php"><i class="icon-handbag fa-fw"></i>Mis votaciones</a>
                        </li>
                        <li>
                            <a class="dropdown-toggle" href="profile.php"><i class="icon-handbag fa-fw"></i>Mi perfil</a>
                        </li>
                        <li>
                            <form id="form-logout" action="../aux/logout.php"><span style="color: black; padding-left: 20px" class="dropdown-toggle" onclick="document.getElementById(\'form-logout\').submit()"><i class="icon-handbag fa-fw"></i>Cerrar sesión</span></form>
                        </li>
                    </ul>
                </li>
                '; }?>

                <?php if(!isset($_SESSION['id'])) { echo '<li><a style="color: white;" href="">'.getNombreById($connection, $_SESSION['id'])['nombre'].'<span class="" ></a></li>
                    <li><a style="color: white;" href="login.php">Iniciar Sesión</a></li>
                '; }?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container margin-top-large">
    <form action="alta_user.php" method="post">
        <h2 class="text-center">Algunos datos personales</h2><br>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $datos['nombre']?>">
        </div>
        <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" value="<?php echo $datos['apellidos']?>">
        </div>
        <div class="form-group">
            <label for="puesto_trabajo">Puesto de trabajo</label>
            <input type="text" class="form-control" id="puesto_trabajo" name="puesto_trabajo" placeholder="Puesto de trabajo" value="<?php echo $datos['puesto_trabajo']?>">
        </div>
        <div class="form-group">
            <label for="organizacion">Organización o Empresa para la que trabaja</label>
            <input type="text" class="form-control" id="organizacion" name="organizacion" placeholder="Organización o Empresa" value="<?php echo $datos['organizacion']?>">
        </div>
        <div class="form-group">
            <label for="titulacion">Titulación</label>
            <input type="text" class="form-control" id="titulacion" name="titulacion" placeholder="Titulación" value="<?php echo $datos['titulo']?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $datos['email']?>">
        </div>
        <div class="form-group col-lg-3">
            <br>
            <button type="button" class="btn btn-warning full-width" data-toggle="modal" data-target="#myModal">
                Cambiar contraseña
            </button>
        </div>
        <div class="form-group col-lg-3">
            <br>
            <button type="button" class="btn btn-info full-width" data-toggle="modal" data-target="#myModalTnteres">
                Cambiar mis intereses
            </button>
        </div>
        <div class="form-group col-lg-6">
            <br>
            <input type="submit" class="form-control btn btn-success" id="dar_alta" name="Alta" value="Actualizar mis datos">
        </div>
        <br>
    </form>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="profile.php">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">¿Quieres cambiar tu contraseña?</h4>
                    </div>
                    <div class="modal-body">
                        <input type="password" class="full-width text-center" name = "new_pass" placeholder="Introduce contraseña nueva">
                        <input style="display: none" name="id_usuario" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-primary" name="change_pass" value="Guardar cambios"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModalTnteres" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="profile.php">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">¿Quieres cambiar tus intereses?</h4>
                        <br><h2 class="text-center">Tus intereses</h2><br>
                        <p class="text-center">En esta sección tan solo tienes que introducir palabras relacionadas al tema sobre el que trabajas y sobre lo que esperas encontrar información</p><br>
                        <div class="col-sm-4 space-bottom" style="border-top: 20px">
                            <input type="text" class="form-control input-add-art-little" id="etiqueta1" name="etiqueta1" placeholder="Etiqueta 1" value=<?php echo $eti[0]?>>
                        </div>
                        <div class="col-sm-4 space-bottom">
                            <input type="text" class="form-control input-add-art-little" id="etiqueta2" name="etiqueta2" placeholder="Etiqueta 2" value=<?php echo $eti[1]?>>
                        </div>
                        <div class="col-sm-4 space-bottom">
                            <input type="text" class="form-control input-add-art-little" id="etiqueta3" name="etiqueta3" placeholder="Etiqueta 3" value=<?php echo $eti[2]?>>
                        </div><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-primary" name="change_interes" value="Guardar cambios"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/jquery-2.1.4.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>