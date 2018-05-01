<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrador
 * Date: 16/10/13
 * Time: 16:07
 * To change this template use File | Settings | File Templates.
 */

class adminUser {
    private $dbhost = DATABASE_HOST;
    private $dbuser = DATABASE_USER;
    private $dbpass = DATABASE_PASS;
    private $dbname = DATABASE_NAME;
    private $banco;

    public function __construct()
    {
        $this->banco = new mysqli($this->dbhost, base64_decode($this->dbuser), base64_decode($this->dbpass), $this->dbname);
    }

    public function __destruct()
    {
        $this->banco->close();
    }
    public function login($email, $pass){

        $email = trim($email);
        $pass = trim($pass);

        $query = "SELECT u.iduser, u.email, u.type FROM adminuser as u WHERE u.email = '".$email."' AND u.pass = '".$pass."'";
        $result = $this->banco->query($query);
        $array = $result->fetch_object();
        $result->close();
        return $array;

    }


}