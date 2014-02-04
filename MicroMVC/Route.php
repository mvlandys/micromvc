<?php
    namespace Matheos\MicroMVC;

    class Route {
        public $request, $url, $controller, $method, $argNames;

        function __construct($Url, $Request, $Controller, $Method) {
            $this->url          = $Url;
            $this->controller   = "Matheos\\App\\" . $Controller;
            $this->method       = $Method;
            $this->request      = $Request;

            /* Set the argument variable */
            preg_match_all("/:([\w-]+)/", $Url, $args);
            $this->argNames = $args[1];
        }

        public function matchArgNames($matches) {
            if (isset($matches[1]) && isset($this->argNames[$matches[1]])) {
                return $this->argNames[$matches[1]];
            } else {
                return "([\w-]+)";
            }
        }

        public function getRegex() {
            return preg_replace_callback("/:(\w+)/", array(&$this, "matchArgNames"), $this->url);
        }
    }