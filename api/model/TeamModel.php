<?php

require_once 'Database.php';

class TeamModel extends Database
{
    /**
     * Devuelve a todos los equipos.
     */
    public function getTeams($limit)
    {
        return $this->select(
            "SELECT eq.id, eq.nombre, eq.tricode, paises.iso, paises.nombre AS pais FROM equipos eq INNER JOIN paises ON eq.origen = paises.id ORDER BY id ASC LIMIT ?",
            ["i", $limit]
        );
    }
}