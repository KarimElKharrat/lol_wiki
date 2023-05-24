<?php

require_once 'Database.php';

class PlayerModel extends Database
{
    /**
     * Devuelve a todos los jugadores.
     */
    public function getPlayers($limit)
    {
        return $this->select(
            "SELECT per.id, per.alias, per.nombre, per.apellidos, per.fecha_nacimiento, sexo.nombre AS sexo, equipos.tricode, equipos.nombre AS equipo, paises.iso, paises.nombre AS pais, rols.nombre as rol FROM personas per 
            INNER JOIN jugadores jug ON per.id = jug.persona_id 
            INNER JOIN rols ON jug.rol_id = rols.id 
            INNER JOIN paises ON per.pais_id = paises.id 
            INNER JOIN sexo ON per.sexo_id = sexo.id 
            INNER JOIN equipo_persona ON per.id = equipo_persona.id_persona 
            INNER JOIN equipos ON equipo_persona.id_equipo = equipos.id 
            ORDER BY per.id ASC LIMIT ?",
            ["i", $limit]
        );
    }
}
