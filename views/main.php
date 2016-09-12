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
        if ($_POST['busca']) {
            // Tratamos la información para que tenga el formato adecuado...
            $data = str_replace(' ',"%20",$_POST['busca']);

            // Preparamos la consulta...
            $request = "http://192.168.1.102:8983/solr/Recommender/select?indent=on&q=".$data."&wt=json";

            // Configuramos los parametros de curl correctamente para la consulta...
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $request);
            $result = curl_exec($ch);
            curl_close($ch);
            // Decodificamos el JSON de respuesta...
            $obj = json_decode($result, true);
            $result = array();
            // Obtenemos todos los resultados y los almacenamos en un array para imprimirlos en la sección
            // en la que deben de ir los resultados...
            for ($i = 0; $i < $obj['response']['numFound']; ++$i) {
                $search = $obj['response']['docs'][$i]['id'];
                if (strpos($obj['response']['docs'][$i]['id'], '/../solr/') !== false) {
                    $search = str_replace('/../solr/', '', $search);
                }

                $search = substr($search,39);

                $art = getArticleByPath($connection, $search);
                if ($art != 0)
                array_push($result, $art);
            }
        }
    }

    
    if ($_GET) {
        $autor = str_replace ('_', ' ' , $_GET['autor']);
        $result = getArticlesByAutor ($connection, $autor);
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
                <?php if($_SESSION['id'] == 12) {
                    echo '<li class="dropdown">
                    <a href="#" class="dropdown-toggle " data-toggle="dropdown" title="Recomendaciones" aria-expanded="false" style="color: white;"><i class="icon-star"></i> Gestión</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-toggle" href="manage_user.php"><i class="icon-pencil fa-fw"></i>Gestión de usuarios</a>
                        </li>
                        <li>
                            <a class="dropdown-toggle" href="manage_art.php"><i class="icon-handbag fa-fw"></i> Gestión de artículos</a>
                        </li>
                    </ul>
                </li>';
                }
                ?>

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
            <div class="search-site">
            <form id="form-buscador" action="main.php" method="post">
            <input name="busca" placeholder="¿Sobre que estás investigando?" value="<?php if($_POST) echo $_POST['busca']; else if ($_GET) echo $autor; ?>" class="main-buscador text-center"><div onclick = "document.getElementById('form-buscador').submit();" class="btn-buscador"><span class="search-icon glyphicon glyphicon-search"></span></div>
            </div>
            </form>
            <br>
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
                        <p><a href='art.php?ref=".$art['id']."'> ".$art['titulo']."</a></p>
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
