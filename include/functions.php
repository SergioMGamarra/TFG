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
    $result = check_user($connection, $post);

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
    //echo "Insert Etiqueta: ".$sql;
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

function getArticlesByAutorID($connection, $autor) {
    $sql = "SELECT * FROM Articulo WHERE usuario = '".$autor."'";
    $result = mysqli_query($connection, $sql);

    if  ( mysqli_num_rows( $result ) != 0 )
        return $result;

    else
        return 0;
}

function getArticlesVotedByAuthor($connection, $autor) {
    $sql = "SELECT Articulo.* FROM Articulo inner join Votacion ON Votacion.id_articulo = Articulo.id WHERE Votacion.id_usuario = '".$autor."'";
    $result = mysqli_query($connection, $sql);

    if  ( mysqli_num_rows( $result ) != 0 )
        return $result;

    else
        return 0;
}

function getArticlesVotedByAuthorPuntacion($connection, $autor, $puntuacion) {
    $sql = "SELECT Articulo.* FROM Articulo inner join Votacion ON Votacion.id_articulo = Articulo.id WHERE Votacion.id_usuario = '".$autor."' AND Votacion.puntuacion = '".$puntuacion."'";
    $result = mysqli_query($connection, $sql);

    if  ( mysqli_num_rows( $result ) != 0 )
        return $result;

    else
        return 0;
}


