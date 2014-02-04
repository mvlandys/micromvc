<?php
    namespace Matheos\MicroMVC;

    class Router {
        private $routes;

        function __construct() {
            $cfg  = \Matheos\MicroMVC\AppConfig::getInstance()->config;
            $host = $cfg->Core->hostname;

            if ($cfg->Core->strictHost == "true" && $_SERVER["SERVER_NAME"] != $host) {
                header("Location: http://" . $host . $_SERVER["REQUEST_URI"]);
                exit(1);
            }

            if ($cfg->Core->routing == "true") {
                $this->routes = $this->get_Routes();
            }
        }

        private function get_Routes() {
            $cfg        = \Matheos\MicroMVC\AppConfig::getInstance()->config;
            $root       = $cfg->Core->rootFolder;
            $configFile = $root . "/Config/routes.json";

            $routeData  = array();
            $jsonConfig = json_decode( file_get_contents($configFile) );

            foreach( $jsonConfig as $route=>$data ) {
                $routeData[] = new Route($route, $data[0], $data[1], $data[2]);
            }

            return $routeData;
        }

        public function dispatch() {
            $cfg        = \Matheos\MicroMVC\AppConfig::getInstance()->config;
            $cfgRouting = $cfg->Core->routing;

            /* Advanced Routing: read routes via routes.json */
            if ($cfgRouting == "true") {
                $matchFound = false;

                foreach($this->routes as $route) {
                    if ($_SERVER["REQUEST_METHOD"] != $route->request) continue;
                    if (preg_match("@^".$route->getRegex()."*(/)?(\?*)?@i", $_SERVER["REQUEST_URI"], $matches)) {
                        call_user_func_array(array(new $route->controller, $route->method),array_slice($matches, 1));
                        $matchFound = true;
                        break;
                    }
                }

                if ($matchFound == false) {
                    throw new \Exception($_SERVER["REQUEST_METHOD"] . " Route does not exist: " . $_SERVER["REQUEST_URI"]);
                }
            }

            /* Basic Routing: http://hostname/Controller/Method/:var1/:var2... etc etc */
            if ($cfgRouting == "false") {
                $url = $_SERVER["REQUEST_URI"];
                $url = rtrim($url, "/");
                $url = explode("/", $url);

                if (empty($url[1])) {
                    $controller = new \Matheos\App\Main();
                    $controller->homePage();
                    return;
                }

                $controller_name = "\\Matheos\\App\\" . $url[1];
                $method_name     = (isset($url[2])) ? $url[2] : "";

                if (class_exists($controller_name)) {
                    $controller = new $controller_name;
                } else {
                    throw new \Exception("Controller does not exist: " . $controller_name);
                }

                if ($method_name == "") {
                    throw new \Exception("Method not specified in URL", 1);
                } else if (!method_exists($controller, $method_name)) {
                    throw new \Exception("Method does not exist: {$method_name}", 1);
                }

                call_user_func_array(array($controller, $method_name), array_slice($url, 3));
            }
        }
    }