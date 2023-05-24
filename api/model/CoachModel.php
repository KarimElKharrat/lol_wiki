<?php

require_once 'Database.php';

class CoachModel extends Database
{
    /**
     * Devuelve a todos los entrenadores.
     */
    public function getCoaches($limit)
    {
        return $this->select(
            "SELECT per.id, per.alias, per.nombre, per.apellidos, per.fecha_nacimiento, sexo.nombre AS sexo, equipos.tricode, equipos.nombre AS equipo, paises.iso, paises.nombre AS pais, posiciones.nombre as posicion FROM personas per 
            INNER JOIN entrenadores en ON per.id = en.persona_id 
            INNER JOIN posiciones ON en.posicion_id = posiciones.id 
            INNER JOIN paises ON per.pais_id = paises.id 
            INNER JOIN sexo ON per.sexo_id = sexo.id 
            INNER JOIN equipo_persona ON per.id = equipo_persona.id_persona
            INNER JOIN equipos ON equipo_persona.id_equipo = equipos.id
            ORDER BY per.id ASC LIMIT ?",
            ["i", $limit]
        );
    }
}