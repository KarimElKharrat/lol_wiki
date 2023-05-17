<?php

namespace Inc;

class Config
{
    /**
     * Inicializa datos.
     */
    public static function init()
    {
        define("DB_HOST", "localhost");
        define("DB_USERNAME", "root");
        define("DB_PASSWORD", "");
        define("DB_DATABASE_NAME", "rest_api_demo");
    }
}
