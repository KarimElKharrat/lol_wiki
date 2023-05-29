<?php

require_once 'Database.php';

class TeamModel extends Database
{
    /**
     * Devuelve a todos los equipos.
     */
    public function getTeams($name = '')
    {
        return $this->select(
            "SELECT eq.id, eq.image, eq.image_size, eq.nombre, eq.tricode, paises.iso, paises.nombre AS pais, 'team' AS type FROM equipos eq
            INNER JOIN paises ON eq.origen = paises.id
            WHERE eq.nombre LIKE CONCAT('%',?,'%')
            ORDER BY id ASC",
            ["s", $name]
        );
    }
    
    /**
     * Devuelve a un equipo.
     */
    public function getOneTeam($id)
    {
        return $this->select(
            "SELECT eq.id, eq.image, eq.image_size, eq.nombre, eq.tricode, paises.iso, paises.nombre AS pais, 'team' AS type FROM equipos eq
            INNER JOIN paises ON eq.origen = paises.id
            WHERE eq.id = ?
            ORDER BY id ASC",
            ["i", $id]
        );
    }

    /**
     * Elimina el equipo indicado.
     */
    public function deleteTeam($id)
    {
        return $this->delete("DELETE FROM equipos WHERE id=?", ["i", $id]);
    }
}