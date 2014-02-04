<?php
    namespace Matheos\MicroMVC;

    class Controller {
        protected $view, $model;

        function __construct() {
            $this->view  = new \Matheos\MicroMVC\View($this->className());

            $modelFile  = $this->className() . "Model";
            $modelClass = "\\Matheos\\App\\" . $modelFile;

            if (file_exists(dirname(__FILE__) . "/../App/models/{$modelFile}.php")) {
                $this->model = new $modelClass;
            }
        }

        public function renderSite( $views=null ) {
            $MainController = new \Matheos\App\Main();
            $MainController->renderHtml( $this->className() );
            $MainController->renderHeader();

            foreach ($views as $view) {
                $view->renderView();
            }

            $MainController->renderFooter();
        }

        public function className() {
            $class = explode('\\', get_class($this));
            return end($class);
        }

        public function debugArray($arr) {
            echo "<pre>";
            print_r($arr);
            echo "</pre>";
        }

        public function redirect($url) {
            $AppConfig = \Matheos\MicroMVC\AppConfig::getInstance()->config;
            $Hostname  = $AppConfig->Core->hostname;

            header("Location: http://" . $Hostname . $url);
            exit(1);
        }
    }