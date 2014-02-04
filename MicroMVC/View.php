<?php
    namespace Matheos\MicroMVC;

    class View {
        public $_parent, $_viewFile;

        function __construct( $parent ) {
            $this->_parent   = $parent;
            $this->_viewFile = "_view.php";
            $this->_viewData = array();
        }

        public function renderView($view=null, $viewData=null) {
            $view     = (empty($view)) ? $this->_viewFile : $view;
            $viewData = (empty($viewData)) ? $this->_viewData : $viewData;


            ob_start();
                /* Load the view */
                $viewFilename = dirname(__FILE__) . "/../App/views/" . $this->_parent . "/" . $view;
                if (file_exists($viewFilename)) {
                    include($viewFilename);
                } else {
                    throw new \Exception("Cannot locate view: ".$viewFilename);
                }
                // Return the contents of the output buffer
                $html = ob_get_contents();
            ob_end_clean();

            echo $html;
        }
    }
