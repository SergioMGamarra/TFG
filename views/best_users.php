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

    $result = getBestUsers($connection);


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
        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">

        </div>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <div class="nombre-etiqueta-container">
                <h1 class="nombre-etiqueta">Top 20 mejores valorados</h1>
            </div>
            <div class="full-width resultados">

                <?php
                $i = 1;
                foreach ($result as $user) {
                    if($user['usuario'] != 0) {
                        $usuario = getUserInfo($connection, $user['usuario']);
                        echo "
                    <div class='col-lg-12 margin-top-large' style='border-bottom: 1px solid black'>
                        <div class='col-lg-3'>
                            <h1>" . $i . "</h1>
</div>
                        <div class='col-lg-6'>
                            <p  style='margin-top: 20px'>" . $usuario['nombre'] . " ".$usuario['apellidos']."</p>
                            <p  style='margin-top: 20px'>" . $usuario['organizacion']."</p>
                        </div>
                        <div class='col-lg-3'>
                            <p  style='margin-top: 20px'>Media: " .number_format($user['media'], 2, '.', '')."</p>
                            <p  style='margin-top: 20px'>En " . $user['TOTAL']." artículos</p>
                        </div>



                    </div>";
                        $i++;
                    }
                }
                ?>
            </div>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">

        </div>
    </div>
</div>
<script src="../assets/js/jquery-2.1.4.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>