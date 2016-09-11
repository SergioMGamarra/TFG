<?php
/**
 * Created by PhpStorm.
 * User: sergiomunozgamarra
 * Date: 11/9/16
 * Time: 18:15
 */

echo "<script>alert('hola2');</script>";
if ($_POST) {
    InsertValoration($connection, $id_art, $_SESSION['id'], $_POST['puntuacion']);
}