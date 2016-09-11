<?php
/**
 * Created by PhpStorm.
 * User: Sergio Muñoz Gamarra
 * Date: 27/8/16
 * Time: 13:36
 */

?>
<head>
    <meta charset="UTF-8">
    <?php
    session_start();
    include('../include/css_assets.php');
    include ('../include/config.php');
    include ('../include/functions.php');

    if (isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['sess_ID'])) {
        //Header('Location: main.php');
        header('Location: main.php');
    }

    if ($_GET) {
        $id_art = $_GET['ref'];
        $art = getArticuloById($connection, $id_art);
        $etiquetas = getEtiquetasByIdentArt($connection, $id_art);
        //print_r($art);
        if ($_POST) {
            InsertValoration($connection, $id_art, $_SESSION['id'], $_POST['puntuacion']);
        }
        $vot = getValorationsById($connection, $id_art);
        $tu_vot = getValorationByIdYUser($connection, $id_art, $_SESSION['id']);
        $aut_get = str_replace (' ', '_' , $art['autor'] );
    }

    ?>
    <style>
        .margin-top-large {
            margin-top: 0px;
        }
    </style>
    <title>Academy Recommend | <?php echo $art['titulo']?></title>

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
                <li><a style="color: white;" href="../navbar/">Default</a></li>
                <li class="active"><a style="color: white;" href="./">Static top <span class="sr-only">(current)</span></a></li>

                <?php if(isset($_SESSION['id'])) { echo '
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Premium Bootstrap Themes &amp; Templates" aria-expanded="false" style="color: white;"><i class="icon-star"></i> '.getNombreById($connection, $_SESSION['id'])['nombre'].'</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-toggle" href="/bootstrap-design-services"><i class="icon-pencil fa-fw"></i>Mis artículos</a>
                        </li>
                        <li>
                            <a class="dropdown-toggle" href="https://wrapbootstrap.com/?ref=StartBootstrap"><i class="icon-handbag fa-fw"></i>Mis votaciones</a>
                        </li>
                        <li>
                            <a class="dropdown-toggle" href="https://wrapbootstrap.com/?ref=StartBootstrap"><i class="icon-handbag fa-fw"></i>Mi perfil</a>
                        </li>
                        <li>
                            <a class="dropdown-toggle" href="https://wrapbootstrap.com/?ref=StartBootstrap"><i class="icon-handbag fa-fw"></i>Cerrar sesión</a>
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
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <h1 class="art-title"><?php echo $art['titulo']?></h1>
            <p class="art-autor">
                <?php echo "<a href='main.php?autor=".$aut_get."'>".$art['autor']."</a> ";?>
                <span class="fecha-art"> <?php echo $art['fecha'] ?></span></p>
            <div class="row"> <?php
                foreach ($etiquetas as $et) {
                    echo "<a href='tag.php?tag=".$et['id']."'><span class='etiquetas-art'>".$et['nombre']."  <span class='glyphicon glyphicon-tag'></span> </span></a>";
                }
                ?>
            </div>
            <p class="alert-danger article-abstract-title"><span class="article-abstract-title-text">Abstract</span></p>
            <p>
                <?php echo $art['abstract']?>
            </p>
            <p class="alert-danger article-abstract-title"><span class="article-abstract-title-text">Votaciones</span></p>
            <p>
                <div class="col-lg-6 text-center">
                    <?php
                    echo "<span>Puntuación: </span><br>";

                    if ($vot['total'] != 0) {
                        for ($i = 1; $i <= intval($vot['media']); ++$i) {
                            echo "<span class='glyphicon glyphicon-star' style='color:#ffe505;font-size: 25px'></span>";
                        }

                        for (; $i <= 5; ++$i) {
                            echo "<span class='glyphicon glyphicon-star' style='color:gray; font-size: 25px'></span>";
                        }
                        echo "<br><span style='font-size: 15px; padding-top: -15px;'> (".number_format($vot['media'], 2, '.', '').")</span>";

                    } else {
                        for ($i = 1; $i <= 5; ++$i) {
                            echo "<span class='glyphicon glyphicon-star-empty' style='font-size: 25px'></span>";
                        }
                    }


                    ?>
                </div>
                <div class="col-lg-6 text-center">
                <?php

                if ($tu_vot['total'] != 0) {
                    echo "<span>Tu puntuación: </span><br>";
                    for ($i = 1; $i <= $tu_vot['puntuacion']; ++$i) {
                        echo "<span class='glyphicon glyphicon-star' style='color:#ffe505; font-size: 25px'></span>";
                    }

                    for (; $i <= 5; ++$i) {
                        echo "<span class='glyphicon glyphicon-star' style='color:gray; font-size: 25px'></span>";
                    }
                } else {
                    echo "<span>Puntúalo: </span>
                    ";
                }?>
                    <form method='post' action='art.php?ref=<?php echo $id_art ?>'>
                        <select name='puntuacion' onchange="this.form.submit()">
                            <option value='1' <?php if ($tu_vot['puntuacion'] == '1') echo "selected"?>>1 - Aburrido</option>
                            <option value='2' <?php if ($tu_vot['puntuacion'] == '2') echo "selected"?>>2 - Insuficiente</option>
                            <option value='3' <?php if ($tu_vot['puntuacion'] == '3') echo "selected"?>>3 - Útil</option>
                            <option value='4' <?php if ($tu_vot['puntuacion'] == '4') echo "selected"?>>4 - Excelente</option>
                            <option value='5' <?php if ($tu_vot['puntuacion'] == '5') echo "selected"?>>5 - Perfecto</option>
                        </select>
                    </form>
                </div>
            </p>
            <p class="alert-danger article-abstract-title" style="margin-top: 110px"><span class="article-abstract-title-text">Artículo</span></p>
            <a target="_blank" href="<?php echo $art['enlace']?>"><button class="btn btn-art full-width tam-input-big-art">Leer el artículo completo <span class="glyphicon glyphicon-arrow-right"></span></button> </a>
            <div class="margin-bottom-medium"></div>
        </div>


        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <!--div class="">
                <h4>Artículos</h4>
                <ul>
                    <li>Populares</li>
                    <li>Mejor valorados</li>
                    <li>Usuarios más activos</li>
                    <li>Usuarios mejor valorados</li>
                </ul>
            </div-->
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
    </div>
</div>
<script src="../assets/js/jquery-2.1.4.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>