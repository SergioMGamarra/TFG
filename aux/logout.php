<?php
/**
 * Created by PhpStorm.
 * User: sergiomunozgamarra
 * Date: 4/9/16
 * Time: 8:10
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../include/config.php');

session_start();
unset($_SESSION['id']);
unset($_SESSION['email']);
unset($_SESSION['sess_ID']);

session_unset();
session_destroy();

header('Location: http://localhost:8888/science/views/main.php');

?>