<?php
/**
 * Created by PhpStorm.
 * User: Sergio
 * Date: 22/2/16
 * Time: 12:21
 */


$dbhost = 'localhost';
$dbuser = 'talend';
$dbpass = 'talend';
$dbname = 'science_db';

function connect($dbhost, $dbuser, $dbpass, $dbname) {
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if ( mysqli_connect_errno() ) die( 'error: ' . mysqli_connect_form_ok() );
    mysqli_query( $connection, "SET NAMES utf8" );

    return $connection;
}

$connection = connect ($dbhost, $dbuser, $dbpass, $dbname);

/*
 *
 * */