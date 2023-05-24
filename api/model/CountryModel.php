<?php

require_once 'Database.php';

class CountryModel extends Database
{
    /**
     * Devuelve a todos los paises.
     */
    public function getCountries($limit)
    {
        return $this->select("SELECT * FROM paises ORDER BY id ASC");
    }
}