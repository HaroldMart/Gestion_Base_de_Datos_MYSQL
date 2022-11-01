<?php

class plantilla
{

    static $instancia = null;

    static function aplicar()
    {
        self::$instancia = new plantilla();
    }

    function __construct()
    {
        include('Components/header.php');
    }

    function __destruct()
    {

        include('Components/foot.php');
    }
}
