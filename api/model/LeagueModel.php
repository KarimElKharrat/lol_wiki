<?php

require_once 'Database.php';

class LeagueModel extends Database
{
    /**
     * Devuelve a todos los ligas.
     */
    public function getLeagues($limit)
    {
        return $this->select("SELECT * FROM ligas ORDER BY id ASC", []);
    }
}