<?php
    namespace Matheos\App;

    class Main extends \Matheos\MicroMVC\Controller {
        public function renderHtml( $classname="Main" ) {
            $viewData  = array_merge(
                $this->model->get_AppLibs($classname),
                $this->model->get_VendorLibs($classname)
            );

            $this->view->renderView("html.php", $viewData);
        }

        public function renderHeader() {
            $this->view->renderView("header.php");
        }

        public function renderFooter() {
            $this->view->renderView("footer.php");
        }

        public function homePage() {
            $this->view->_viewFile = "home.php";
            $this->renderSite(array( $this->view ));
        }
    }