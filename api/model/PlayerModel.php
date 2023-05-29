<?php

require_once 'Database.php';

class PlayerModel extends Database
{
    /**
     * Devuelve los jugadores agrupados por alias.
     */
    public function getPlayers($name = '')
    {
        return $this->select(
            "SELECT per.id, per.image, per.image_size, per.alias, per.nombre, per.apellidos, per.fecha_nacimiento, sexo.nombre AS sexo, equipos.tricode, equipos.nombre AS equipo, paises.iso, paises.nombre AS pais, rols.nombre as rol, rols.image as rol_image, rols.image_size AS rol_size, 'player' AS type FROM personas per
            INNER JOIN jugadores jug ON per.id = jug.persona_id
            INNER JOIN rols ON jug.rol_id = rols.id
            INNER JOIN paises ON per.pais_id = paises.id
            INNER JOIN sexo ON per.sexo_id = sexo.id
            INNER JOIN equipo_persona ON per.id = equipo_persona.id_persona
            INNER JOIN equipos ON equipo_persona.id_equipo = equipos.id
            WHERE per.alias LIKE CONCAT('%',?,'%') OR per.nombre LIKE CONCAT('%',?,'%') OR per.apellidos LIKE CONCAT('%',?,'%')
            GROUP BY per.alias
            ORDER BY per.id ASC",
            ["sss", [$name, $name, $name]]
        );
    }

    /**
     * Devuelve a todos los jugadores.
     */
    public function getAllPlayers()
    {
        return $this->select(
            "SELECT per.id, per.image, per.image_size, per.alias, per.nombre, per.apellidos, per.fecha_nacimiento, sexo.nombre AS sexo, equipos.tricode, equipos.nombre AS equipo, paises.iso, paises.nombre AS pais, rols.nombre as rol, rols.image as rol_image, rols.image_size AS rol_size, ligas.nombre_abr AS liga, splits.nombre AS split FROM personas per
            INNER JOIN jugadores jug ON per.id = jug.persona_id
            INNER JOIN rols ON jug.rol_id = rols.id
            INNER JOIN paises ON per.pais_id = paises.id
            INNER JOIN sexo ON per.sexo_id = sexo.id
            INNER JOIN equipo_persona ep ON per.id = ep.id_persona
            INNER JOIN equipos ON ep.id_equipo = equipos.id
            INNER JOIN split_liga sl ON ep.id_split_liga = sl.id
            INNER JOIN ligas ON sl.liga_id = ligas.id
            INNER JOIN splits ON sl.split_id = splits.id
            ORDER BY per.id ASC",
            []
        );
    }

    /**
     * Devuelve a un jugador.
     */
    public function getOnePlayer($id)
    {
        return $this->select(
            "SELECT per.id, per.image, per.image_size, per.alias, per.nombre, per.apellidos, per.fecha_nacimiento, sexo.nombre AS sexo, equipos.tricode, equipos.nombre AS equipo, paises.iso, paises.nombre AS pais, rols.nombre as rol, rols.image as rol_image, rols.image_size AS rol_size, ligas.nombre_abr AS liga, splits.nombre AS split FROM personas per
            INNER JOIN jugadores jug ON per.id = jug.persona_id
            INNER JOIN rols ON jug.rol_id = rols.id
            INNER JOIN paises ON per.pais_id = paises.id
            INNER JOIN sexo ON per.sexo_id = sexo.id
            INNER JOIN equipo_persona ep ON per.id = ep.id_persona
            INNER JOIN equipos ON ep.id_equipo = equipos.id
            INNER JOIN split_liga sl ON ep.id_split_liga = sl.id
            INNER JOIN ligas ON sl.liga_id = ligas.id
            INNER JOIN splits ON sl.split_id = splits.id
            WHERE per.id = ?
            ORDER BY per.id ASC",
            ["i", $id]
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
