<?php
    namespace Matheos\App;

    use Matheos\MicroMVC\AppConfig;

    class MainModel extends \Matheos\MicroMVC\Model {
        public function get_AppLibs( $classname ) {
            $js_files  = array("common.js", "Alert.js",  "Error.js",  "{$classname}.js");
            $css_files = array("style.css", "Alert.css", "Error.css", "{$classname}.css");

            switch($classname) {
                /*
                case "Main":
                    $js_files  = array_merge($js_files,  array("MyController.js"));
                    $css_files = array_merge($css_files, array("MyController.css"));
                    break;
                */
            }

            $htmlData = array(
                "js_app"   => $this->minifyString($js_files),
                "css_app"  => $this->minifyString($css_files)
            );

            return $htmlData;
        }

        /**
         * Reads the root bower.json file and iterates through all the dependencies
         * found in App/lib/vendor
         *
         * Reads the dependency's bower.json file to get an array of files to add
         *
         * Determines if the file is a CSS or JS file and adds it to the relevant array.
         *
         * return array of minified js/css file strings
         */
        public function get_VendorLibs( $classname ) {
            $appCfg = AppConfig::getInstance()->config;
            $bower  = json_decode( file_get_contents($appCfg->Core->rootFolder . "/bower.json") );
            $css    = array();
            $js     = array();

            foreach($bower->dependencies as $lib=>$ver) {
                $path = $appCfg->Core->rootFolder . "/App/lib/vendor/" . $lib . "/";

                if (!empty($appCfg->Bower->$lib)) {
                    if (!empty($appCfg->Bower->$lib->css)) {
                        if (is_array($appCfg->Bower->$lib->css)) {
                            foreach($appCfg->Bower->$lib->css as $file) {
                                $css[] = $lib . "/" . $file;
                            }
                        } else {
                            $css[] = $lib . "/" . $appCfg->Bower->$lib->css;
                        }
                    }

                    if (!empty($appCfg->Bower->$lib->js)) {
                        if (is_array($appCfg->Bower->$lib->js)) {
                            foreach($appCfg->Bower->$lib->js as $file) {
                                $js[] = $lib . "/" . $file;
                            }
                        } else {
                            $js[] = $lib . "/" . $appCfg->Bower->$lib->js;
                        }
                    }

                    if ($appCfg->Bower->$lib->override == true) {
                        continue;
                    }
                }

                /*  Read Bower JSON file */
                $file = (file_exists($path . "bower.json")) ? "bower.json" : ".bower.json";
                if (! file_exists($path . $file)) {
                    continue;
                }

                /* Read "main" property */
                $lib_bower = json_decode( file_get_contents($path . $file) );
                if (! isset($lib_bower->main)) {
                    continue;
                }

                /* Add css & js files as specified in the "main" property */
                $files = (is_array($lib_bower->main)) ? $lib_bower->main : array($lib_bower->main);
                foreach($files as $file) {
                    if (substr($file, strlen($file) - 3) == "css") {
                        $css[] = $lib . "/" . $file;
                    }

                    if (substr($file, strlen($file) - 2) == "js") {
                        $js[] = $lib . "/" . $file;
                    }
                }
            }

            $htmlData = array(
                "js_vendor"   => $this->minifyString($js),
                "css_vendor"  => $this->minifyString($css)
            );

            return $htmlData;
        }

        private function minifyString($files) {
            $minify = "";

            foreach($files as $file) {
                if ($files[0] != $file) {
                    $minify .= ",";
                }
                $minify .= $file;
            }

            return $minify;
        }
    }