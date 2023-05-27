<?php

require_once 'Database.php';

class RolModel extends Database
{
    /**
     * Devuelve a todos los roles.
     */
    public function getRols($limit)
    {
        return $this->select("SELECT * FROM rols ORDER BY id ASC", []);
    }
}
