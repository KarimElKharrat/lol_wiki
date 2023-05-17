<?php

namespace Model;

class File
{
    private static $FILES_DIR = PROJECT_ROOT_PATH . 'metadata\files.json';
    /**
     * Incluye un archivo.
     * @param include
    */
    public static function includeTemplateFile(string $include)
    {
        include(self::saveFilesJSON($include));
    }

    /**
     * Guarda en un archivo json todos los archivos del proyecto.
     * @param filename
     */
    public static function saveFilesJSON(string $filename)
    {
        if (file_exists(self::$FILES_DIR)) {
            unlink(self::$FILES_DIR);
        }

        self::saveArrayToJSONFile(self::$FILES_DIR, self::getDirContents(PROJECT_ROOT_PATH));
        return self::getFilePathByName($filename);
    }

    /**
     * Busca todos los archivos del proyecto.
     * @param dir
     * @param results
     */
    public static function getDirContents($dir, &$results = array())
    {
        $files = scandir($dir);

        if (($key = array_search('vendor', $files)) !== false) {
            unset($files[$key]);
        }

        foreach ($files as $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[basename($path)] = $path;
            } elseif ($value != "." && $value != "..") {
                self::getDirContents($path, $results);
                $results[basename($path)] = $path;
            }
        }

        return $results;
    }

    public static function getFilePathByName(string $filename)
    {
        $files = json_decode(file_get_contents(self::$FILES_DIR));

        foreach ($files as $key => $file) {
            if ($key === $filename) {
                return $file;
            }
        }

        return false;
    }

    /**
     * Guarda un array a un archivo json.
     * @param path
     * @param array
     */
    public static function saveArrayToJSONFile(string $path, array $array)
    {
        file_put_contents($path, json_encode($array, JSON_PRETTY_PRINT));
    }
}
