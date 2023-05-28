<?php

require_once 'Database.php';

class CoachModel extends Database
{
    /**
     * Devuelve a todos los entrenadores.
     */
    public function getCoaches($name = '')
    {
        return $this->select(
            "SELECT per.id, per.image, per.image_size, per.alias, per.nombre, per.apellidos, per.fecha_nacimiento, sexo.nombre AS sexo, equipos.tricode, equipos.nombre AS equipo, paises.iso, paises.nombre AS pais, posiciones.nombre as posicion FROM personas per 
            INNER JOIN entrenadores en ON per.id = en.persona_id 
            INNER JOIN posiciones ON en.posicion_id = posiciones.id 
            INNER JOIN paises ON per.pais_id = paises.id 
            INNER JOIN sexo ON per.sexo_id = sexo.id 
            INNER JOIN equipo_persona ON per.id = equipo_persona.id_persona
            INNER JOIN equipos ON equipo_persona.id_equipo = equipos.id
            WHERE per.alias LIKE CONCAT('%',?,'%') OR per.nombre LIKE CONCAT('%',?,'%') OR per.apellidos LIKE CONCAT('%',?,'%')
            ORDER BY per.id ASC",
            ["sss", [$name, $name, $name]]
        );
    }
    
    /**
     * Elimina el entrenador indicado.
     */
    public function deleteCoach($id)
    {
        $this->delete("DELETE FROM entrenadores WHERE persona_id = ?", ["i", $id]);
        $this->delete("DELETE FROM equipo_persona WHERE id_persona = ?", ["i", $id]);
        return $this->delete("DELETE FROM personas WHERE id = ?", ["i", $id]);
    }
}