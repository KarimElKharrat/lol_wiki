<?php

require_once 'Database.php';

class PlayerModel extends Database
{
    /**
     * Devuelve a todos los jugadores.
     */
    public function getPlayers($name = '')
    {
        return $this->select(
            "SELECT per.id, per.image, per.image_size, per.alias, per.nombre, per.apellidos, per.fecha_nacimiento, sexo.nombre AS sexo, equipos.tricode, equipos.nombre AS equipo, paises.iso, paises.nombre AS pais, rols.nombre as rol, rols.image as rol_image, rols.image_size AS rol_size FROM personas per
            INNER JOIN jugadores jug ON per.id = jug.persona_id
            INNER JOIN rols ON jug.rol_id = rols.id
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
     * Elimina el jugador indicado.
     */
    public function deletePlayer($id)
    {
        $this->delete("DELETE FROM jugadores WHERE persona_id = ?", ["i", $id]);
        $this->delete("DELETE FROM equipo_persona WHERE id_persona = ?", ["i", $id]);
        return $this->delete("DELETE FROM personas WHERE id = ?", ["i", $id]);
    }
}
