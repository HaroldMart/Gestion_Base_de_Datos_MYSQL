<?php

include('config.php');

class conexion
{

    private  $con = null;

    public static $instancia = null;

    public function __construct()
    {
        if ($this->con == null) {
            $this->con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
        }

        if ($this->con->connect_errno) {
            $this->con = false;
        }
    }

    public static function get_con()
    {

        if (self::$instancia == null) {
            self::$instancia = new conexion();
        }
        return self::$instancia->con;
    }

    public function __destruct()
    {
        if ($this->con != null) {
            $this->con->close();
        }
    }
}
