<?php

namespace Model;

class UserModel extends Database
{
    /**
     * Devuelve a todos los usuarios.
     */
    public function getUsers($limit)
    {
        return $this->select("SELECT * FROM users ORDER BY user_id ASC LIMIT ?", ["i", $limit]);
    }
}