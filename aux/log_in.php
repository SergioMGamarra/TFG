<?php
/**
 * Created by PhpStorm.
 * User: sergiomunozgamarra
 * Date: 12/7/16
 * Time: 20:08
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../include/config.php');

session_start();
$alert = false;
if ($_POST['init_session']) {
    $password = sha1($_POST['password']);
    $sql = "SELECT * FROM Usuario WHERE email='".$_POST['email']."' AND password = '".$password."'";
    $result = mysqli_query($connection, $sql);
    if  ( mysqli_num_rows( $result ) != 0 )
    {
        $result = mysqli_fetch_assoc($result);
    }
    if($result!=0) {
        // Iniciamos sesión
        $_SESSION['id'] = $result['id'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['sess_ID'] = sha1($_POST['password']);
        $alert = "Acceso correcto";
        if ($_SESSION['id'] == '12') {
            header('Location: http://localhost:8888/science/views/manage_art.php');
        }
        header('Location: http://localhost:8888/science/views/main.php');
    } else {
        // Si no son correctas devolvemos false
        $alert = "Las credenciales de acceso no son correctas";
    }
} else {
    $alert = "Algo ha ido mal...";
}