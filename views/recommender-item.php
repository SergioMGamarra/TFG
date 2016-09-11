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

    if(!isset($_SESSION['id'])) {
        echo '
            <script type="text/javascript">
                window.location.href = "login.php"
            </script>';
    }

    $tags = getTagsByUserId($connection, $_SESSION['id']);
    if ($tags != 0) {
        $query = "";
        $i = 0;

        foreach ($tags as $tag) {
            if ($i != 0) {
                $query .= "%20OR%20";
            }
            $i++;
            $query .= $tag['nombre'];
        }

        $request = "http://192.168.1.102:8983/solr/Recommender/select?indent=on&q=" . $query . "&wt=json";
        $request = str_replace(' ',"%20",$request);
        //echo $request;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $request);
        $result_item = curl_exec($ch);
        curl_close($ch);

        $obj = json_decode($result_item, true);
        //echo "<pre>";
        //print_r($obj);
        //echo "</pre>";
        $result_item = array();
        for ($i = 0; $i < $obj['response']['numFound']; ++$i) {
            //echo "Fichero: ".$i." -> Ruta fichero: ".$obj['response']['docs'][$i]['id'];
            //echo "Extract: ".substr($obj['response']['docs'][$i]['id'],48)."<br>";
            $search = $obj['response']['docs'][$i]['id'];
            if (strpos($search, '/../solr/') !== false) {
                $search = str_replace('/../solr/', '', $search);
            }
            $art = getArticleByPath($connection, substr($search, 39));
            //print_r($art);
            if ($art != 0)
                array_push($result_item, $art);
        }
    } else {
        $alerta = "NO TIENES ETIQUETAS ASIGNADAS";
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
        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">

        </div>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <div class="full-width resultados">

            <div class="full-width resultados">
                <h2 style="border-bottom: 1px solid black">Recomendaciones basadas en tus intereses</h2>
                <p style="color: grey">* Estas recomendaciones se basan en las interes que nos dijiste cuando te diste de alta. Si crees que se aproxima poco a tus interes siempre puedes ir a tu perfil y cambiarlos!.</p>
                <?php
                $i = 0;
                foreach ($result_item as $art) {
                    if (!articleVoted($connection, $_SESSION['id'], $art['id'])) {
                        $vot = getValorationsById($connection, $art['id']);
                        $tu_vot = getValorationByIdYUser($connection, $art['id'], $_SESSION['id']);
                        $aut_get = str_replace(' ', '_', $art['autor']);
                        if ($i == 20) {
                            break;
                        }
                        $i++;
                        echo "
                <div class='result-container'>
                    <div class='search-titulo'>
                        <a href='art.php?ref=" . $art['id'] . "'> " . $art['titulo'] . "</a>
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


                        echo "<span  style='color:gray'>( " . $vot['total'] . " <span class='glyphicon glyphicon-envelope'></span> )</span>";
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
                        <a href='main.php?autor=" . $aut_get . "'>" . $art['autor'] . "</a>
                    </div>
                    <div class='search-abstract'>
                        " . getNWordsFromString($art['abstract']) . "
                    </div>
                    <div class='search-fecha'>
                        " . $art['fecha'] . "
                    </div>
                </div>
                        ";
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