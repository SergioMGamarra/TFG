<?php

require_once ('../config.php');

/**
 * Created by PhpStorm.
 * User: sergiomunozgamarra
 * Date: 21/6/16
 * Time: 21:01
 */
class User
{
    protected $datos = array(
        "nombre" => "",
        "apellidos" => "",
        "email" => "",
        "pass" => "",
        "puesto trabajo" => "",
        "organizacion" => "",
        "titulo" => ""
    );

    /**
     * User constructor.
     * @param array $datos
     */
    public function __construct(array $datos)
    {
        $this->datos = $datos;
    }

    /**
     * @return array
     */
    public function getDatos()
    {
        return $this->datos;
    }

    /**
     * @param array $datos
     */
    public function setDatos($datos)
    {
        $this->datos = $datos;
    }




    /*
     *
     * EMPIEZAN LOS MÉTODOS
     *
     * */

    private function check_user($connection, $post) {
        $password = SHA1($post['password']);
        $sql = "SELECT * FROM Usuario WHERE email=".$post['email']." AND password = ".$password;
        echo $sql;
        $result = mysqli_query($connection, $sql);
        if  ( mysqli_num_rows( $result ) != 0 )
        {
            $row = mysqli_fetch_assoc($result);
            return $row;
        }
        else
        {
            return 0;
        }
    }

    public function login($connection) {
        // Comprobamos que las credenciales de acceso son correctas...
        $result = check_user($connection);
        if($this->check_user($connection)!=0) {
            // Iniciamos sesión
            $_SESSION['id'] = $result['id'];
            $_SESSION['email'] = $this->email;
            $_SESSION['sess_ID'] = $this->pass;
        } else {
            // Si no son correctas devolvemos false
            return false;
        }
    }
}