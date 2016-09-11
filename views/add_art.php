<?php
/**
 * Created by PhpStorm.
 * User: sergiomunozgamarra
 * Date: 12/7/16
 * Time: 20:39
 */



?>
<head>
    <meta charset="UTF-8">
    <title>Academy Recommend | Log in</title>
    <?php
    session_start();
    include('../include/css_assets.php');
    include ('../include/config.php');
    include ('../include/functions.php');

    if (isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['sess_ID'])) {
        //Header('Location: main.php');
        header('Location: main.php');
    }

    if ($_POST) {
        InsertNewArticle($connection, $_POST, $_SESSION['id'], $_FILES);
    }

    ?>
    <style>
        .margin-top-large {
            margin-top: 0px;
        }
    </style>
</head>
<body  style="">
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

<div class="container margin-top-large" style="background-color: white">
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form action="add_art.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-sm-12 space-bottom">
                        <input type="text" name ="titulo" class="form-control input-add-art" id="titulo" placeholder="Título">
                    </div>
                    <div class="col-sm-12 space-bottom">
                        <input type="text" name ="fecha" class="form-control input-add-art-little" id="fecha" placeholder="Fecha de publicación">
                    </div>
                    <div class="col-sm-4 space-bottom" style="border-top: 20px">
                        <input type="text" class="form-control input-add-art-little" id="etiqueta1" name="etiqueta1" placeholder="Etiqueta">
                    </div>
                    <div class="col-sm-4 space-bottom">
                        <input type="text" class="form-control input-add-art-little" id="etiqueta2" name="etiqueta2" placeholder="Etiqueta">
                    </div>
                    <div class="col-sm-4 space-bottom">
                        <input type="text" class="form-control input-add-art-little" id="etiqueta3" name="etiqueta3" placeholder="Etiqueta">
                    </div>
                    <div class="col-sm-12 space-bottom">
                        <input type="text" class="form-control input-add-art-little" id="revista" name="revista" placeholder="Revista dónde se publicó">
                    </div>
                    <div class="col-sm-12 space-bottom">
                        <textarea class="form-control input-add-art-little abstract-container" name = "abstract" id="abstract" placeholder="Abstract"></textarea>
                    </div>
                    <div class="input-group input-file space-bottom" style="padding-left: 15px;padding-right: 15px; margin: 0">
                        <input type="file" name="fichero" id="fileToUpload">
                        <!--div class="form-control">
                            <a href="" target="_blank"></a>
                        </div>
                        <span class="input-group-addon">
                            <a class='btn btn-primary' href='javascript:;'>
                                Insertar artículo
                                <input type="file" name="fichero_art" onchange="$(this).parent().parent().parent().find('.form-control').html($(this).val());">
                            </a>
                        </span-->
                    </div>
                    <div class="col-sm-12 space-bottom">
                        <input type="submit" class="btn btn-success full-width tam-input-big-art" value="Publicar artículo"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../assets/js/jquery-2.1.4.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>