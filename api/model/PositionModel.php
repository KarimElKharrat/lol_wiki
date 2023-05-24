<?php

require_once 'Database.php';

class PositionModel extends Database
{
    /**
     * Devuelve a todos los posiciones.
     */
    public function getPositions($limit)
    {
        return $this->select("SELECT * FROM posiciones ORDER BY id ASC LIMIT ?", ["i", $limit]);
    }
}