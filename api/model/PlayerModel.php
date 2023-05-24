<?php

require_once 'Database.php';

class PlayerModel extends Database
{
    /**
     * Devuelve a todos los usuarios.
     */
    public function getPlayers($limit)
    {
        return $this->select("SELECT * FROM jugadores ORDER BY persona_id ASC LIMIT ?", ["i", $limit]);
    }
}