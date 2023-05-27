<?php

require_once 'Database.php';

class UserModel extends Database
{
    /**
     * Devuelve a todos los usuarios.
     */
    public function getUsers($limit)
    {
        return $this->select("SELECT * FROM usuarios ORDER BY id ASC", []);
    }

    /**
     * Elimina el usuario indicado.
     */
    public function deleteUser($id)
    {
        return $this->select("DELETE FROM usuarios WHERE id = ?", ["i", $id]);
    }
}