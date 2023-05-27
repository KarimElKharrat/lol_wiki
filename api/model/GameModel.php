<?php

require_once 'Database.php';

class GameModel extends Database
{
    /**
     * Devuelve a todos las partidas.
     */
    public function getGames($limit)
    {
        return $this->select(
            "SELECT par.id, par.nombre, par.fecha, 
            (SELECT equipos.nombre FROM equipos WHERE equipos.id = par.equipo1) AS equipo1, 
            (SELECT equipos.nombre FROM equipos WHERE equipos.id = par.equipo2) AS equipo2, 
            (SELECT ligas.nombre FROM split_liga INNER JOIN ligas ON split_liga.liga_id = ligas.id WHERE split_liga.id = par.id_split_liga) AS liga, 
            (SELECT splits.nombre FROM split_liga INNER JOIN splits ON split_liga.split_id = splits.id WHERE split_liga.id = par.id_split_liga) AS split 
            FROM partidos par ORDER BY par.id ASC",
            []);
    }
    
    /**
     * Elimina el partido indicado.
     */
    public function deleteGame($id)
    {
        return $this->delete("DELETE FROM partidos WHERE id = ?", ["i", $id]);
    }
}