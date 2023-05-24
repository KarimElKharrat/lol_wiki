<?php

require_once 'Database.php';

class UserModel extends Database
{
    /**
     * Devuelve a todos los usuarios.
     */
    public function getUsers($limit)
    {
        return $this->select("SELECT * FROM usuarios ORDER BY id ASC LIMIT ?", ["i", $limit]);
        
    }
}