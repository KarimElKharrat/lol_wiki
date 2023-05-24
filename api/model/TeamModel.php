<?php

require_once 'Database.php';

class TeamModel extends Database
{
    /**
     * Devuelve a todos los usuarios.
     */
    public function getTeams($limit)
    {
        return $this->select("SELECT * FROM equipos ORDER BY id ASC LIMIT ?", ["i", $limit]);
        
    }
}