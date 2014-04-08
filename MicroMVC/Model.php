<?php
namespace Matheos\MicroMVC;

class Model
{
    private $dbORM;

    public function __get($var)
    {
        if ($var == "db") {
            if (!isset($this->dbORM)) {
                $DBConf = $this->AppConfig->config->DB;
                if ($DBConf->enabled == "true") {
                    $database    = \Matheos\MicroMVC\Database::getInstance();
                    $this->dbORM =  \Matheos\MicroMVC\Database::$db;
                } else {
                    throw new \Exception("Please enable DB in config.json");
                }
            }
            return $this->dbORM;
        }

        return null;
    }

    public function debugArray($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

    public function ormToArray($orm)
    {
        $array = array();

        foreach ($orm as $key => $val) {
            if (gettype($val) == "object") {
                $val = $this->ormToArray($val);
            }
            $array[$key] = $val;
        }

        return $array;
    }
}
