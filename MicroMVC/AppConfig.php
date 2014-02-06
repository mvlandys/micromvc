<?php
/**
 * AppConfig Class
 *
 * This is a static class used to read the Config/config.json file
 *
 * @package    MicroMVC
 * @author     Mathew Vlandys <mvlandys@gmail.com>
 * @license    https://www.apache.org/licenses/LICENSE-2.0.html  Apache License v2.0
 *
 */

namespace Matheos\MicroMVC;

class AppConfig
{
    protected static $instance = null;
    public $config;

    /**
     * Reads & Parses the Config/config.json file
     */
    protected function __construct()
    {
        $jsonConfig   = file_get_contents("Config/config.json");
        $this->config = json_decode($jsonConfig);
    }

    /**
     * Cloning Disabled
     */
    protected function __clone()
    {
    }

    /**
     * @return mixed $instance Static instance of AppConfig Class
     */
    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }
}
