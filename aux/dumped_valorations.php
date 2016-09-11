<?php
/**
 * Created by PhpStorm.
 * User: sergiomunozgamarra
 * Date: 28/8/16
 * Time: 16:45
 */
include ('../include/config.php');
include ('../include/functions.php');

$sql = "SELECT id_usuario, id_articulo, puntuacion FROM Votacion";

$result = mysqli_query($connection, $sql);

$myfile = fopen("valorations.csv", "w") or die("Unable to open file!");
foreach ($result as $res) {
    $txt = $res['id_usuario'] . "," . $res['id_articulo'] . "," . $res['puntuacion'] . "\n";
    fwrite($myfile, $txt);
}

fclose($myfile);