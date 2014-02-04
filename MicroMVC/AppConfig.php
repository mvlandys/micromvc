<?php
    namespace Matheos\MicroMVC;

    class AppConfig {
        protected static $instance = null;
        public $config;

        protected function __construct() {
            $jsonConfig   = file_get_contents("Config/config.json");
            $this->config = json_decode($jsonConfig);
        }

        protected function __clone() {
            // Cloning Disabled
        }

        public static function getInstance() {
            if (!isset(static::$instance)) {
                static::$instance = new static;
            }
            return static::$instance;
        }
    }