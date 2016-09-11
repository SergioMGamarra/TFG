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
    if ($_SESSION['id']!=12) {
        //Header('Location: main.php');
        echo "
        <script>
                window.location.href = \"main.php\";

</script>
        
        ";
    }

    if($_POST) {
        deleteUser($connection, $_POST['id']);
    }

    if($_POST['busca'] != '' AND $_POST['busca'] != NULL) {
        $arts = buscaArticulos ($connection, $_POST['busca']);
    } else {
        if($_POST) {
            deleteArt($connection, $_POST['id']);
        }
        $arts = getAllArticles($connection);
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

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-large margin-top-large">
                <form id="form-buscador" action="manage_art.php" method="post">
                    <input name="busca" placeholder="Introduce el dato del artículo al que estés buscando" value="<?php if($_POST['busca'] != '' AND $_POST['busca'] != NULL) echo $_POST['busca']?>" class="main-buscador text-center"><div onclick = "document.getElementById('form-buscador').submit();" class="btn-buscador"><span class="search-icon glyphicon glyphicon-search"></span></div>
                </form>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Fecha publicación</th>
                    <th>Revista</th>
                    <th>Autor</th>
                    <th>PDF</th>
                    <th>Gestión</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                <?php

                foreach ($arts as $art) {
                    echo "
                    <tr>

                        <td>".$art['id']."</td>
                        <td>".$art['titulo']."</td>
                        <td>".$art['fecha']."</td>
                        <td>".$art['rev_publicado']."</td>
                        <td>".$art['autor']."</td>
                        <td><a href='".$art['enlace']."'>PDF</a></td>
                        <td>
                            <form onsubmit=\"return confirm('¿Seguro que quieres borrar este artículo?')\" action=\"manage_art.php\" method=\"post\">
                              <input type=\"hidden\" name=\"id\" value='" . $art['id'] . "' />
                              <input type=\"submit\" value=\"X\" class='btn btn-danger'/>
                            </form>
                        </td>
                                            </tr>

                        
                        ";
                }



                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="../assets/js/jquery-2.1.4.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>