function getUserInfo ($connection, $id) {
    $sql = "SELECT * FROM Usuario WHERE id='".$id."'";
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

function getUserInfoComplete($connection, $id) {
    $sql = "SELECT * FROM Usuario WHERE id='".$id."'";
    $result = mysqli_query($connection, $sql);
    if  ( mysqli_num_rows( $result ) != 0 )
    {
        $result = mysqli_fetch_assoc($result);
        $sql = "SELECT Etiqueta.* from Etiqueta INNER JOIN User_etiq on Etiqueta.id = User_etiq.id_etiq AND User_etiq.id_user = '".$result['id']."' ";
        $tags = mysqli_query($connection, $sql);
        $result['tags'] = $tags;
        return $result;
    }
    else {
        return 0;
    }
}

function getTagsByUserId($connection, $ident) {
    $sql = "SELECT Etiqueta.nombre FROM Etiqueta INNER JOIN User_etiq ON User_etiq.id_etiq = Etiqueta.id WHERE User_etiq.id_user = '".$ident."'";
    $result = mysqli_query($connection, $sql);

    if  ( mysqli_num_rows( $result ) != 0 )
        return $result;

    else
        return 0;
}


function insertArt_complete($connection, $titulo, $autor, $abstract, $contenido, $fecha, $enlace, $fecha_insert, $rev_public){
    //echo "<br><strong>ENLACE</strong>: ".$enlace."<br>";
    $sql = "INSERT INTO Articulo VALUES ('', '0','".$titulo."','".$abstract."','".$contenido."','".$fecha."','".$rev_public."','".$fecha_insert."','".$autor."','".$enlace."')";
    //echo "Consulta: ".$sql;
    $query = mysqli_query( $connection, $sql );

    if(!$query)
    {
        echo(mysqli_error($connection));

        return false;
    }

    return true;
}

function change_pass($connection, $new_pass,$id) {
    $sql = "UPDATE Usuario SET password = '".sha1($new_pass)."' WHERE id='".$id."'";
    //echo $sql;
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
    //echo "Link: ".$sql;
    $query = mysqli_query( $connection, $sql );
    if(!$query)
    {
        echo(mysqli_error($connection));

        return false;
    }
    return true;
}

function LinkEtiquetUser ($connection, $id_etiq, $id_user) {
    $sql = "INSERT INTO User_etiq VALUES ('".$id_user."', '".$id_etiq."')";
    //echo "Link: ".$sql;
    $query = mysqli_query( $connection, $sql );
    if(!$query)
    {
        echo(mysqli_error($connection));

        return false;
    }
    return true;
}


function InsertNewUser($connection, $post) {
    $password = sha1($post['contrasenia']);
    $sql = "INSERT INTO Usuario VALUES('', '".$post['nombre']."','".$post['apellidos']."','".$post['email']."','".$password."','".$post['puesto_trabajo']."','".$post['organizacion']."','".$post['titulacion']."')";
    $query = mysqli_query( $connection, $sql );

    if(!$query) {
        echo(mysqli_error($connection));
        return false;
    }

    $id_new_user = $connection->insert_id;


    $tags = array();

    for($i = 1; $i<=3;$i++) {
        if($post['etiqueta'.$i] != "") {
            array_push($tags, $post['etiqueta'.$i]);
        }
    }

    foreach ($tags as $tag) {
        $sql = "SELECT id FROM Etiqueta where nombre = upper('".$tag."')";
        //echo $sql;
        $res = mysqli_fetch_assoc(mysqli_query( $connection, $sql));
        if (empty($res) || $res == null) {
            insertEtiqueta($connection, $tag);
            LinkEtiquetUser($connection, $connection->insert_id, $res);
        } else {
            LinkEtiquetUser($connection, $res['id'], $id_new_user);
        }

    }
    return true;
}

function updateEtiquetas ($connection, $post, $user) {
    $sql = "DELETE FROM User_etiq WHERE id_user = ".$user;
    $query = mysqli_query( $connection, $sql );

    $tags = array();

    for($i = 1; $i<=3;$i++) {
        if($post['etiqueta'.$i] != "") {
            array_push($tags, $post['etiqueta'.$i]);
        }
    }

    foreach ($tags as $tag) {
        $sql = "SELECT id FROM Etiqueta where nombre = upper('".$tag."')";
        //echo $sql;
        $res = mysqli_fetch_assoc(mysqli_query( $connection, $sql));
        if (empty($res) || $res == null) {
            insertEtiqueta($connection, $tag);
            LinkEtiquetUser($connection, $connection->insert_id, $res);
        } else {
            LinkEtiquetUser($connection, $res['id'], $user);
        }

    }
}


function articleVoted($connection, $usuario, $article) {
    $sql = "SELECT * FROM Votacion WHERE id_usuario =".$usuario." AND id_articulo = ".$article;
    $result = mysqli_query($connection, $sql);

    if  ( mysqli_num_rows( $result ) != 0 ) {
        return $result;
    }

    return 0;
}

function InsertNewArticle($connection, $post, $usuario, $files) {
    //PREPARAMOS EL DIRECTORIO EN EL QUE HIRÁ EL FICHERO...FILES/ID_USUARIO/AÑO/MES/DIA

    $dir_subida = '/Applications/MAMP/htdocs/science/solr/files/'.$usuario.'/';
    $directorio_rel = 'http://localhost:8888/science/solr/files/'.$usuario.'/'.date("Y").'/'.date("m").'/'.date("d").'/'.basename($files['fichero']['name']);
    $dir_insert = 'files/'.$usuario.'/'.date("Y").'/'.date("m").'/'.date("d").'/'.basename($files['fichero']['name']);
    $dir_solr = '../solr/files/'.$usuario.'/'.date("Y").'/'.date("m").'/'.date("d").'/';
    //$dir_subida = 'files/'.$usuario.'/';
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
    if (move_uploaded_file($files['fichero']['tmp_name'], $fichero_subido)) {
        //echo "El fichero es válido y se subió con éxito.\n";
    } else {
        //echo "¡Posible ataque de subida de ficheros!\n";
    }

    //echo 'Más información de depuración:';
    //print_r($_FILES);

    //print "</pre>";

    /*
    '<pre>';
    if (move_uploaded_file($files['fichero']['tmp_name'], $fichero_subido)) {
        echo "El fichero es válido y se subió con éxito.\n";
    } else {
        echo "¡Posible ataque de subida de ficheros!\n";
    }

    echo 'Más información de depuración:';
    print_r($files);

    print "</pre>";
*/
    $nombre_usuario = getNombreCompletoById($connection, $usuario);
    $sql = "INSERT INTO Articulo VALUES ('', '".$usuario."', '".$post['titulo']."', '".$post['abstract']."','', '".$post['fecha']."', '".$post['revista']."', '', '".$nombre_usuario['nombre']." ".$nombre_usuario['apellidos']."','".$dir_insert."')";
    echo $sql;
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

    $salida = shell_exec('../solr/bin/post -c Recommender '.$dir_solr);
    echo "<pre>$salida</pre>";
    Header('location: mine.php');

}


function InsertNewArticle_parsing($connection, $post, $enlace_file) {
    //PREPARAMOS EL DIRECTORIO EN EL QUE HIRÁ EL FICHERO...FILES/ID_USUARIO/AÑO/MES/DIA
    $dir_subida = 'files/0/';
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

    
    $fichero_subido = $dir_subida . str_replace(' ', '_',$post['titulo'].".pdf");
    file_put_contents($dir_subida.str_replace(' ', '_',$post['titulo'].".pdf"), fopen("https://journalofbigdata.springeropen.com".$enlace_file, 'r'));
    $sql = "INSERT INTO Articulo VALUES ('', '0', '".$post['titulo']."', '".$post['abstract']."','', '".$post['fecha']."', '".$post['revista']."', '' , '".$post['nombre_autor']."','".$fichero_subido."')";
    $query = mysqli_query( $connection, $sql );

    echo $sql;
}

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

function getBestUsers($connection) {
    $sql = "SELECT AVG(Votacion.puntuacion) AS media, COUNT(Votacion.id_articulo) AS TOTAL, Articulo.usuario from Votacion INNER JOIN Articulo on Articulo.id = Votacion.id_articulo GROUP BY Articulo.usuario order by AVG(Votacion.puntuacion) desc, TOTAL desc LIMIT 11";
    $result = mysqli_query($connection, $sql);

    if  ( mysqli_num_rows( $result ) != 0 ) {
        return $result;
    }

    return 0;
}

function getArticleByPath($connection, $path) {
    $sql = "SELECT * FROM Articulo WHERE enlace ='".$path."'";
    //echo "QUERY: ".$sql;
    $result = mysqli_query($connection, $sql);

    if  ( mysqli_num_rows( $result ) != 0 )
        return mysqli_fetch_assoc($result);

    else
        return 0;
}


/**

 FUNCIONES PARA BACKEND (GESTIÓN)


 */


function getAllUsers($connection) {
    $sql = "SELECT * FROM Usuario";
    $result = mysqli_query($connection, $sql);

    if  ( mysqli_num_rows( $result ) != 0 )
        return $result;

    else
        return false;
}


function deleteUser($connection, $id) {
    $sql = "DELETE FROM Usuario WHERE id = ".$id;
    $result = mysqli_query($connection, $sql);
    if ($result == TRUE) {
        return 1;
    } else {
        return 0;
    }
}

function getAllArticles($connection) {
    $sql = "SELECT * FROM Articulo";
    $result = mysqli_query($connection, $sql);

    if  ( mysqli_num_rows( $result ) != 0 )
        return $result;

    else
        return 0;
}

function buscaUsuario ($connection, $data) {
    $sql = "SELECT * FROM Usuario WHERE id LIKE '%".$data."%' OR nombre LIKE '%".$data."%' OR apellidos LIKE '%".$data."%' OR email LIKE '%".$data."%' OR organizacion LIKE '%".$data."%' OR puesto_trabajo LIKE '%".$data."%'";
    $result = mysqli_query($connection, $sql);

    if  ( mysqli_num_rows( $result ) != 0 )
        return $result;

    else
        return 0;

}

function buscaArticulos($connection, $data) {
    $sql = "SELECT * FROM Articulo WHERE id LIKE '%".$data."%' OR titulo LIKE '%".$data."%' OR abstract LIKE '%".$data."%' OR fecha LIKE '%".$data."%' OR rev_publicado LIKE '%".$data."%' OR autor LIKE '%".$data."%'";
    $result = mysqli_query($connection, $sql);
    if  ( mysqli_num_rows( $result ) != 0 )
        return $result;

    else
        return 0;
}


function deleteArt ($connection, $id) {
    $sql = "DELETE FROM Articulo WHERE id = '".$id."'";
    echo $sql;
    $result = mysqli_query($connection, $sql);
    if ($result == TRUE) {
        return 1;
    } else {
        return 0;
    }
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