<?php
/**
 * Created by PhpStorm.
 * User: sergiomunozgamarra
 * Date: 21/6/16
 * Time: 21:01
 */

require_once ('../include/config.php');

function check_user($connection, $post) {
    $password = sha1($post['password']);
    $sql = "SELECT * FROM Usuario WHERE email='".$post['email']."' AND password = '".$password."'";
    //echo $sql;
    $result = mysqli_query($connection, $sql);
    if  ( mysqli_num_rows( $result ) != 0 )
    {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    else {
        return 0;
    }
}

function login($connection,$post) {
    // Comprobamos que las credenciales de acceso son correctas...
    echo "He entrado al login";
    $result = check_user($connection, $post);
    echo "He iniciado sesión";

    if($result!=0) {
        // Iniciamos sesión
        $_SESSION['id'] = $result['id'];
        $_SESSION['email'] = $post['email'];
        $_SESSION['sess_ID'] = sha1($post['password']);
        header('Location: main.php');
    } else {
        // Si no son correctas devolvemos false
        header('Location: main.php');
        return false;
    }
}

function getNombreById($connection, $ident) {
    $sql = "SELECT nombre FROM Usuario WHERE id='".$ident."'";
    //echo $sql;
    $result = mysqli_query($connection, $sql);
    if  ( mysqli_num_rows( $result ) != 0 )
    {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    else {
        return 0;
    }
}

function getNombreCompletoById($connection, $ident) {
    $sql = "SELECT nombre,apellidos FROM Usuario WHERE id='".$ident."'";
    //echo $sql;
    $result = mysqli_query($connection, $sql);
    if  ( mysqli_num_rows( $result ) != 0 )
    {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    else {
        return 0;
    }
}

function buscador ($connection, $content) {
    $sql = "SELECT * FROM Articulo WHERE usuario LIKE '%".$content."%' OR titulo LIKE '%".$content."%' OR abstract LIKE '%".$content."%' OR autor LIKE '%".$content."%'";
    $result = mysqli_query($connection, $sql);

    if  ( mysqli_num_rows( $result ) != 0 )
        return $result;

    else
        return 0;
}

function insertArt($connection, $titulo, $autor, $abstract, $contenido, $fecha, $enlace){
    $sql = "INSERT INTO Articulo VALUES ('', '0','".$titulo."','".$abstract."','".$contenido."','".$fecha."','".$autor."','".$enlace."')";
    $query = mysqli_query( $connection, $sql );

    if(!$query)
    {
        echo(mysqli_error($connection));

        return false;
    }
    return true;
}

function insertEtiqueta($connection, $nombre){
    $sql = "INSERT INTO Etiqueta VALUES ('', upper('".$nombre."'))";
    echo "Insert Etiqueta: ".$sql;
    $query = mysqli_query( $connection, $sql );
    if(!$query)
    {
        echo(mysqli_error($connection));

        return false;
    }
    return true;
}

function getNombreTagById($connection, $id) {
    $sql = "SELECT nombre from Etiqueta WHERE id =".$id;
    $result = mysqli_query($connection, $sql);
    if  ( mysqli_num_rows( $result ) != 0 )
    {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    else {
        return 0;
    }
}

function getArticlesByAutor($connection, $autor) {
    $sql = "SELECT * FROM Articulo WHERE autor LIKE '%".$autor."%'";
    $result = mysqli_query($connection, $sql);

    if  ( mysqli_num_rows( $result ) != 0 )
        return $result;

    else
        return 0;
}

function insertArt_complete($connection, $titulo, $autor, $abstract, $contenido, $fecha, $enlace, $fecha_insert, $rev_public){
    echo "<br><strong>ENLACE</strong>: ".$enlace."<br>";
    $sql = "INSERT INTO Articulo VALUES ('', '0','".$titulo."','".$abstract."','".$contenido."','".$fecha."','".$rev_public."','".$fecha_insert."','".$autor."','".$enlace."')";
    echo "Consulta: ".$sql;
    $query = mysqli_query( $connection, $sql );

    if(!$query)
    {
        echo(mysqli_error($connection));

        return false;
    }

    return true;
}

function getValorationsById($connection, $ident) {
    $sql = "SELECT Avg(puntuacion) as media,count(*) as total FROM Votacion where id_articulo = '".$ident."'";
    $result = mysqli_query($connection, $sql);

    if  ( mysqli_num_rows( $result ) != 0 )
        return mysqli_fetch_assoc($result);

    else
        return 0;
}

function getValorationByIdYUser($connection, $art, $usuario) {
    $sql = "SELECT puntuacion,count(*) as total FROM Votacion where id_articulo = '".$art."' AND id_usuario = '".$usuario."'";
    $result = mysqli_query($connection, $sql);

    if  ( mysqli_num_rows( $result ) != 0 )
        return mysqli_fetch_assoc($result);

    else
        return 0;
}


function getArticuloById($connection, $ident) {
    $sql = "SELECT * FROM Articulo where id = '".$ident."'";
    $result = mysqli_query($connection, $sql);

    if  ( mysqli_num_rows( $result ) != 0 )
        return mysqli_fetch_assoc($result);

    else
        return 0;
}

function getEtiquetasByIdentArt ($connection, $id) {
    $sql = "select Etiqueta.* from Etiqueta where Etiqueta.id in ( select Art_etiq.id_etiq from Art_etiq where Art_etiq.id_art = '".$id."')";
    $result = mysqli_query($connection, $sql);

    if  ( mysqli_num_rows( $result ) != 0 )
        return $result;

    else
        return 0;
}


function InsertValoration($connection, $id_art, $id_usuario, $puntuacion) {
    $sql = "SELECT * FROM Votacion where id_usuario = ".$id_usuario." AND id_articulo = ".$id_art;
    $exist = mysqli_query($connection, $sql);

    if  ( mysqli_num_rows( $exist ) != 0 ) {
        // Si exista ya una votación...UPDATE
        $sql = "UPDATE Votacion SET puntuacion = ".$puntuacion." WHERE id_usuario = ".$id_usuario." AND  id_articulo = ".$id_art;
        //echo $sql;
        $query = mysqli_query( $connection, $sql );

        if(!$query)
        {
            echo(mysqli_error($connection));
            return false;
        }
    }
    else {
        // Si no existe una votación...INSERT
        $sql = "INSERT INTO Votacion VALUES (".$id_usuario.",".$id_art.", '',  ".$puntuacion.")";
        //echo $sql;
        $query = mysqli_query( $connection, $sql );

        if(!$query) {
            echo(mysqli_error($connection));
            return false;
        }
    }
    return true;

}

function LinkEtiquetArt ($connection, $id_etiq, $id_art) {
    $sql = "INSERT INTO Art_etiq VALUES ('".$id_art."', '".$id_etiq."')";
    echo "Link: ".$sql;
    $query = mysqli_query( $connection, $sql );
    if(!$query)
    {
        echo(mysqli_error($connection));

        return false;
    }
    return true;
}

function InsertNewArticle($connection, $post, $usuario, $files) {
    $dir_subida = '/Applications/MAMP/htdocs/science/solr/files/'.$usuario.'/';
    
    if (folder_exist($dir_subida) == false) {
        mkdir($dir_subida, 0700);
    }
    $dir_subida = $dir_subida.date("Y").'/';
    if (folder_exist($dir_subida) == false) {
        mkdir($dir_subida, 0700);
    }
    $dir_subida = $dir_subida.date("m").'/';
    if (folder_exist($dir_subida) == false) {
        mkdir($dir_subida, 0700);
    }
    $dir_subida = $dir_subida.date("d").'/';
    if (folder_exist($dir_subida) == false) {
        mkdir($dir_subida, 0700);
    }

    $fichero_subido = $dir_subida . basename($files['fichero']['name']);

    echo '<pre>';
    if (move_uploaded_file($files['fichero_usuario']['tmp_name'], $fichero_subido)) {
        echo "El fichero es válido y se subió con éxito.\n";
    } else {
        echo "¡Posible ataque de subida de ficheros!\n";
    }

    //PREPARAMOS EL DIRECTORIO EN EL QUE HIRÁ EL FICHERO...FILES/ID_USUARIO/AÑO/MES/DIA
    /*
    $dir_subida = 'files/'.$usuario.'/';
    if (folder_exist($dir_subida) == false) {
        mkdir($dir_subida, 0700);
    }
    $dir_subida = $dir_subida.date("Y").'/';
    if (folder_exist($dir_subida) == false) {
        mkdir($dir_subida, 0700);
    }
    $dir_subida = $dir_subida.date("m").'/';
    if (folder_exist($dir_subida) == false) {
        mkdir($dir_subida, 0700);
    }
    $dir_subida = $dir_subida.date("d").'/';
    if (folder_exist($dir_subida) == false) {
        mkdir($dir_subida, 0700);
    }
    $fichero_subido = $dir_subida . basename($_FILES['fichero']['name']);

    '<pre>';
    if (move_uploaded_file($files['fichero']['tmp_name'], $fichero_subido)) {
        echo "El fichero es válido y se subió con éxito.\n";
    } else {
        echo "¡Posible ataque de subida de ficheros!\n";
    }

    echo 'Más información de depuración:';
    print_r($files);

    print "</pre>";

    $nombre_usuario = getNombreCompletoById($connection, $usuario);
    $sql = "INSERT INTO Articulo VALUES ('', '".$usuario."', '".$post['titulo']."', '".$post['abstract']."','', '".$post['fecha']."', '".$post['revista']."', '', '".$nombre_usuario['nombre']." ".$nombre_usuario['apellidos']."','".$fichero_subido."')";
    $query = mysqli_query( $connection, $sql );

    if(!$query)
    {
        echo(mysqli_error($connection));
        return false;
    }
    $id_art_new = $connection->insert_id;

    $tags = array();
    $sqlTag = array();
    $result_check = array();

    $tags[0] = $_POST['etiqueta1'];
    $tags[1] = $_POST['etiqueta2'];
    $tags[2] = $_POST['etiqueta3'];


    // Primero comprobamos si las etiquetas existe, y en caso de que no estén se añaden
    $sqlTag[0] = "SELECT id FROM Etiqueta where nombre = upper('".$_POST['etiqueta1']."')";
    $sqlTag[1] = "SELECT id FROM Etiqueta where nombre = upper('".$_POST['etiqueta2']."')";
    $sqlTag[2] = "SELECT id FROM Etiqueta where nombre = upper('".$_POST['etiqueta3']."')";

    for ($i = 0; $i <= 2; ++$i) {
        $result_check[$i] = mysqli_fetch_assoc(mysqli_query( $connection, $sqlTag[$i]));
        print_r($result_check[$i]);
        if (empty($result_check[$i]) || $result_check[$i] == null) {
            insertEtiqueta($connection, $tags[$i]);
            LinkEtiquetArt($connection, $connection->insert_id, $id_art_new);
        } else {
            LinkEtiquetArt($connection, $result_check[$i]['id'], $id_art_new);
        }
    }
*/}

function getArticlesByTag($connection, $id) {
    $sql = "select Articulo.* from Articulo where Articulo.id in ( select Art_etiq.id_art from Art_etiq where Art_etiq.id_etiq = '".$id."')";
    $result = mysqli_query($connection, $sql);

    if  ( mysqli_num_rows( $result ) != 0 ) {
        return $result;
    }

    return 0;
}

function getRecommendationsById($connection, $usuario) {
    $sql = "select Articulo.* from Articulo where Articulo.id in ( select Recomendacion.idArticulo from Recomendacion where Recomendacion.idUsuario = '".$usuario."')";
    $result = mysqli_query($connection, $sql);

    if  ( mysqli_num_rows( $result ) != 0 ) {
        return $result;
    }

    return 0;
}

function getBestArticles($connection) {
    $sql = "SELECT Articulo.*, AVG(Votacion.puntuacion) as votacion_media, COUNT(Votacion.id_usuario) as votacion_total FROM Articulo INNER JOIN Votacion ON Votacion.id_articulo = Articulo.id GROUP BY id_articulo ORDER BY AVG(Votacion.puntuacion) DESC, COUNT(Votacion.id_usuario) DESC LIMIT 20";
    $result = mysqli_query($connection, $sql);

    if  ( mysqli_num_rows( $result ) != 0 ) {
        return $result;
    }

    return 0;
}

/**
 *
 * FUNCIONES AUXILIARES
 *
 */

function getNWordsFromString($text,$numberOfWords = 40) {
    if($text != null) {
        $textArray = explode(" ", $text);
        if(count($textArray) > $numberOfWords) {
            return implode(" ",array_slice($textArray, 0, $numberOfWords))."...";
        }
        return $text;
    }
    return "";
}

function folder_exist($folder)
{
    // Get canonicalized absolute pathname
    $path = realpath($folder);

    // If it exist, check if it's a directory
    return ($path !== false AND is_dir($path)) ? $path : false;
}