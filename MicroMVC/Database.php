<?php
/**
 * Database Class
 *
 * Static class that returns a NotORM or PDO object for accessing the database
 *
 * @package    MicroMVC
 * @author     Mathew Vlandys <mvlandys@gmail.com>
 * @license    https://www.apache.org/licenses/LICENSE-2.0.html  Apache License v2.0
 *
 */
namespace Matheos\MicroMVC;

class Database
{
    protected static $instance = null;
    private static $pdo;
    public static $db;

    public function __construct()
    {
        // Cannot construct
    }

    protected function __clone()
    {
        // Cloning Disabled
    }

    public static function init()
    {
        $AppConfig = AppConfig::getInstance();
        $DBConfig  = $AppConfig->config->DB;

        $Server     = $DBConfig->host;
        $Database	= $DBConfig->database;
        $Username	= $DBConfig->username;
        $Password   = $DBConfig->password;

        try {
            self::$pdo  = new \PDO("mysql:host=".$Server.";dbname=".$Database, $Username, $Password);
            self::$db   = new \NotORM(self::$pdo);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            static::init();
            static::$instance = new static;
        }
        return static::$instance;
    }

    /*
     *  Perform a PDO query
     *
     *  @param string $sql
     *  @param mixed array $data
     */
    public function pdoQuery($sql, $data)
    {
        try {
            $query = self::$pdo->prepare($sql);

            if (!empty($data)) {
                $query->execute($data);
            } else {
                $query->execute();
            }

            if ($query->columnCount() > 0) {
                return $query->fetchAll(\PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return null;
    }
}
