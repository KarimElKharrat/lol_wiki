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
            "SELECT eq.id, eq.image, eq.image_size, eq.nombre, eq.tricode, paises.iso, paises.nombre AS pais, l.nombre_abr AS liga_abr, 'team' AS type FROM equipos eq
            INNER JOIN paises ON eq.origen = paises.id
            INNER JOIN split_liga sl ON eq.ultima_split_liga = sl.id
            INNER JOIN ligas AS l ON sl.liga_id = l.id
            WHERE eq.id = ?
            ORDER BY id ASC",
            ["i", $id]
        );
    }

    /**
     * Devuelve a todos los equipos de un split-liga.
     */
    public function getTeamsBySplitId($id)
    {
        return $this->select(
            "SELECT esl.id_equipo, eq.nombre, eq.tricode, eq.image, eq.image_size, sl.liga_id, paises.iso, paises.nombre as pais FROM equipos_split_liga esl
            INNER JOIN equipos eq ON esl.id_equipo = eq.id
            INNER JOIN split_liga sl ON esl.id_split_liga = sl.id
            INNER JOIN paises ON eq.origen = paises.id
            WHERE sl.id = ?
            ORDER BY esl.id_equipo ASC",
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