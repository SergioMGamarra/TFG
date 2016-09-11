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

    if ($_GET) {
        if ($_GET['tag']) {
            $result = getArticlesByTag($connection, $_GET['tag']);
        }
    } else {
        echo "
        <script type='text/javascript'>
            window.location = 'main.php'
        </script>
        
        ";
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
            <div class="nombre-etiqueta-container">
                <h1 class="nombre-etiqueta">Artículos relaciones con <?php echo getNombreTagById($connection, $_GET['tag'])['nombre']?> <span class='glyphicon glyphicon-tag'></span></h1>
            </div>
            <div class="full-width resultados">

                <?php
                $i = 0;
                foreach ($result as $art) {
                    $vot = getValorationsById($connection, $art['id']);
                    $tu_vot = getValorationByIdYUser($connection, $art['id'], $_SESSION['id']);
                    $aut_get = str_replace (' ', '_' , $art['autor'] );
                    if ($i == 10) {
                        break;
                    }
                    $i++;
                    echo "
                <div class='result-container'>
                    <div class='search-titulo'>
                        <a href='art.php?ref=".$art['id']."'> ".$art['titulo']."</a>
                    </div>
                    <div class='row'>
                        <div class='col-lg-6'>
                            ";
                    if ($vot['total'] != 0) {
                        for ($i = 1; $i <= intval($vot['media']); ++$i) {
                            echo "<span class='glyphicon glyphicon-star' style='color:#ffe505'></span>";
                        }

                        for (; $i <= 5; ++$i) {
                            echo "<span class='glyphicon glyphicon-star' style='color:gray'></span>";
                        }
                    } else {
                        for ($i = 1; $i <= 5; ++$i) {
                            echo "<span class='glyphicon glyphicon-star-empty'></span>";
                        }
                    }


                    echo "<span  style='color:gray'>( ".$vot['total']." <span class='glyphicon glyphicon-envelope'></span> )</span>";
                    echo "
                        </div>
                        <div class='col-lg-6'>
                        ";

                    if ($tu_vot['total'] != 0) {
                        echo "<span>Tu puntuación: </span>";
                        for ($i = 1; $i <= $tu_vot['puntuacion']; ++$i) {
                            echo "<span class='glyphicon glyphicon-star' style='color:#ffe505'></span>";
                        }

                        for (; $i <= 5; ++$i) {
                            echo "<span class='glyphicon glyphicon-star' style='color:gray'></span>";
                        }
                    } else {
                        echo "<span>Puntúalo: </span>
                            ";
                        for ($i = 1; $i <= 5; ++$i) {
                            echo "<span class='glyphicon glyphicon-star-empty'></span>";
                        }
                    }

                    echo "
                        </div>
                    </div>
                    <div class='search-autor'>
                        <a href='main.php?autor=".$aut_get."'>".$art['autor']."</a>
                    </div>
                    <div class='search-abstract'>
                        ".getNWordsFromString($art['abstract'])."
                    </div>
                    <div class='search-fecha'>
                        ".$art['fecha']."
                    </div>
                </div>
                        ";
                }
                $pages = intval(mysqli_num_rows($result)/10);


                if ($pages != 0) {
                    echo "Resultados: " . intval(mysqli_num_rows($result) / 10);
                    for ($i = 0; $i <= $pages; ++$i) {
                        $page = $i+1;
                        echo "<a href='main.php?'>".$page++."</a>";
                    }
                }
                ?>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="">
                <h4>Artículos</h4>
                <ul>
                    <li>Populares</li>
                    <li>Mejor valorados</li>
                    <li>Usuarios más activos</li>
                    <li>Usuarios mejor valorados</li>
                </ul>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
    </div>
</div>
<script src="../assets/js/jquery-2.1.4.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script>
    $(function () {

        $('form').on('submit', function (e) {

            e.preventDefault();

            $.ajax({
                type: 'post',
                url: 'insert_punt.php',
                data: $('form').serialize(),
                success: function () {
                    alert('form was submitted');
                }
            });

        });

    });
</script>
</body>
</html>