<?php

mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

class Database
{
    protected $connection = null;

    /**
     * Construye la conexión con la base de datos.
     */
    public function __construct()
    {
        try {
            $this->connection = new \mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);
            $this->connection->set_charset('utf8');
            if (mysqli_connect_errno()) {
                throw new \Exception("Could not connect to database.");
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Nos permite ejecutar la operación select y devuelve los datos de una forma más cómoda.
     */
    public function delete($query = "", $params = [])
    {
        try {
            $stmt = $this->executeStatement($query, $params);
            return $stmt->close();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        return false;
    }

    /**
     * Nos permite ejecutar la operación select y devuelve los datos de una forma más cómoda.
     */
    public function select($query = "", $params = [])
    {
        try {
            $stmt = $this->executeStatement($query, $params);
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $result;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        return false;
    }

    /**
     * Ejecuta las operaciones que se les indique.
     */
    private function executeStatement($query = "", $params = [])
    {
        try {
            $stmt = $this->connection->prepare($query);
            if ($stmt === false) {
                throw new \Exception("Unable to do prepared statement: " . $query);
            }
            if ($params) {
                if (is_countable($params[1]) && count($params[1]) > 1) {
                    $stmt->bind_param($params[0], ...$params[1]);
                } else {
                    $stmt->bind_param($params[0], $params[1]);
                }
            }
            $stmt->execute();
            return $stmt;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
