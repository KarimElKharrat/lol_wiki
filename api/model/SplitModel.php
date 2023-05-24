<?php

require_once 'Database.php';

class SplitModel extends Database
{
    /**
     * Devuelve a todos los splits.
     */
    public function getSplits($limit)
    {
        return $this->select("SELECT * FROM splits ORDER BY id ASC LIMIT ?", ["i", $limit]);
    }
}