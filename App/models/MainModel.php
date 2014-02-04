<?php
    namespace Matheos\App;

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

        public function get_VendorLibs( $classname ) {
            $css_files = array(
                "Bootstrap/css/bootstrap.css",
                "Colorbox/colorbox.css",
                "JQuery-UI/css/jquery-ui-1.9.2.custom.css",
                "Chosen-JS/chosen.css"
            );

            $js_files  = array(
                "JQuery/jquery.min.js",
                "Bootstrap/js/bootstrap.js",
                "JQuery-UI/js/jquery-ui-1.10.2.custom.js",
                "Colorbox/jquery.colorbox.js",
                "JQuery/jquery.form.js",
                "Chosen-JS/chosen.jquery.min.js"
            );

            $htmlData = array(
                "js_vendor"   => $this->minifyString($js_files),
                "css_vendor"  => $this->minifyString($css_files)
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