<?php

require_once 'Database.php';

class SplitleagueModel extends Database
{
    /**
     * Devuelve a todos los split-liga.
     */
    public function getSplitleagues($name = '')
    {
        return $this->select(
            "SELECT sl.id, l.image, l.image_size, l.nombre_abr AS liga_abr, l.nombre, l.region, s.nombre AS split, sl.`año`, 'splitleague' AS type FROM split_liga sl
            INNER JOIN ligas l ON sl.liga_id = l.id
            INNER JOIN splits s ON sl.split_id = s.id
            WHERE l.nombre_abr LIKE CONCAT('%',?,'%') OR l.nombre LIKE CONCAT('%',?,'%')
            ORDER BY sl.`año`, s.id ASC",
            ["ss", [$name, $name]]
        );
    }

    /**
     * Devuelve un split-liga.
     */
    public function getOneSplitleague($id)
    {
        return $this->select(
            "SELECT sl.id, l.image, l.image_size, l.nombre_abr AS liga_abr, l.nombre, l.region, s.nombre AS split, sl.`año`, 'splitleague' AS type FROM split_liga sl
            INNER JOIN ligas l ON sl.liga_id = l.id
            INNER JOIN splits s ON sl.split_id = s.id
            WHERE sl.id = ?
            ORDER BY l.nombre_abr, sl.`año`",
            ["i", $id]
        );
    }
    
    /**
     * Elimina el split-liga indicado.
     */
    public function deleteSplitleagues($id)
    {
        return $this->delete("DELETE FROM split_liga WHERE id = ?", ["i", $id]);
    }
}
