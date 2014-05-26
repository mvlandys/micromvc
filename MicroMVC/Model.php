<?php
namespace Matheos\MicroMVC;

class Model
{
    private $dbORM;

    public function __get($var)
    {
        if ($var == "db") {
            if (! isset($this->dbORM)) {
                $appCfg = AppConfig::getInstance();
                $dbCfg  = $appCfg->config->DB;
                if ($dbCfg->enabled == "true") {
                    $database    = Database::getInstance();
                    $this->dbORM = Database::$db;
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
